<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../../cartsfunction.php";
    
  

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

        //check if user is admin
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
        if (!isset($_POST['id'])){
            $errordesc = "Locationid must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $locationid = cleanme($_POST['id']);
        }
        if (!isset($_POST['locationName'])){
            $errordesc = "Location name must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $locationName = cleanme($_POST['locationName']);
        }

        if (!isset($_POST['longitude'])){
            $errordesc = "Longitude must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $longitude = cleanme($_POST['longitude']);
        }

        if (!isset($_POST['latitude'])){
            $errordesc = "Latitude must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $latitude = cleanme($_POST['latitude']);
        }
        //add longitude and latitude too

        if ( empty($locationName) || empty($locationid)){
            // send error that values has not been sent for various fields
            $errordesc = "Insert value to all input fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistics id, logistics id, minmimum weigt, maximun weiht and price accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        //UPDATE `logistic_locations` 
        $updateQuery = 'UPDATE `logistic_locations` SET `name` = ?, `longitude`= ?, `latitude` = ? WHERE id = ? AND `logistic_id` =? ';
        $stmt = $connect->prepare($updateQuery);
        $stmt->bind_param("sssss",$locationName, $longitude, $latitude,$locationid, $logisticsid,);

        if ( $stmt->execute() ){
            // send response that all is okay
            $stmt->close();
            $text= "Location successfully UPDATED";
            $status = true;
            $data = array(
                'message' => "$locationName successfully UPDATES",
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
       $hint = "This route only accepts GET request, kindly pass a post request";
       $errorData = returnError7003($errordesc, $linktosolve, $hint);
       $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
       respondMethodNotAlowed($data); 

    }