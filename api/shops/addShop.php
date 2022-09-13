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

    // check if the right request was sent
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

        $admin_id = checkIfIsAdmin($connect, $user_pubkey);

        // get if the user is a shop
        
        // send error if ur is not in the database
        if ( !$admin_id ){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "Admin only have access to add Shop";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ( !isset($_POST['shopname']) ){

            $errordesc="Shop name required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop name must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopName = cleanme($_POST['shopname']);
        }

        if ( !isset($_POST['shop_country'])) {

            $errordesc="Shop Country required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Country must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopCountry = cleanme($_POST['shop_country']);
        }

        if ( !isset($_POST['shop_city'])) {

            $errordesc="Shop City required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop City must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopCity = cleanme($_POST['shop_city']);
        }

        if ( !isset($_POST['shop_password'])) {

            $errordesc="Shop Password required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Password must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopPassword = cleanme($_POST['shop_password']);
        }

        if ( !isset($_POST['shop_email'])) {

            $errordesc="Shop email required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop email must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopEmail = cleanme($_POST['shop_email']);
        }

        if ( !isset($_POST['shop_phone'])) {

            $errordesc="Shop Phone required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Password must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopPhone = cleanme($_POST['shop_phone']);
        }

        if ( !isset($_POST['shop_whatsapp'])) {

            $errordesc="Shop WhatsApp Phone required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop WhatsApp Phone must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopWhatsApp = cleanme($_POST['shop_whatsapp']);
        }

        if ( !isset($_POST['shop_type'])) {

            $errordesc="Shop Type required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Type must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopType = cleanme($_POST['shop_type']);
        }

        if ( !isset($_POST['shop_currency'])) {

            $errordesc="Shop username required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop username must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shop_currency = cleanme($_POST['shop_currency']);
        }
        

        if (empty($shopName) || empty($shopCity) || empty($shopCountry) || empty($shopEmail) || empty($shopPhone) || empty($shopWhatsApp || empty($shopPassword)
            || empty($shopType) || empty($shop_currency))  ){

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if ($shopType == "gadget"){
            $shopType = 1;
        }else{
            $shopType = 1;
        }

        if ( !validateEmail($shopEmail) ){
            // Insert all fields
            $errordesc = "Invalid Email passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid email address";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !validatePhone($shopPhone) || !validatePhone($shopWhatsApp) ){
            // Insert all fields
            $errordesc = "Invalid Phone number passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid phone number to the Phone field and whatsapp field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !validatePassword($shopPassword) ){
            // Insert all fields
            $errordesc = "Password not strong enough";
            $linktosolve = 'https://';
            $hint = "Kindly ensure your password is of 8 characters, has uppercase, has lowercase, has number and has special characters";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // $response = checkIfLogisticOrShopIsUnique($connect, "shops", $shopName, $shopEmail, "");

        // if ($response){
        //     // All parameters must be unique
        //     $errordesc = "Shop ". $response;
        //     $linktosolve = 'https://';
        //     $hint = "Kindly ensure the shop email, name, phone and username is unique";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondBadRequest($data);
        // }

        $error = checkifFieldisUnique($connect, "shops", "office_phone", $shopPhone);
        if ($error){
            // Phone must be unique
            $errordesc = "Shop ". $error;
            $linktosolve = 'https://';
            $hint = "Kindly ensure the shop email, name, phone and username is unique";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        $hashedPassword = Password_encrypt($shopPassword);
        $shop_pubkey = generateUserPubKey($connect, "shops");

        // insert the values to the shop location table 
        $query = "INSERT INTO `shops`(`name`, `country`, `city`, `office_phone`, `office_whatapp`, `shop_email`, `shoptype`, `userpubkey`, `password`, `currency`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $addShop = $connect->prepare($query);
        $addShop->bind_param("ssssssssss", $shopName, $shopCountry, $shopCity, $shopPhone, $shopWhatsApp, $shopEmail, $shopType, $shop_pubkey, $hashedPassword, $shop_currency);

        if ( $addShop->execute() ){
            $data = array(
                'password' => $shopPassword
            );
            $text= "Shop successfully added";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $addShop->error;
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