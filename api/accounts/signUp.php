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
    $maindata =[];

    if ($method == 'POST') {
        // Check if the phone field is passed
        if (!isset($_POST['phone'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required phone field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $phoneno = cleanme($_POST['phone']);
        }     

        // check if phoneno is empty
        if ( empty($phoneno) ){
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the email and password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        // check if phone is a valid phone number
        if (!validatePhone($phoneno)){
            $errordesc = "Invalid phone number";
            $linktosolve = 'https://';
            $hint = "pass a valid phone number in the phone field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // Check if the phone number is already in the database
        $isPhoneExist = checkifFieldisUnique($connect, "users" , "phoneno" , $phoneno);
        if ( $isPhoneExist ){
            $errordesc = "phoneno already exist";
            $linktosolve = 'https://';
            $hint = ["User with phoneno already exist" ,"proceed to login", "register as a new user"];
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        //set token expiretime
        $expiresin = "5";
        $created_time = new DateTimeImmutable();
        $expiretime = $created_time->modify("+$expiresin minutes")->getTimestamp();

        // generate token and insert it into the token table
        $token = generateUniqueNumericKey($connect, "token", "token", 5);
        //verify type 1=email, 2= phone
        $verifyType = 2;

        $tokenQuery = 'INSERT INTO token (useridentity, token, time, verifytype) Values (?, ?, ?, ?)';
        $tokenStmt = $connect->prepare($tokenQuery);
        $tokenStmt->bind_param("ssss",$phoneno, $token, $expiretime, $verifyType);
        if ( $tokenStmt->execute() ){
            $smstosend = "Your Shortleters verification code is $token"; 
            $sent = sendUserSMS($phoneno, $smstosend);
            if ($sent){
                $text= "SignUp verification token sent";
                $status = true;
                $data = [];
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }

            $text= "Token sent ";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, $maindata, $data, $status);
            respondOK($successData);
        }else{
            $errordesc =  $tokenStmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
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