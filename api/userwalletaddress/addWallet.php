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
        if (!getUserWithPubKey($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not logistics";
            $linktosolve = 'https://';
            $hint = "logistics only have access to add tracking history";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $user_id = getUserWithPubKey($connect, $user_pubkey);

        if ( !isset($_POST['cointype']) ){

            $errordesc="coin type is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="coin type must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $cointype = cleanme($_POST['cointype']);
        }

        if ( !isset($_POST['useraddress'])) {

            $errordesc="useraddress required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="useraddress must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $useraddress = cleanme($_POST['useraddress']);
        }

        if ( !isset($_POST['producttrackid'])) {

            $errordesc="producttrack id is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product track id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $producttrackid = cleanme($_POST['producttrackid']);
        }

        if ( !isset($_POST['memo'])) {

            $errordesc="memo required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="memo must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $memo = cleanme($_POST['memo']);
        }

        if ( !isset($_POST['systemlivewallet'])) {

            $errordesc="systemlivewallet required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="systemlivewallet must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $systemlivewallet = cleanme($_POST['systemlivewallet']);
        }

        if ( !isset($_POST['liveaddressid'])) {

            $errordesc="liveaddressid required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="liveaddressid must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $liveaddressid = cleanme($_POST['liveaddressid']);
        }

        if ( !isset($_POST['redeemscript'])) {

            $errordesc="redeemscript required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="redeemscript must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $redeemscript = cleanme($_POST['redeemscript']);
        }

        if ( !isset($_POST['wallettrackid'])) {

            $errordesc="wallettrackid required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="wallettrackid must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $wallettrackid = cleanme($_POST['wallettrackid']);
        }
        

        if ( empty($cointype) || empty($useraddress) || empty($producttrackid) || empty($memo) || empty($systemlivewallet) || empty($liveaddressid) || empty($redeemscript) || empty($wallettrackid) ){

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        // check if the producktrackid and coin are valid
        $query = 'SELECT * FROM `coinproducts` WHERE `producttrackid` = ? AND `cointype` = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $producttrackid, $cointype);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row < 1){
            // Send error response
            $errordesc = "Invalid coin product or coin type";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        $walletbalance = 0;


        // insert the values to the shop location table 
        $query = "INSERT INTO `userwalletaddresses`(
            `userid`,
            `cointype`,
            `useraddress`,
            `producttrackid`,
            `memo`,
            `systemlivewallet`,
            `liveaddressid`,
            `redeemscript`,
            `wallettrackid`,
            `walletbal`
        )
        VALUES(
            ?,?,?,?,?,?,?,?,?,?
        )";
        $addWallet = $connect->prepare($query);
        $addWallet->bind_param("ssssssssss", $user_id, $cointype, $useraddress, $producttrackid, $memo, $systemlivewallet, $liveaddressid, $redeemscript, $wallettrackid, $walletbalance);

        if ( $addWallet->execute() ){
            $data = [];
            $text= "Wallet successfully added";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $addWallet->error;
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