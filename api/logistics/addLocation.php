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
        //Get company private key for jwtauth
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        //check if user is a registered logistic
        if(!checkIfLogistic($connect, $userpubkey)){
            //respond not logistics
            $errordesc =  "User not a registered logistics";
            $linktosolve = 'https://';
            $hint = "Only registered logistics has the ability to access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        $logisticsid =checkIfLogistic($connect, $userpubkey);    

        // Check if the location name field is passed
        if (!isset($_POST['locationName'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $locationName = cleanme($_POST['locationName']);
        }

        if (!isset($_POST['longitude'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $longitude = cleanme($_POST['longitude']);
        }

        if (!isset($_POST['latitude'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $latitude = cleanme($_POST['latitude']);
        }
        //add longitude and latitude too

        if ( empty($locationName) ){
            // send error that values has not been sent for various fields
            $errordesc = "Insert value to all input fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistics id, logistics id, minmimum weigt, maximun weiht and price accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $status = 1;
            $insertQuery = 'INSERT INTO logistic_locations (`logistic_id`, `name`, `longitude`, `latitude`, status) Values (?, ?, ?,?,?);';
            $insertStmt = $connect->prepare($insertQuery);
            $insertStmt->bind_param("sssss", $logisticsid, $locationName, $longitude, $latitude, $status);
    
            if ( $insertStmt->execute() ){
                // send response that all is okay
                $insertStmt->close();
                $text= "Location successfully added";
                $status = true;
                $data = [];
                $successData = returnSuccessArray($text, $method, $endpoint, null, $data, $status);
                respondOK($successData);
    
            }else{
    
                $errordesc =  $insertStmt->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                respondInternalError($data);
    
            }
        }
       

    }else{

       // Send an error response because a wrong method was passed 
       $errordesc = "Method not allowed";
       $linktosolve = 'https://';
       $hint = "This route only accepts GET request, kindly pass a post request";
       $errorData = returnError7003($errordesc, $linktosolve, $hint);
       $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
       respondMethodNotAlowed($data); 

    }