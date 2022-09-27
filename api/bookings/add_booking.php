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
        $user_id =  checkIfUser($connect, $user_pubkey);

        if(!$admin && !$user_id ){
            // send user not found response to the user
            $errordesc =  "User not registered";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        if($admin){
            $user_id = '';
        }
        // if($user_id){
        //     $admin ='';
        // }

        if (!isset($_POST['first_name'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $first_name = cleanme($_POST['first_name']);
        }

        if (!isset($_POST['last_name'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $last_name = cleanme($_POST['last_name']);
        }

        if (!isset($_POST['gender'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $gender = cleanme($_POST['gender']);
        }

        if (!isset($_POST['phone'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $phone = cleanme($_POST['phone']);
        }

        if (!isset($_POST['email'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $email = cleanme($_POST['email']);
        }

        if (!isset($_POST['apartment_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apartment_id = cleanme($_POST['apartment_id']);
        }

        if (!isset($_POST['apartment_price'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apartment_price = cleanme($_POST['apartment_price']);
        }

        if (!isset($_POST['address'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $address = cleanme($_POST['address']);
        }

        if (!isset($_POST['occupation_or_workplace'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $occupation_or_workplace = cleanme($_POST['occupation_or_workplace']);
        }

        if (!isset($_POST['preferred_check_in'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $preferred_check_in = cleanme($_POST['preferred_check_in']);
        }

        if (!isset($_POST['prefferred_check_out'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $prefferred_check_out = cleanme($_POST['prefferred_check_out']);
        }

        if (!isset($_POST['total_amount_paid'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required total amount paid field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $total_amount_paid = cleanme($_POST['total_amount_paid']);
        }

        if (!isset($_POST['no_of_people'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $no_of_people = cleanme($_POST['no_of_people']);
        }

        // if (!isset($_POST['max_people'])){
        //     $errordesc = "All fields must be passed";
        //     $linktosolve = 'https://';
        //     $hint = "Kindly pass the required name field in this endpoint";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondBadRequest($data);
        // }else{
        //     $max_people = cleanme($_POST['max_people']);
        // }

        if (!isset($_POST['payment_status'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $payment_status = cleanme($_POST['payment_status']);
        }

        if (!isset($_POST['payment_type'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $payment_type = cleanme($_POST['payment_type']);
        }
        if (!isset($_POST['customer_note'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required customer note field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $customer_note = cleanme($_POST['customer_note']);
        }

        if (!isset($_POST['identification_type'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $identification_type = cleanme($_POST['identification_type']);
        }

        if (!isset($_FILES['identification_img'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $identification_img = $_FILES['identification_img'];
        }
   
        
         // check if none of the field is empty
        if ( empty($first_name) || empty($last_name) || empty($gender) || empty($phone) || empty($email) || empty($apartment_id) || empty($occupation_or_workplace) 
            || empty($preferred_check_in) || empty($prefferred_check_out) || empty($total_amount_paid) || empty($no_of_people) 
            ||  empty($identification_type) || !is_numeric($payment_status) || !is_numeric($payment_type) || empty($apartment_price) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !validateEmail($email) ){
            $errordesc = "Invalid Email";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!validatePhone($phone)){
            $errordesc = "Insert Phone Number";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!checkifFieldExist($connect, "apartments", "apartment_id", $apartment_id)){
            $errordesc = "Apartment Not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $identification_img_name = uploadImage($identification_img, "identity", $endpoint, $method);
        $identification_img_link = $imageurl . "identity/". $identification_img_name;


        $booking_id = generateUniqueShortKey($connect, "bookings", "booking_id ");

        if ($payment_type < 1){
            $time = time();
            $id_initial = "NP".$time;
        }

        if ($payment_type == 1){
            $time = time();
            $id_initial = "MU".$time;
        }
        if ($payment_type == 2){
            $time = time();
            $id_initial = "AU".$time;
        }

        $booking_id = $id_initial.$booking_id;
        

        if ( $payment_status > 0){
            $trans_id = generateUniqueShortKey($connect, "user_transactions", "transactionid");
            $trans_type = "3";
            $approval_type = "1";
            $ordertime = time();
            $status = "1";
            
            $addQuery =  "INSERT INTO `user_transactions`(`transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, `status`, `approvaltype`, `amttopay`) VALUES (?,?,?,?,?,?,?,?)";
            $addTrans = $connect->prepare($addQuery);
            $addTrans->bind_param("ssssssss", $trans_id, $trans_type, $booking_id, $ordertime, $admin, $status, $approval_type, $total_amount_paid);
            $addTrans->execute();

            if ($addTrans->error){
                $errordesc =  $addTrans->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondInternalError($data);
            }
        }

        $query = 'INSERT INTO `bookings`(`booking_id`, `user_id`, `admin_id`, `first_name`, `last_name`, `gender`, `phone`, `email`, `apartment_id`, `apartment_price` ,`address`, `occupation_or_workplace`, `preferred_check_in`, `prefferred_check_out`, `total_amount_paid` ,`no_of_people`, `identification_type`, `identification_img`, `paid`, `payment_type` ,`customer_note`) VALUES (? , ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)';
        $slider_stmt = $connect->prepare($query);
        $slider_stmt->bind_param("sssssssssssssssssssss", $booking_id, $user_id, $admin, $first_name, $last_name, $gender, $phone, $email, $apartment_id, $apartment_price ,$address, $occupation_or_workplace, $preferred_check_in, $prefferred_check_out, $total_amount_paid ,$no_of_people, $identification_type, $identification_img_link, $payment_status, $payment_type ,$customer_note);

        if ( $slider_stmt->execute() ) {
            $text= "Booking successfully added";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc =  $slider_stmt->error;
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