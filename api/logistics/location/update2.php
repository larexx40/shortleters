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

        // get if the user is a shop
        
        // send error if ur is not in the database
        if (!checkIfShopOwner($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not Admin";
            $linktosolve = 'https://';
            $hint = "Admin only have access to add Shop";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        $shop_id = checkIfShopOwner($connect, $user_pubkey);

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

        if ( !isset($_POST['shop_address'])) {

            $errordesc="Shop Address required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Address must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopAddress = cleanme($_POST['shop_address']);
        }

        if ( !isset($_POST['min_cost'])) {

            $errordesc="Minimum cost accepted is  required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Minimum cost must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $minCost = cleanme($_POST['min_cost']);
        }

        if ( !isset($_POST['open_time'])) {

            $errordesc="Opening Time is  required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Minimum cost must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $openTime = cleanme($_POST['open_time']);
        }

        if ( !isset($_POST['close_time'])) {

            $errordesc="Closing Time is  required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Closing Time must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $closeTime = cleanme($_POST['close_time']);
        }

        if ( !isset($_POST['description'])) {

            $errordesc="Description is  required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Description must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $description = cleanme($_POST['description']);
        }
        


        

        if (empty($shopName) || empty($shopCity) || empty($shopCountry) || empty($shopEmail) || empty($shopPhone) || empty($shopWhatsApp || empty($shopPassword)
            || empty($shopType) || empty($shop_username))  ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }

        if ($shopType == "Gadget"){
            $shopType = 1;
        }else{
            $shopType = 1;
        }

        if ( !validatePhone($shopPhone) || !validatePhone($shopWhatsApp) ){
            
            $errordesc = "Invalid Phone number passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid phone number to the Phone field and whatsapp field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        if ( !is_numeric($minCost) ){
            // send response if time passed is invalid
            $errordesc = "Invalid minimum cost passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid minimum cost to the mincost field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        if ( !strtotime($openTime) || !strtotime($closeTime) ){
            // send response if time passed is invalid
            $errordesc = "Invalid Phone number passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid phone number to the Phone field and whatsapp field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        $open_time = strtotime($openTime);
        $close_time = strtotime($closeTime);

        // $error = checkifFieldisUnique($connect, "shops", "office_phone", $shopPhone);
        if ($error){
            // Phone must be unique
            $errordesc = "Shop ". $error;
            $linktosolve = 'https://';
            $hint = "Kindly ensure the shop email, name, phone and username is unique";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        $acceptOrder = 1;
        $openStatus = 1;

        // insert the values to the shop location table 
        $query = "UPDATE `shops` SET `country`= ?,`address`= ?,`city`= ?,`accept_order`= ?,`min_cost`= ?,`open_time`= ?,`close_time`= ?,`office_phone`= ?,`office_whatapp`= ?,`description`= ?,`openstatus`= ?,`shoptype`= ?, WHERE id = ?";
        $updateShop = $connect->prepare($query);
        $updateShop->bind_param("sssisss", $shopCountry, $shopAddress, $shopCity, $acceptOrder, $minCost, $open_time, $close_time, $shopPhone, $shopWhatsApp, $description, $openStatus, $shopType, $shop_id);

        if ( $updateShop->execute() ){
            $data = [];
            $text= "Shop successfully Updated";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, null, $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $updateShop->error;
        $linktosolve = 'https://';
        $hint = "500 code internal error, check ur database connections";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondInternalError($data);

    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);
        
    }
?>