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
            if ( !isset($_POST['user_id']) ){

                $errordesc="User id if not a user required";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="User id if not a user must be passed";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
    
            }else{
                $user_id = cleanme($_POST['user_id']);
            }
        }else{
            $user_id = getUserWithPubKey($connect, $user_pubkey);
        }

        

        if ( !isset($_POST['notificationtext']) ){

            $errordesc="notification text required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="notification text must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $notificationText = cleanme($_POST['notificationtext']);
        }

        if ( !isset($_POST['notificationtype'])) {

            $errordesc="notification type required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="notification type must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $notificationType = cleanme($_POST['notificationtype']);
        }

        if ( !isset($_POST['productid'])) {
            $product_id = "";
        }else{
            $product_id = cleanme($_POST['productid']);
        }

        if ( !isset($_POST['orderrefid'])) {
            $order_ref_id = "";
        }else{
            $order_ref_id = cleanme($_POST['orderrefid']);
        }

        if ( !isset($_POST['notificationstatus'])) {

            $errordesc="notification status required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop email must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $notificationstatus= cleanme($_POST['notificationstatus']);
        }
        
        $notificationCode = generateUniqueShortKey($connect, "usernotification", "notificationcode");

        if (empty($notificationText)  ){

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if (!is_numeric($notificationType) && empty($notificationType)) {
             // Insert all fields
             $errordesc = "Insert all fields";
             $linktosolve = 'https://';
             $hint = "Kindly pass value to all the fields in this endpoint";
             $errorData = returnError7003($errordesc, $linktosolve, $hint);
             $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
             respondBadRequest($data);
        }

        if (!is_numeric($notificationstatus) && empty($notificationstatus)) {
            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if product is valid 
        $isAProduct = checkifFieldExist($connect, "products" , "id" , $product_id);

        // check orderref no is in db
        $response = checkifFieldExist($connect, "productcart", "orderref_number", $order_ref_id); 

        if ( !checkIfUserisInDB($connect, $user_id)){
            $errordesc = "Invalid User";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid user ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $type = "";
        if ($notificationType == "normal" || $notificationType == 1){
            $type = 1;
        }

        if ($notificationType == "product" || $notificationType == 2 && $isAProduct && $response){
            $type = 2;
        }

        $status= "";
        if ($notificationstatus == "pending" || $notificationstatus == 0){
            $status = 0;
        }

        if ($notificationstatus == "completed" || $notificationstatus == 1){
            $status = 1;
        }

        // all is perfect insert data

        // insert the values to the shop location table 
        $query = "INSERT INTO `usernotification`(`userid`, `notificationtext`, `notificationtype`, `productid`, `orderrefid`, `notificationstatus`, `notificationcode`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $addNotification = $connect->prepare($query);
        $addNotification->bind_param("sssssss", $user_id, $notificationText, $type, $product_id, $order_ref_id, $status, $notificationCode);

        if ( $addNotification->execute() ){
            $data = [];
            $text= "Notification successfully sent";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $addNotification->error;
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