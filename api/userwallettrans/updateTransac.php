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
        if (!checkIfIsAdmin($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized admin allowed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $admin_id = checkIfIsAdmin($connect, $user_pubkey);

        if ( !isset($_POST['orderid']) ){

            $errordesc=" orderid is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="orderid into must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $orderid = cleanme($_POST['orderid']);
        }

        if ( !isset($_POST['addresssentto']) ){

            $errordesc="address into is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Address into must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $addresssentto = cleanme($_POST['addresssentto']);
        }

        if ( !isset($_POST['transhash'])) {

            $errordesc="trans hash required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="trans hash must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $transhash = cleanme($_POST['transhash']);
        }

        if ( !isset($_POST['livetransid'])) {

            $errordesc="live trans id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="live trans id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $livetransid = cleanme($_POST['livetransid']);
        }

        if ( !isset($_POST['liveusdrate'])) {

            $errordesc="live usd rate required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="live usd rate must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $liveusdrate= cleanme($_POST['liveusdrate']);
        }

        if ( !isset($_POST['confirmation'])) {

            $errordesc="confirmation required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="confirmation must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $confirmation = cleanme($_POST['confirmation']);
        }

        if ( !isset($_POST['syslivewallet'])) {

            $errordesc="syslivewallet required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="syslivewallet must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $syslivewallet = cleanme($_POST['syslivewallet']);
        }

        if ( !isset($_POST['cointrackid'])) {

            $errordesc="cointrackid required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="cointrackid must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $cointrackid = cleanme($_POST['cointrackid']);
        }

        if ( !isset($_POST['livecointype'])) {

            $errordesc="livecointype required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="livecointype must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $livecointype = cleanme($_POST['livecointype']);
        }

        if ( !isset($_POST['addresssentfrm'])) {

            $errordesc="address sent frm required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="addresssentfrm must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $addresssentfrm = cleanme($_POST['addresssentfrm']);
        }
        
        if ( !isset($_POST['btcvalue'])) {

            $errordesc="btcvalue required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="btcvalue must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $btcvalue = cleanme($_POST['btcvalue']);
        }

        if ( !isset($_POST['theusdval'])) {

            $errordesc="theusdval required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="theusdval must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $theusdval = cleanme($_POST['theusdval']);
        }

        if ( !isset($_POST['manualstatus'])) {

            $errordesc="manualstatus required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="manualstatus must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $manualstatus = cleanme($_POST['manualstatus']);
        }

        if ( !isset($_POST['status'])) {

            $errordesc="status required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="status must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $status = cleanme($_POST['status']);
        }

        if ( !isset($_POST['approvaltype'])) {

            $errordesc="approvaltype required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="approvaltype must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $approvaltype = cleanme($_POST['approvaltype']);
        }

        if ( !isset($_POST['ourrrate'])) {

            $errordesc="ourrrate required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="ourrrate must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $ourrrate = cleanme($_POST['ourrrate']);
        }

        if ( !isset($_POST['amttopay'])) {

            $errordesc="amttopay required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="amttopay must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $amttopay = cleanme($_POST['amttopay']);
        }

        

        // check if cointrackid and coin type is valid
        if (!checkifFieldExist($connect, "coinproducts", "producttrackid", $cointrackid)){
            // Insert all fields
            $errordesc = "Invalid coin track id";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!checkifFieldExist($connect, "coinproducts", "cointype", $livecointype)){
            // Insert all fields
            $errordesc = "Invalid coin track id";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (empty($addresssentto) || empty($transhash) || empty($livetransid) || empty($liveusdrate) || empty($confirmation) || empty($syslivewallet) || empty($livecointype)
            || empty($addresssentfrm) || empty($btcvalue) || empty($status) || empty($approvaltype) || empty($theusdval) || empty($manualstatus) || empty($ourrrate) || empty($amttopay)  ){

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        $confirmTime = time();
        
        if ($status == 0 || $status == "pending"){
            $transStatus = 0;
        }
        if ($status == 1 || $status == "autowithdraw completed"){
            $transStatus = 1;
        }
        if ($status == 2 || $status == "in wallet"){
            $transStatus = 2;
        }
        if ($status == 3 || $status == "cancelled"){
            $transStatus = 3;
        }
        if ($status == 4 || $status == "scam"){
            $transStatus = 4;
        }

        if ($approvaltype == 1 || $status == "automation"){
            $transAprovalType = 1;
        }
        if ($approvaltype == 2 || $approvaltype == "manual"){
            $transAprovalType = 2;
        }
        if ($approvaltype == 0 || $approvaltype == "none"){
            $transAprovalType = 0;
        }
        

    
        // insert the values to the shop location table 
        $query = "UPDATE `userwallettrans` SET `addresssentto`= ?,`transhash`= ?,`livetransid`= ?,`confirmtime`= ?,`approvedby`= ?,`status`= ?,`liveusdrate`= ?,`confirmation`= ?,`syslivewallet`= ?,`cointrackid`= ?,`livecointype`= ?,`addresssentfrm`= ?,`btcvalue`= ?,`theusdval`= ?,`manualstatus`= ?,`approvaltype`= ?,`ourrrate`= ?,`amttopay`= ? WHERE orderid = ?";
        $updateTransaction = $connect->prepare($query);
        $updateTransaction->bind_param("sssssssssssssssssss", $addresssentto,  $transhash, $livetransid, $confirmTime, $admin_id, $transStatus, $liveusdrate, $confirmation, $syslivewallet, $cointrackid, $livecointype, $addresssentfrm, $btcvalue, $theusdval, $manualstatus, $transAprovalType, $ourrrate, $amttopay, $orderid);

        if ( $updateTransaction->execute() ){
            $data = [];
            $text= "Transaction successfully updated";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $updateTransaction->error;
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