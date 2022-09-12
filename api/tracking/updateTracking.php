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
        $logistics_id = getLogisticsWithPubKey($connect, $user_pubkey);

        // send error if ur is not in the database
        if ( !$logistics_id ){
            // send user not found response to the user
            $errordesc =  "User not logistics";
            $linktosolve = 'https://';
            $hint = "logistics only have access to add tracking history";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        

        if ( !isset($_POST['order_ref_no']) ){

            $errordesc="order ref no is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Order ref no must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $orderRefNo = cleanme($_POST['order_ref_no']);
        }

        if ( !isset($_POST['order_status'])) {

            $errordesc="Order Status required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Order Status must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $orderStatus = cleanme($_POST['order_status']);
        }

        if ( !isset($_POST['details'])) {

            $errordesc="Traking Details required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Tracking Details must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $details= cleanme($_POST['details']);
        }
        

        if ( empty($details)  ){

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if (empty($orderRefNo) ) {
            // Inavlid input
            $errordesc = "Insert a valid orderRefNo";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        } 
        if(!is_numeric($orderStatus) && empty($orderStatus) ) {
            // Inavlid input
            $errordesc = "Insert a valid order status";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        } 

        // check if order ref no is valid

        if ( !checkifFieldExist($connect, "productcart" ,"orderref_number" , $orderRefNo) ){
            $errordesc = "Order ref no does not exist";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ($orderStatus == "packing" || $orderStatus == 0){
            $status = 0;
        }

        if ($orderStatus == "delivered" || $orderStatus == 1){
            $status = 1;
        }
        if ($orderStatus == "processed" || $orderStatus == 2){
            $status = 2;
        }
        if ($orderStatus == "shipped" || $orderStatus == 3){
            $status = 3;
        }
        if ($orderStatus == "dispatched" || $orderStatus == 4){
            $status = 4;
        }
        if ($orderStatus == "arrive" || $orderStatus == 5){
            $status = 5;
        }
        if ($orderStatus == "pending" || $orderStatus == 6){
            $status = 6;
        }


        // insert the values to the shop location table 
        $query = "UPDATE `tracking_history` SET `orderstatus`= ?,`detail`= ? WHERE `orderef_no` = ?";
        $updateTracking = $connect->prepare($query);
        $updateTracking->bind_param("sss", $status, $details, $orderRefNo);

        if ( $updateTracking->execute() ){
            $data = [];
            $text= "Tracking successfully updated";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $updateTracking->error;
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