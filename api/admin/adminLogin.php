<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
    include "../connectdb.php";
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    // check if the right request was sent
    if ($method == 'POST') {
        //get company details to encode usertoken
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyPrivateKey = $companyDetails['privatekey'];
        $minuteToEnd = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        if ( !isset($_POST['email'])) {

            $errordesc="Admin Email required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Admin Email must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $email = cleanme($_POST['email']);
        }

        if ( !isset($_POST['password'])) {

            $errordesc="Logistics Password is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="logistics Password must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $password = cleanme($_POST['password']);
        }        

        if (empty($email)  || empty($password) ){
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $active = 1;
        if ( !validateEmail($email) ){
            // Insert all fields
            $errordesc = "Invalid Email passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid email address";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if email in admin db 
        $query = "SELECT * FROM `admin` WHERE `email` = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result= $stmt->get_result();
        $num_row = $result->num_rows;

        if ( $num_row > 0 ) {
            //user exist
            $row = $result->fetch_assoc();
            //fetch password fron usertable and compare
            $verifyPassword = check_pass($password, $row['password']);

            if ( !$verifyPassword ){
                $errordesc="Incorrect Password";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Fill in valid email and password";
                $method;
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
            
            $status = $row['status'];

            if ($status == 0){//banned
                $maindata['status']=$status;
                $maindata=[$maindata];
                $errordesc="Unauthorized";
                $linktosolve="htps://";
                $hint=["Ensure acount is not banned on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                $errordata=returnError7002($errordesc,$linktosolve,$hint);
                $text="You have been banned from this platform";
                $method;
                $data=returnErrorArray($text,$method,$endpoint,$errordata,$maindata);
                respondBadRequest($data);
            }elseif ($status == 2 ){//suspended
                $maindata['status']=$status;
                $maindata=[$maindata];
                $errordesc="Unauthorized";
                $linktosolve="htps://";
                $hint=["Ensure acount is not suspended on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                $errordata=returnError7002($errordesc,$linktosolve,$hint);
                $text="You have been suspended from this platform";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata,$maindata);
                respondBadRequest($data);
            }elseif ($status == 3){//frozen
                $maindata['status']=$status;
                $maindata=[$maindata];
                $errordesc="Unauthorized";
                $linktosolve="htps://";
                $hint=["Ensure acount is not fozen on the app", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                $errordata=returnError7002($errordesc,$linktosolve,$hint);
                $text="You account has been frozen";
                $method;
                $data=returnErrorArray($text,$method,$endpoint,$errordata,$maindata);
                respondBadRequest($data);
            }elseif($status == 1){
                //valid, can login
                $name = $row['name'];
                $username = $row['username'];
                $userPubKey = $row['userpubkey'];
                $superAdmin = $row['superadmin'];
                $status = $row['status'];
                $dateloggedin = time();
                $browser= $_SERVER['HTTP_USER_AGENT'];
                $userIp = getIPAddress();
                $location = "Nigeria";
                $userType = "1";
                $sessionCode = generateUniqueShortKey($connect, "usersessionlog", "sessioncode");

                //update the session log
                $query = "INSERT INTO usersessionlog(`email`, `username`, `sessioncode`, `ipaddress`, `browser`, `date`, `location`, `user_type`) VALUES (?,?,?,?,?,?,?,?)";
                $logSession = $connect->prepare($query);
                $logSession->bind_param("ssssssss", $email, $username, $sessionCode, $userIp, $browser, $dateloggedin,$location, $userType);
                $insertLogSession = $logSession->execute();

                $token = getTokenToSendAPI($userPubKey, $companyPrivateKey, $minuteToEnd, $serverName);
               

                if ($insertLogSession){
                    //send login sms
                    $receiver=$email;
                    $sender="no-reply@shortleters.ng";
                    $subject="CartNG Account Login Notification";
                    $dateloggedin= gettheTimeAndDate($dateloggedin);
                    $msg="Hello Chief  $name,<br>
                            You just logged in to your account on Shortleters with the ip properties below.<br><br> IP Address: $userIp <br><br>Device: $browser <br><br>Date: $dateloggedin.<br>
                            If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                    
                    //send user login email  
                    sendUserMail($subject, $receiver, $msg, $msg); 

                    $maindata=["IPaddress"=>$userIp, "browser"=>$browser,"authtoken"=> $token, "name"=>$name, "username"=>"$username", "superAdmin"=>$superAdmin];
                    $errordesc = " ";
                    $linktosolve = "htps://";
                    $hint = [];
                    $errordata = [];
                    $text = "Login successful";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondOK($data);  
                }
            }
        }else{
            $errordesc="Incorrect details";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Incorrect Email and/or  password";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        if ( $stmt->error ){
            // send db error
            $errordesc =  $stmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }

        

    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
        
    }

?>