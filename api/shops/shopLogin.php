<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    // check if the right request was sent
    if ($method == 'POST') {
        // Get company private key
        $query = 'SELECT * FROM apidatatable';
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row =  mysqli_fetch_assoc($result);
        $companykey = $row['privatekey'];
        $servername = $row['servername'];
        $expiresIn = $row['tokenexpiremin'];



        if ( !isset($_POST['shop_email'])) {

            $errordesc="Shop Email required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Email must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopEmail = cleanme($_POST['shop_email']);
        }

        if ( !isset($_POST['shop_password'])) {

            $errordesc="Shop Password is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Password must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopPassword = cleanme($_POST['shop_password']);
        }        

        if (empty($shopEmail)  || empty($shopPassword) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        $active = 1;

        if ( !validateEmail($shopEmail) ){
            // Insert all fields
            $errordesc = "Invalid Email passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid email address";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // insert the values to the shop location table 
        $query = "SELECT * FROM `shops` WHERE `shop_email` = ?";
        $loginShop = $connect->prepare($query);
        $loginShop->bind_param("s", $shopEmail);
        $loginShop->execute();
        $result= $loginShop->get_result();
        $num_row = $result->num_rows;

        if ( $num_row > 0 ) {
            //user exist
            $row = $result->fetch_assoc();
            //fetch password fron usertable and compare
            $verifyPassword = check_pass($shopPassword, $row['password']);

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
            $userPubKey = $row['userpubkey'];

            if ($status == 0){
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
            }

            if ($status == 2 ){
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
            }

            if ($status == 3){
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
            }

            if($status == 1){
                //valid, can login
                $browser= $_SERVER['HTTP_USER_AGENT'];
                $userIp = getIPAddress();

                $time = new DateTimeImmutable();
                $fullDate = gettheTimeAndDate($time->getTimestamp());
                $date = explode(" ", $fullDate)[0];
                $location = getLoc($userIp);
                $userType = "2";

                $activity = "Login";

                $sessionCode = generateUniqueShortKey($connect, "usersessionlog", "sessioncode");

                $token = getTokenToSendAPI($userPubKey, $companykey, $expiresIn, $servername);
                $session = addSessionLog($connect, $shopEmail, $activity ,$sessionCode ,$userIp, $browser, $date, $location, $userType, $method, $endpoint);

                if ($session){
                    //send login sms
                    $receiver=$shopEmail;
                    $sender="no-reply@loadng.ng";
                    $subject="CartNG Account Login Notification";
                    $name = $row['name'];
                    $dateloggedin= gettheTimeAndDate(time());
                    $msg="Hello Chief  $name,<br>
                            You just logged in to your account on LoadNG with the ip properties below.<br><br> IP Address: $userIp  <br><br>Device: $browser <br><br>Date: $dateloggedin.<br>
                            If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                    
                    

                    // if (sendUserMail($sender, $subject, $receiver, $msg, $msg)){
                    //     $data = [];
                    //     $text= "Shop Login successfully";
                    //     $status = true;
                    //     $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                    //     respondOK($successData);
                    // }else{
                    //     $data = $token;
                    //     $text= "Shop Login successfully";
                    //     $status = true;
                    //     $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                    //     respondOK($successData);
                    // }

                    $data = array('authToken' => $token);
                    $text= "Shop Login successfully";
                    $status = true;
                    $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                    respondOK($successData);
                    
                }
            }
        }else{
            $errordesc="Incorrect details";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Fill in valid email and password";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        if ( $loginShop->error ){
            // send db error
            $errordesc =  $loginShop->error;
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