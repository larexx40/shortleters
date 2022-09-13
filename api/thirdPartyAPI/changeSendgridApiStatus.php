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
        $pubkey = $decodedToken->usertoken;

        if  (!checkIfIsAdmin($connect, $pubkey) ){

            // send user not found response to the user
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        if ( !isset($_POST['api_id']) ){
            // send error if status is not passed
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $api_id = cleanme($_POST['api_id']);
        }

        if ( !is_numeric($api_id) ){

            // send response if the id passed isn't numeric
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        // check if the address is in the database
        $query = 'SELECT * FROM sendgridapidetails WHERE id = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $api_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;
 
        if ($num_row < 1){
 
            // send response that the address is not in the database
            $errordesc = "Api not found";
            $linktosolve = 'https://';
            $hint = "Kindly pass the valid send grid field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
         
        }
 
        $one = 1;
        $zero = 0;

        // Set the current default address to 0
        $updateDefault = "UPDATE sendgridapidetails SET status = ? WHERE status = ? ";
        $updateStmt = $connect->prepare($updateDefault);
        $updateStmt->bind_param("ss", $zero, $one);
        $updateStmt->execute();

        // update the new address default address value as 1
        $updateDefault = "UPDATE sendgridapidetails SET status = ? WHERE id = ?";
        $updateStmt = $connect->prepare($updateDefault);
        $updateStmt->bind_param("ss", $one, $api_id);
        $updateStmt->execute();

        if ($updateStmt->error){
            // send db error
            $errordesc =  $queryStmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondInternalError($data);
        }

        if ( $updateStmt->affected_rows > 0 ){
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "Updated the address to the default address";
            $errordata = [];
            $text = "Default address successfully set";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        
        }else{

            //invalid input/ server error
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="invalid address id or Check DB connection";
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