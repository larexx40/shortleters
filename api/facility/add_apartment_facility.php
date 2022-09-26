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

        // Get company private key
        $query = 'SELECT * FROM apidatatable';
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row =  mysqli_fetch_assoc($result);
        $companykey = $row['privatekey'];
        $servername = $row['servername'];
        $expiresIn = $row['tokenexpiremin'];

        $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        $user_pubkey = $decodedToken->usertoken;

        $user =  getUserWithPubKey($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$user){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        // Check if the recipient name field is passed
        if (!isset($_POST['facility_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required facility id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $facility_id = cleanme($_POST['facility_id']);
        }

        if (!isset($_POST['apartment_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required apartment id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apartment_id = cleanme($_POST['apartment_id']);
        }

        if (!isset($_POST['number'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required number field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $number = cleanme($_POST['number']);
        }
        
         // check if none of the field is empty
        if ( empty($facility_id) || empty($apartment_id) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !is_numeric($number) ){

            $errordesc = "Insert a valid number";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!checkifFieldExist($connect, "facilities", "facility_id", $facility_id)){
            $errordesc = "Amenity id not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ( !checkifFieldExist($connect, "apartments", "apartment_id", $apartment_id) ){
            $errordesc = "Apartment not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        
        $apart_facility_id = generateUniqueShortKey($connect, "apartment_facilities", "apart_facility_id ");


        $query = 'INSERT INTO `apartment_facilities`(`apart_facility_id`, `apartment_id`, `facility_id`, `total_number`) VALUES (?, ?, ?, ?) ';
        $slider_stmt = $connect->prepare($query);
        $slider_stmt->bind_param("ssss", $apart_facility_id, $apartment_id, $facility_id, $number);

        if ( $slider_stmt->execute() ) {
            $text= "Apartment Facility successfully added";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc =  $slider_stmt->error;
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