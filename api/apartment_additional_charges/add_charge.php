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

        $user =  checkIfUser($connect, $user_pubkey);

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

        
        // Check if the email field is passed
        if (!isset($_POST['apartment_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apartment_id = cleanme($_POST['apartment_id']);
        }

        if (!isset($_POST['add_charg_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $add_charg_id = cleanme($_POST['add_charg_id']);
        }

        // Check if the recipient name field is passed
        if (!isset($_POST['price'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $price = cleanme($_POST['price']);
        }
        
         // check if none of the field is empty
        if ( empty($apartment_id)  || empty($price) || empty($add_charg_id) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $apart_chrg_id = generateUniqueShortKey($connect, "apartment_additional_charge", "apart_chrg_id ");



        $query = 'INSERT INTO `apartment_additional_charge`(`apart_chrg_id`, `apartment_id`, `add_charg_id`, `price`) VALUES (? , ?, ?, ?)';
        $slider_stmt = $connect->prepare($query);
        $slider_stmt->bind_param("ssss", $apart_chrg_id, $apartment_id, $add_charg_id, $price);

        if ( $slider_stmt->execute() ) {
            $text= "Additional Charge successfully added";
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