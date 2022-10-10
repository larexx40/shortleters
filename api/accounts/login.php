<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);
    $maindata=[];  

    //allow only post method
    if (getenv('REQUEST_METHOD') === 'POST'){
        
        //collect input and validate it
        if(!isset($_POST['email'])){
            $errordesc="Email required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Fill in Email";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $email = cleanme($_POST['email']);
        }


        if(!isset($_POST['password'])){
            $errordesc="Password required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input password";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {
            $password = cleanme($_POST['password']);
        }


        //check if input isempty
        if(empty($email)|| empty($password)){
            //all input required / bad request
            $errordesc="input cannot be empty";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input Username and Password";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{        
            //get user from db
            $sql= "SELECT * FROM users WHERE email = ?";
            $getUser = $connect->prepare($sql);
            $getUser->bind_param("s", $email);
            $getUser->execute();
            $result= $getUser->get_result();
            $getUser->close();
            
            if($result->num_rows > 0){
                //user exist
                $row = $result->fetch_assoc();
                //fetch password fron usertable and compare
                $verifyPassword = check_pass($password, $row['password']);
                if($verifyPassword){
                    $status = $row['status'];
                    $activity = "1";

                    if($status == 1){
                        //valid, can login
                        $ipaddress = getIPAddress();
                        $dateloggedin = time();
                        $firstName = $row['fname'];
                        $userPubKey = $row['userpubkey'];
                        $browser= $_SERVER['HTTP_USER_AGENT'];
                        $username = $row['username'];
                        $fullname = $row['fname']." ".$row['lname'];
                        $balance = $row['bal'];
                        $time = new DateTimeImmutable();
                        $fullDate = gettheTimeAndDate($time->getTimestamp());
                        $user_type = 2;
                        $sessionCode = generateUniqueShortKey($connect, "usersessionlog", "sessioncode");

                        //update the session log
                        addSessionLog($connect, $email, $activity, $sessionCode, $ipaddress, $browser, $fullDate, getLoc($ipaddress), $user_type, $method, $endpoint );
                        
                        $detailsID =1;
                        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
                        $getCompanyDetails->bind_param('i', $detailsID);
                        $getCompanyDetails->execute();
                        $result = $getCompanyDetails->get_result();
                        $companyDetails = $result->fetch_assoc();
                        $companyprivateKey = $companyDetails['privatekey'];
                        $minutetoend = $companyDetails['tokenexpiremin'];
                        $serverName = $companyDetails['servername'];

                        //send login sms
                        $receiver=$email;
                        $sender="no-reply@shortleters.ng";
                        $subject="Shortleters Account Login Notification";
                        $dateloggedin= gettheTimeAndDate($dateloggedin);
                        $msg="Hello Chief  $firstName,<br>
                                You just logged in to your account on Shortleters with the ip properties below.<br><br> IP Address: $ipaddress <br><br>Device: $browser <br><br>Date: $dateloggedin.<br>
                                If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";

                        //send use mail
                        //sendUserMail($subject, $receiver, $msg, $msg);
                        //get auth token
                        $token = getTokenToSendAPI($userPubKey,$companyprivateKey,$minutetoend,$serverName);
                        $maindata=["authtoken"=> $token];
                        $errordesc = " ";
                        $linktosolve = "htps://";
                        $hint = [];
                        $errordata = [];
                        $text = "Login successful";
                        $status = true;
                        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                        respondOK($data);

                        

                    } elseif ($status==2) {//suspended
                        $banreason = "Account suspended";
                        $maindata['status']=$status;
                        $maindata=[$maindata];
                        $errordesc="Unauthorized";
                        $linktosolve="htps://";
                        $hint=["Ensure acount is not suspended on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                        $errordata=returnError7002($errordesc,$linktosolve,$hint);
                        $text=$banreason;
                        $method=getenv('REQUEST_METHOD');
                        $data=returnErrorArray($text,$method,$endpoint,$errordata,$maindata);
                        respondBadRequest($data);
                    } elseif ($status==3) {//frozen
                        $banreason = "Account Frozen";
                        $maindata['status']=$statusis;
                        $maindata['frozedate']=$frotime;
                        $maindata=[$maindata];
                        $errordesc="Unauthorized";
                        $linktosolve="htps://";
                        $hint=["Ensure acount is not fozen on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                        $errordata=returnError7002($errordesc,$linktosolve,$hint);
                        $text=$banreason;
                        $method=getenv('REQUEST_METHOD');
                        $data=returnErrorArray($text,$method,$endpoint,$errordata,$maindata);
                        respondBadRequest($data);
                    } elseif ($status==0) {//banned
                        $banreason = "Account Banned";
                        $maindata['status']=$status;
                        $maindata=[$maindata];
                        $errordesc="Unauthorized";
                        $linktosolve="htps://";
                        $hint=["Ensure acount is not banned on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                        $errordata=returnError7002($errordesc,$linktosolve,$hint);
                        $text= "Account Banned";
                        $method=getenv('REQUEST_METHOD');
                        $data=returnErrorArray($text,$method,$endpoint,$errordata,$maindata);
                        respondBadRequest($data);
                    } else {
                        $errordesc="Bad request";
                        $linktosolve="htps://";
                        $hint=["Ensure acount is not banned on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                        $errordata=returnError7003($errordesc,$linktosolve,$hint);
                        $text="You Have Been Permanently Banned From this platform with the name associated to your bank account details flagged<br>Contact Support with your user details if you think this was done in error.";
                        $method=getenv('REQUEST_METHOD');
                        $data=returnErrorArray($text,$method,$endpoint,$errordata);
                        respondBadRequest($data);
                    }
                                 
                }else{
                    //incorrect password
                    $errordesc="Bad request";
                    $linktosolve="htps://";
                    $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="Your email and/or password are invalid.";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);

                }
            }else{
                // incorrect email
                $errordesc="Incorrect email";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Fill in valid email and password";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
        }


    }else {
        // method not allowed
        $errordesc="Method not allowed";
        $linktosolve="htps://";
        $hint=["Ensure to use the method stated in the documentation."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Method used not allowed";
        $method=getenv('REQUEST_METHOD');
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondMethodNotAlowed($data);
    }



?>