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

        // Check if the logistics id field is passed
        if (!isset($_POST['logistics_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistics id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $logistics_id = cleanme($_POST['logistics_id']);
        }

        // Check if the location id field is passed
        if (!isset($_POST['location_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required location id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $location_id = cleanme($_POST['location_id']);
        }

        // Check if the location minimum weight field is passed
        if (!isset($_POST['min_weight'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required location minimum weight field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $location_min_weight = cleanme($_POST['min_weight']);
        }

        // Check if the location minimum weight field is passed
        if (!isset($_POST['max_weight'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required location maximum weight field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $location_max_weight = cleanme($_POST['max_weight']);
        }

        // Check if the location price field is passed
        if (!isset($_POST['price'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required location price field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $location_price = cleanme($_POST['price']);
        }

        if (empty($location_min_weight) || empty($location_max_weight) || empty($location_price)){
            
            // send error that values has not been sent for various fields
            $errordesc = "Insert value to all input fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistics id, logistics id, minmimum weigt, maximun weiht and price accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }
    

        if ( !is_numeric($logistics_id) || !is_numeric($location_id) || !is_numeric($location_max_weight) || !is_numeric($location_min_weight) || !is_numeric($location_price) ){
            
            // send error if location max weight, location min weight, and location price is mot an integer or double
            $errordesc = "location max weight, location min weight, and location price is must be an integer or double";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required integer or double value in the location max weight, location min weight, and location price field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }

        // Check if location is in the DB
        $Checkquery = 'SELECT * FROM logistics_prices where location_id = ?';
        $stmt = $connect->prepare($Checkquery);
        $stmt->bind_param("s", $location_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){

            // send response that the address is not in the database
            $errordesc = "Location Price already added kindly update";
            $linktosolve = 'https://';
            $hint = "Location already in the database, can only be updated";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }

        $addressQuery = 'INSERT INTO logistics_prices (logistic_id, lbsweightmin, lbsweightmax, location_id, price) Values (?, ?, ?, ?, ?);';
        $addressStmt = $connect->prepare($addressQuery);
        $addressStmt->bind_param("sssss", $logistics_id, $location_min_weight, $location_max_weight, $location_id, $location_price);

        if ( $addressStmt->execute() ) {
            $addressStmt->close();

            $text= "Location Price successfully added";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
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