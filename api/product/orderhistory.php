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

    // check if the right request was sent
    if ($method == 'GET') {

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

        $orderQuery = 'SELECT * FROM productcart where user_id = ?';
        $orderStmt = $connect->prepare($orderQuery);
        $orderStmt->bind_param("s", $user_id);
        $orderStmt->execute();
        $orderResult =  $orderStmt->get_result();
        $order_row = $orderResult->num_rows;

        if ($order_row < 1){
            $text= "You don't have any current orders";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }else{
            $row = mysqli_fetch_assoc($result);

            echo json_encode($row); 
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