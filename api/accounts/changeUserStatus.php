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
        if (!checkIfIsAdmin($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "User not authorized to change user status";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // $user_id = getUserWithPubKey($connect, $user_pubkey);
        
        // Check if the user id field is passed
        if (!isset($_POST['user_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $user_id = cleanme($_POST['user_id']);
        }

        // Check if the email field is passed
        if (!isset($_POST['status'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $status = cleanme($_POST['status']);
        }

         // check if none of the field is empty
         if ( empty($user_id) || ( empty($status) && !is_numeric($status) ) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the user id, recipient name, recipient phone, local government area, state, country,
            address, and address number in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if id is a valid one
        if ( !checkIfUserisInDB($connect, $user_id) ){
            $errordesc = "User not in the db";
            $linktosolve = 'https://';
            $hint = "Kindly a pass a valid user in the database ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ($status == "ban" || $status == 0){
            $changeStatus = 0;
            $message = "banned";
        }
        if ($status == "active" || $status == 1){
            $changeStatus = 1;
            $message = "activated";
        }
        if ($status == "suspend" || $status == 2){
            $changeStatus = 2;
            $message = "suspended";
        }
        if ($status == "frozen" || $status == 3){
            $changeStatus = 3;
            $message = "frozen";
        }

        $details = getFieldsDetails($connect, "users", "id", $user_id);
        $is_agent = $details['details']['is_agent'];
        
        if ( $is_agent > 0){
            if ( $changeStatus != 1){
                if ( $changeStatus < 1){
                    $apart_status = 4;
                }
                if ( $changeStatus == 2){
                    $apart_status = 3;
                }
                if ( $changeStatus == 3){
                    $apart_status = 2;
                }
                $deactivate_apartments = "UPDATE `apartments` SET `apartment_status`= ? WHERE `agent_id` = ?";
                $execute = $connect->prepare($deactivate_apartments);
                $execute->bind_param("ss", $apart_status, $user_id);
                $execute->execute();

                if ( $execute->error ){
                    $errordesc =  $execute->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondInternalError($data);
                }
            }else{
                $apart_status = 1;
                $activate_apartments = "UPDATE `apartments` SET `apartment_status`= ? WHERE `agent_id` = ?";
                $execute = $connect->prepare($activate_apartments);
                $execute->bind_param("ss", $apart_status, $user_id);
                $execute->execute();

                if ( $execute->error ){
                    $errordesc =  $execute->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondInternalError($data);
                }

            }
        }



        

        $userQuery = 'UPDATE
        `users`
    SET
        `status` = ?
    WHERE
        id = ?';
        $updateStmt = $connect->prepare($userQuery);
        $updateStmt->bind_param("ss", $changeStatus, $user_id);

        if ( $updateStmt->execute() ) {
            $updateStmt->close();

            $text= "User successfully " . $message;
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc =  $updateStmt->error;
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