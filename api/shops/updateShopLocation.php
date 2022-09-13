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
        $shop_id = getShopWithPubKey($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$shop_id ){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        

        if ( !isset($_POST['loc_id']) ){
            
            $errordesc="Shop Location id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Location id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopLocatonId = cleanme($_POST['loc_id']);
        }

        if ( !isset($_POST['location_name']) ){
            
            $errordesc="Shop name required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop name must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopName = cleanme($_POST['location_name']);
        }

        if ( !isset($_POST['shop_latitude'])) {

            $errordesc="Shop Latitude required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Latitude must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopLatitude = cleanme($_POST['shop_latitude']);
        }

        if ( !isset($_POST['shop_longtitude'])) {

            $errordesc="Shop Longtitude required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Latitude must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopLongtitude = cleanme($_POST['shop_longtitude']);
        }

        if (empty($shopLocatonId) || empty($shopName) || empty($shopLongtitude) || empty($shopLatitude) ){
            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the shop location id shop name, shop locations parameter in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!is_numeric($shopLocatonId) || !is_numeric($shopLatitude) || !is_numeric($shopLatitude) ){
            $errordesc = "Invalid Inputs";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to the shop location id,and shop locations parameter in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // insert the values to the shop location table 
        $query = "UPDATE `shop_locations` SET `name`= ?,`longitude`= ?,`latitude`= ? WHERE id = ?";
        $addShop = $connect->prepare($query);
        $addShop->bind_param("ssss", $shopName, $shopLongtitude, $shopLatitude, $shopLocatonId);
        $addShop->execute();
        $rows_affected = $addShop->affected_rows;

        if ( $addShop->error ){

            // send db error
            $errordesc =  $addShop->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);

        }

        if ( $rows_affected > 0 ){

            $data = [];
            $text= "Location successfully Updated";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

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