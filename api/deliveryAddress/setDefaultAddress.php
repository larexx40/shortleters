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

        if(!checkIfUser($connect, $userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not registered";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $userid = checkIfUser($connect, $userpubkey);
        
        //check if address id is passed 
        if ( !isset($_POST['id']) ){
            $errordesc = "Address id must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $id = cleanme($_POST['id']);
        } 

        // check if the address is in the database
        $query = 'SELECT * FROM deliveryaddress WHERE id = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row < 1){

            // send response that the address is not in the database
            $errordesc = "Address not found";
            $linktosolve = 'https://';
            $hint = "Kindly pass the valid delivery address id in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        
        }

        $one = 1;
        $zero = 0;

        // Set the current default address to 0
        $updateDefault = "UPDATE deliveryaddress SET defultaddress = ? WHERE userid = ? AND defultaddress = ? ";
        $updateStmt = $connect->prepare($updateDefault);
        $updateStmt->bind_param("sss", $zero, $userid, $one);
        $updateStmt->execute();

        // update the new address default address value as 1
        $updateDefault = "UPDATE deliveryaddress SET defultaddress = ? WHERE id = ? AND userid = ? ";
        $updateStmt = $connect->prepare($updateDefault);
        $updateStmt->bind_param("sss", $one, $id, $userid);
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

    


    

