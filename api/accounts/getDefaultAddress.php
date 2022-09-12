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

        $user_id = getUserWithPubKey($connect, $user_pubkey);

        if (!$user_id){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!is_numeric($user_id) ){
            $errordesc =  "Invalid id format sent";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $status = "1";

        $query = "SELECT * FROM `deliveryaddress` WHERE `defultaddress` = ? AND `userid` = ?";
        $getDefaultAddress = $connect->prepare($query);
        $getDefaultAddress->bind_param("ss", $status, $user_id);
        $getDefaultAddress->execute();
        $result = $getDefaultAddress->get_result();
        $num_row = $result->num_rows;

        // if ( $num_row > 0 ){
            $row = mysqli_fetch_assoc($result);

            $address = [
                "id" => ( $row ) ? $row['id'] : "",
                'user_id' => ( $row ) ? $row['userid'] : "",
                'user_fullname' => (!empty($user_id) ) ? getUserFullname($connect, $user_id) : "",
                'recipient_fullname' => ( $row ) ? $row['fullname'] : "", 
                'phone' => ( $row ) ? $row['phoneno'] : "",
                'longtitude' => ( $row ) ? $row['longitude'] : "",
                'latitude' => ( $row ) ? $row['latitude'] : "",
                'default' => ( $row ) ? $row['defultaddress'] : "",
                'addressno' => ( $row ) ? $row['address_no'] : "",
                'address' => ( $row ) ? $row['address'] : "",
                'lga' => ( $row ) ? $row['lga'] : "",
                'address_state' => ( $row ) ? $row['state'] : "",
                'address_country' => ( $row ) ? $row['country'] : "",
                'zipCode' => ( $row ) ? $row['zipcode'] : "",
            ];

            $data = $address;
            $text= "Address Fetched";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        // }
    
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