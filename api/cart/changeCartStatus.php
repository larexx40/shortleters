<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
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

        //check if user is admin or logistics
        //check if admin or logistic
        $logisticid = checkIfLogistic($connect, $userpubkey);
        $adminid =checkIfIsAdmin($connect, $userpubkey);

        if(!$adminid && !$logisticid){
            //return respond user not authorized
            $errordesc =  "User not allowed";
            $linktosolve = 'https://';
            $hint = "Only Admin and Loogistic can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        if ( !isset($_POST['id']) ){
            // send error if status is not passed
            $errordesc = "id must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $id = cleanme($_POST['id']);
        }

        if ( !isset($_POST['status']) ){
            // send error if status is not passed
            $errordesc = "cart status must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required status field ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $status = cleanme($_POST['status']);
        }

        if ($status == "Packing" || $status == 0){
            $changeStatus = 0;
            $message = "Packing";
        }
        if ($status == "Delivered" || $status == 1){
            $changeStatus = 1;
            $message = "Delivered";
        }
        if ($status == "Processing" || $status == 2){
            $changeStatus = 2;
            $message = "Processing";
        }
        if ($status == "Shipped" || $status == 3){
            $changeStatus = 3;
            $message = "Shipped";
        }
        if ($status == "Dispatched" || $status == 4){
            $changeStatus = 4;
            $message = "Dispatched";
        }
        if ($status == "Arrived" || $status == 5){
            $changeStatus = 5;
            $message = "Arrived";
        }
        if ($status == "Pending" || $status == 6){
            $changeStatus = 6;
            $message = "Pending";
        }

        if(empty($id)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require address information";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        // check if the logistic is in the database
        if(!checkIfExist($connect, "productcart", "id", $id)){
            //return error response
            $errordesc =  "cart with id does not exist";
            $linktosolve = 'https://';
            $hint = "Ensure you pass in valid cart id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        //set status to $changestatus
        $sqlQuery = "UPDATE productcart SET orderstatus_id = ? WHERE id = ? ";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("ss", $changeStatus, $id);
        $stmt->execute();
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

        if($affectedRow > 0){
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "logistic status set";
            $errordata = [];
            $text = "logistic successfully $message";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        
        }else{
            //invalid input || server error
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="invalid logistic id or Check DB connection";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
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