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

        // send error if ur is not in the database
        if (!getUserWithPubKey($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not found";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $user_id = getUserWithPubKey($connect, $user_pubkey);

        if ( !isset($_POST['id']) ){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $id = cleanme($_POST['id']);
        }

        if ( !is_numeric($id) ){

            $errordesc = "Invalid Address id ";
            $linktosolve = 'https://';
            $hint = "Kindly pass the valid delivery address field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

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
            $hint = "Kindly pass the valid delivery address field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }

        $one = 1;
        $zero = 0;

        // Set the current default address to 0
        $updateDefault = "UPDATE deliveryaddress SET defultaddress = ? WHERE userid = ? AND defultaddress = ? ";
        $updateStmt = $connect->prepare($updateDefault);
        $updateStmt->bind_param("isi", $zero, $user_id, $one);
        $updateStmt->execute();

        // update the new address default address value as 1
        $updateDefault = "UPDATE deliveryaddress SET defultaddress = ? WHERE id = ? AND userid = ? ";
        $updateStmt = $connect->prepare($updateDefault);
        $updateStmt->bind_param("iis", $one, $id, $user_id);
        $updateStmt->execute();
        $row_affected = $updateStmt->affected_rows;

        // if ( $updateStmt->affected_rows > 0 ){
        if ( $row_affected > 0 ){
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
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);

    }

    


    

