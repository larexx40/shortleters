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

        $shop_id = checkIfShopOwner($connect, $user_pubkey);
        $logistics_id = checkIfLogistic($connect, $user_pubkey);
        $user = getUserWithPubKey($connect, $user_pubkey);


        // send error if ur is not in the database
        if (!$shop_id && !$logistics_id && !$user){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User not authorized to add complain database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $shop_id ) {
            $user_id = $shop_id;
            $user_type = "2";
        }
        if ( $logistics_id ){
            $user_id = $logistics_id;
            $user_type = "3";
        }
        if ( $user ){
            $user_id = $user;
            $user_type = "4";
        }

        if ( !isset($_POST['complaint']) ){

            // send error if complaint field is not passed
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required complaint field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }else{
            $complaint = cleanme($_POST['complaint']);
        }

        if (empty($complaint)){

            // send error if complaint field is empty
            $errordesc = "Kindly enter your complain";
            $linktosolve = 'https://';
            $hint = "User must pass complain, it can't be empty";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $adminseen = "0";
        $status = "0";

        $query = "INSERT INTO `usercomplains`(`user_id`, `complain`, `adminseen`, `status` ,`user_type`) VALUES (?, ?, ?, ?, ?)";
        $addComplain = $connect->prepare($query);
        $addComplain->bind_param("sssss", $user_id, $complaint, $adminseen, $status ,$user_type);

        if ( $addComplain->execute() ){
            $text= "Complain Successfully submitted";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc =  $addComplain->error;
        $linktosolve = 'https://';
        $hint = "500 code internal error, check ur database connections";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondInternalError($data);

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