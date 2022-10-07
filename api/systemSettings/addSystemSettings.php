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
        $admin =  checkIfIsAdmin($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$admin){
            // send user not found response to the user
            $errordesc =  "User not admin";
            $linktosolve = 'https://';
            $hint = "Only admin is authourised to access this route.";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        // Check if the email field is passed
        if (!isset($_POST['name'])){
            $errordesc = "name must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $name = cleanme($_POST['name']);
        }

        if (!isset($_POST['iosversion'])){
            $errordesc = "iosversion must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $iosversion = cleanme($_POST['iosversion']);
        }

        if (!isset($_POST['androidversion'])){
            $errordesc = "androidversion must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $androidversion = cleanme($_POST['androidversion']);
        }

        if (!isset($_POST['webversion'])){
            $errordesc = "webversion must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $webversion = cleanme($_POST['webversion']);
        }
        
        // Check if the recipient name field is passed
        if (!isset($_POST['activesmssystem'])){
            $errordesc = "Activesmssystem must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required activesmssystem field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $activesmssystem = cleanme($_POST['activesmssystem']);
        }

        if (!isset($_POST['activemailsystem'])){
            $errordesc = "activemailsystem must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required activemailsystem field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $activemailsystem = cleanme($_POST['activemailsystem']);
        }

        if (!isset($_POST['min_apart_photo'])){
            $errordesc = "min_apart_photo fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required min_apart_photo field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $min_apart_photo = cleanme($_POST['min_apart_photo']);
        }

        if (!isset($_POST['max_apart_highlights'])){
            $errordesc = "max_apart_highlights fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required max_apart_highlights field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $max_apart_highlights = cleanme($_POST['max_apart_highlights']);
        }

        if (!isset($_POST['discount_perc'])){
            $errordesc = "discount_perc fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required discount_perc field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $discount_perc = cleanme($_POST['discount_perc']);
        }

        if (!isset($_POST['discount_guest'])){
            $errordesc = "discount_guest fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required discount_guest field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $discount_guest = cleanme($_POST['discount_guest']);
        }
        
        // check if none of the fields are empty
        if (empty($name)||empty($iosversion)||empty($systemSettingsid)||empty($androidversion)||empty($webversion)||empty($activesmssystem)|| 
            empty($min_apart_photo)  || empty($max_apart_highlights) || empty($discount_perc) || empty($discount_guest) ){
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $systemSettingsid = generateUniqueShortKey($connect, "systemsettings", "sys_setting_id ");

        $query = 'INSERT INTO `systemsettings`(`sys_setting_id`, `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`,
                `activemailsystem`, `min_apart_photo`, `max_apart_highlights`, `discount_perc`, `discount_guest`) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        $insertStmt = $connect->prepare($query);
        $insertStmt->bind_param("sssssssssss", $systemSettingsid, $name, $iosversion, $androidversion, $webversion, $activesmssystem, $activemailsystem, $min_apart_photo,  $max_apart_highlights, $discount_perc, $discount_guest);

        if ( $insertStmt->execute() ) {
            $text= "Slider successfully added";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc =  $insertStmt->error;
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