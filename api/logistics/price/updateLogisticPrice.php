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

        if (!isset($_POST['id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistic price id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $logisticPriceid = cleanme($_POST['id']);
        }

        // Check if the logistic minimum weight field is passed
        if (!isset($_POST['minWeight'])){
            $errordesc = "logisticMinWeight must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistic minimum weight field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $logisticMinWeight = cleanme($_POST['minWeight']);
        }

        // Check if the logistic minimum weight field is passed
        if (!isset($_POST['maxWeight'])){
            $errordesc = "logisticMaxWeight must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistic maximum weight field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $logisticMaxWeight = cleanme($_POST['maxWeight']);
        }

        // Check if the logistic price field is passed
        if (!isset($_POST['price'])){
            $errordesc = "price must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistic price field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $logisticPrice = cleanme($_POST['price']);
        }

        //check if its numeric
        if(!is_numeric($logisticPriceid)){
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="pass in valid id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        if (empty($logisticMinWeight) || empty($logisticMaxWeight) || empty($logisticPrice)|| empty($logisticPriceid)){
            // send error if logistic max weight, logistic min weight, and logistic price is mot an integer or double
            $errordesc = "logistic max weight, logistic min weight, and logistic price is must be an integer or double";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required integer or double value in the logistic max weight, logistic min weight, and logistic price field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data); 
        }
        
        // Update the logistic price
        $query = "UPDATE logistics_prices SET lbsweightmin = ?, lbsweightmax = ?, price = ? WHERE logistic_id = ? AND id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sssss", $logisticMinWeight, $logisticMaxWeight, $logisticPrice, $logisticsid, $logisticPriceid);
        $updatePrice = $stmt->execute();
        $affectedRow = $stmt->affected_rows;

        if(!$stmt->execute()){
            //DB error || invalid input
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Database comection error";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }
        
        if ($affectedRow > 0){
            //return success message
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = " Logistic Price Changed";
            $errordata = [];
            $text = "Logistic price successfully updated";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else{
            //price id not found
            $errordesc="Price not found";
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Fail to update price as price not found";
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
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);
        
    }

?>