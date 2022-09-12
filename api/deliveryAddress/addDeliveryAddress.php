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

    if ($method == 'POST') {
        //get companydetalis and servername for auth token
        $detailsID =1;
        $JWTParams = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $JWTParams->bind_param('i', $detailsID);
        $JWTParams->execute();
        $result = $JWTParams->get_result();
        $row = $result->fetch_assoc();
        $companyprivateKey = $row['privatekey'];
        $minutetoend = $row['tokenexpiremin'];
        $serverName = $row['servername'];
    

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        if(!getUserWithPubKey($connect, $userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not registered";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $userid = getUserWithPubKey($connect, $userpubkey);

        // Check if the recipient name field is passed
        if (!isset($_POST['name'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required recipient name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $name = cleanme($_POST['name']);
        }

        // Check if the recipient phone field is passed
        if (!isset($_POST['phone'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required phone number field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $phone = cleanme($_POST['phone']);
        }

        // Check if the local government field is passed
        if (!isset($_POST['lga'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required local government area field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $lga = cleanme($_POST['lga']);
        }

        // Check if the state field is passed
        if (!isset($_POST['state'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address state field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $state = cleanme($_POST['state']);
        }

        // Check if the country field is passed
        if (!isset($_POST['country'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required country field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $country = cleanme($_POST['country']);
        }

        // Check if the zipcode field is passed
        if (!isset($_POST['zipcode'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required zip code field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $zipcode= cleanme($_POST['zipcode']);
        }

        // Check if the longitude field is passed
        if (isset($_POST['longitude'])){
            $longtitude = cleanme($_POST['longitude']);
        }else{
            $longtitude = "not set";
        }

        // Check if the latitude field is passed
        if (isset($_POST['latitude'])){
            $latitude = cleanme($_POST['latitude']);
        }else{
            $latitude = "not set";
        }

        // Check if the address field is passed
        if (!isset($_POST['address'])){
            $errordesc = "user addres  must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required full address field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $address = cleanme($_POST['address']);
        }

        // Check if the address number field is passed
        if (!isset($_POST['addressno'])){
            $errordesc = "Address no must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address number field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $addressno = cleanme($_POST['addressno']);
        }

         // check if none of the field is empty
        if ( empty($userid) || empty($name) || empty($phone) || empty($lga) || empty($state) 
                || empty($country) || empty($address) || empty($address) || empty($zipcode) ){
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the user id, recipient name, recipient phone, local government area, state, country,
            address, and address number in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        // Check if the recipient phone number is a valid phone number
        if ( !validatePhone($phone) ){
            $errordesc = "Invalid recipient phone number";
            $linktosolve = 'https://';
            $hint = "pass a valid phone number in the recipient phone field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        $sqlQuery = 'INSERT INTO deliveryaddress (userid, lga, phoneno, fullname, state , country, zipcode, longitude, latitude, address, address_no) Values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';
        $addressStmt = $connect->prepare($sqlQuery);
        $addressStmt->bind_param("sssssssssss", $userid, $lga, $phone, $name, $state, $country, $zipcode, $longtitude, $latitude, $address, $addressno);

        if ( $addressStmt->execute() ) {
            $addressStmt->close();
            $text= "Delivery Address successfully added";
            $status = true;
            $data = array(
                'message' => "Delivery Address successfully added",
            );
            $successData = returnSuccessArray($text, $method, $endpoint, null, $data, $status);
            respondOK($successData);
        }else{
            $errordesc =  $stmt->error;
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
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);  
    }


?>