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

    if ( $method == 'POST'){

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
        
        $user_id = getUserWithPubKey($connect, $user_pubkey);

        // send error if user is not in the database
        if ( !$user_id ){
            // send user not found response to the user
            $errordesc =  "User not found";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }

        if (!isset($_POST['address_id'])){
            // send error if id of the address to delete isn't passed
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $address_id = cleanme($_POST['address_id']);
        }

        if ( !is_numeric($address_id) ){

            $errordesc = "Invalid address id";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid value in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        

        // check if address id is passed;

        $deleteAdresQry = 'DELETE FROM deliveryaddress WHERE id = ? AND userid = ?';
        $deleteStmt = $connect->prepare($deleteAdresQry);
        $deleteStmt->bind_param("ss", $address_id, $user_id);
        $deleteStmt->execute();
        $row_deleted = $deleteStmt->affected_rows;

        if ( $row_deleted > 0 ){
            // send response to user that address has been deleted
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "Address has been Deleted in the database";
            $errordata = [];
            $text = "Address successfully deleted";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            $errordesc = "Address not Found";
            $linktosolve = 'https://';
            $hint = "DB error or invaid input, kindly check your input and the database connection";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $errordesc = $deleteStmt->error;
        $linktosolve = 'https://';
        $hint = "DB error or invaid input, kindly check your input and the database connection";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondBadRequest($data);

        
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