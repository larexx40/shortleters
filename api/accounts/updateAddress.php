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

        $user_id = getUserWithPubKey($connect, $user_pubkey);

        // send error if user is not in the database
        if ( !$user_id ){
            // send user not found response to the user
            $errordesc =  "User Not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

         // Check if the email field is passed
        if (!isset($_POST['address_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $address_id = cleanme($_POST['address_id']);
        }

        
        // Check if the recipient name field is passed
        if (!isset($_POST['recipient_name'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required recipient name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $recipient_name = cleanme($_POST['recipient_name']);
        }

        // Check if the recipient phone field is passed
        if (!isset($_POST['recipient_phone'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required recipient phone number field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $recipient_phone = cleanme($_POST['recipient_phone']);
        }

        // Check if the local government field is passed
        if (!isset($_POST['lga'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required local government area field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $lga = cleanme($_POST['lga']);
        }

        // Check if the state field is passed
        if (!isset($_POST['state'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address state field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $state = cleanme($_POST['state']);
        }

        // Check if the country field is passed
        if (!isset($_POST['country'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required country field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $country = cleanme($_POST['country']);
        }

        // Check if the zipcode field is passed
        if (!isset($_POST['zipcode'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required zip code field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $zipcode= cleanme($_POST['zipcode']);
        }

        // Check if the longitude field is passed
        if (!isset($_POST['longtitude'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required longtitude field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $longtitude = cleanme($_POST['longtitude']);
        }

        // Check if the latitude field is passed
        if (!isset($_POST['latitude'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required latitude field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $latitude = cleanme($_POST['latitude']);
        }

        // Check if the address field is passed
        if (!isset($_POST['address'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required full address field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $address = cleanme($_POST['address']);
        }

        // Check if the address number field is passed
        if (!isset($_POST['address_no'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address number field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $address_no = cleanme($_POST['address_no']);
        }

         // check if none of the field is empty
         if ( empty($user_id) || empty($recipient_name) || empty($recipient_phone) || empty($lga) || empty($state) 
                || empty($country) || empty($address) || empty($address_no) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the user id, recipient name, recipient phone, local government area, state, country,
            address, and address number in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!validatePhone($recipient_phone)){

                $errordesc = "Invalid Phone Number";
                $linktosolve = 'https://';
                $hint = "Kindly pass value to the user id, recipient name, recipient phone, local government area, state, country,
                address, and address number in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
        }

        // Update the address
        $updateQuery = 'UPDATE deliveryaddress SET lga = ?, phoneno = ?, fullname = ?, state = ?, country = ?, zipcode = ?, longitude = ?, latitude = ?, address = ?, address_no = ? WHERE id = ? AND userid = ?';
        $statement = $connect->prepare($updateQuery);
        $statement->bind_param('ssssssssssis', $lga,$recipient_phone, $recipient_name, $state, $country, $zipcode, $longtitude, $latitude, $address, $address_no, $address_id, $user_id);
        $statement->execute();

        if ($statement->affected_rows > 0){
            // send response to user that his or her address has been updated
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "Address has been updated in the database";
            $errordata = [];
            $text = "Address successfully updated";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //invalid input/ server error
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid data, data already registered in the database."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="invalid address data passed or DB issue";
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
?>