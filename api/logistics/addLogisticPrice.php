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

        $logisticid =checkIfLogistic($connect, $userpubkey);

        //check if user is admin
        if(!$logisticid){
            //respond not logistics
            $errordesc =  "User not a registered logistics";
            $linktosolve = 'https://';
            $hint = "Only registered logistics has the ability to access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
            

        // Check if the location id field is passed
        if (!isset($_POST['locationid'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required location id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $locationid = cleanme($_POST['locationid']);
        }

        // Check if the logistic minimum weight field is passed
        if (!isset($_POST['minWeight'])){
            $errordesc = "All fields must be passed";
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
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistic maximum weight field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $logisticMaxWeight = cleanme($_POST['maxWeight']);
        }

        // Check if the Logistic price field is passed
        if (!isset($_POST['price'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required Logistic price field accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $logisticPrice = cleanme($_POST['price']);
        }
        $status =1;

        if (empty($logisticMinWeight) || empty($logisticMaxWeight) || empty($logisticPrice)){
            
            // send error that values has not been sent for various fields
            $errordesc = "Insert value to all input fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistics id, logistics id, minmimum weigt, maximun weiht and price accepted field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
    

        if ( !is_numeric($logisticid) || !is_numeric($logisticMaxWeight) || !is_numeric($logisticMinWeight) || !is_numeric($logisticPrice) ){
            
            // send error if logistic max weight, logistic min weight, and logistic price is mot an integer or double
            $errordesc = "logistic max weight, logistic min weight, and logistic price is must be an integer or double";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required integer or double value in the logistic max weight, logistic min weight, and logistic price field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        //check if price exist for the location(cant have 2 price for 1 location)
            //select from price where locationid and logisticid
        //check if locationid exist
        $sqlQuery= "SELECT * FROM logistic_locations WHERE id = ? AND logistic_id = ? ";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("ss",  $locationid, $logisticid);
        $stmt->execute();
        $result = $stmt->get_result();

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

        if($result->num_rows > 0){
            $stmt->close();
            $sqlQuery = "INSERT INTO logistics_prices( logistic_id, lbsweightmin, lbsweightmaX, location_id, price, status) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt1 = $connect->prepare($sqlQuery);
            $stmt1->bind_param("ssssss",$logisticid, $logisticMinWeight, $logisticMaxWeight, $locationid, $logisticPrice, $status);
            $insertLogisticsPrice=$stmt1->execute();

            if($insertLogisticsPrice){
                //send mail($email, $password)
                //respond success message 
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "Logistics Inserted Successfully send mail to the logistics with details";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondInternalError($data);
            }else{
                $errordesc =  $stmt1->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                respondInternalError($data);
            }


        }else{
            //Location not found
            $errordesc="Location not found";
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Failed to insert price as Location not found";
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