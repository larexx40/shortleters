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

        if ( !is_numeric($logistics_id) || !is_numeric($location_id) || !is_numeric($location_max_weight) || !is_numeric($location_min_weight) || !is_numeric($location_price) ){
            
            // send error if location max weight, location min weight, and location price is mot an integer or double
            $errordesc = "location max weight, location min weight, and location price is must be an integer or double";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required integer or double value in the location max weight, location min weight, and location price field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }
        

        // Update the location price
        $Checkquery = "UPDATE logistics_prices SET lbsweightmin = ?, lbsweightmax = ?, price = ? WHERE logistic_id = ? AND location_id = ?";
        $stmt = $connect->prepare($Checkquery);
        $stmt->bind_param("sssss", $location_min_weight, $location_max_weight, $location_price, $logistics_id, $location_id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0){
            
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "Successfull Location Price Changed";
            $errordata = [];
            $text = "Location price successfully updated";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else{
            //invalid input/ server error
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid data, data already registered in the database.", "Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="invalid phoneno or DB issue";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
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