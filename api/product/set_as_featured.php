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
        $admin = checkIfIsAdmin($connect, $user_pubkey);
        $shop_id = checkIfShopOwner($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if ( !$admin && !$shop_id ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ( !isset($_POST['product_id']) ){

            $errordesc="product id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productId = cleanme($_POST['product_id']);
        }

        if ( empty($productId) ){

            $errordesc = "Enter Product id";
            $linktosolve = 'https://';
            $hint = "Kindly ensure that a valid id is passed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !isset($_POST['status']) ){
            $errordesc="Product status required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product status must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $status = cleanme($_POST['status']);
        }


        // check the status passed
        if ($status == 0 || $status === "inactive"){
            $changeStatus = 0;
            $changeStatusText = "Removed as Featured";
        }else{
            $changeStatus = "";
        }

        if ($status == 1 || $status === 'active'){
            $changeStatus = 1;
            $changeStatusText = "Set as Featured";
        }else{
            $changeStatus = "";
        }


        if ( $changeStatus > 0 && $changeStatus != 1){
            $errordesc = "Status passed is invalid ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the status passed is either active or inactive which is 1 and 0 respectively";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if product is valid
        if ( !checkifFieldExist($connect, "products", "productid", $productId) ) {

            $errordesc = "Product does not Exist ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the product id passed is for an existing product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        // update status
        $query = "UPDATE `products` SET `featured`= ? WHERE `productid` = ?";
        $updateStatus = $connect->prepare($query);
        $updateStatus->bind_param("ss", $changeStatus, $productId);
        $updateStatus->execute();

        if ($updateStatus->error){
            $errordesc =  $updateStatus->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }

        if ( $updateStatus->execute()){
            
            $data = [];
            $text= "Product successfully ". $changeStatusText;
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