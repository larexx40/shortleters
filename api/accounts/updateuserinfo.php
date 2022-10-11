<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);

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

        $user_id = checkIfUser($connect, $user_pubkey);

        if (!$user_id){
            $errordesc = "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only User can use this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);        
        }

        if(!isset($_POST['firstname'])){
            $errordesc="Firstname required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your firstname";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $firstName = cleanme($_POST['firstname']);
            
        }

        if(!isset($_POST['lastname'])){
            $errordesc="lastname required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your lastname";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $lastName = cleanme($_POST['lastname']);
        }

        if( !isset($_POST['phoneno'])){
            $errordesc="phoneno required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your phoneno";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $phoneno = cleanme($_POST['phoneno']);
        }

        if( !isset($_POST['dob'])){
            $errordesc="dob required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your dob";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $dob = cleanme($_POST['dob']);
        }

        if( !isset($_POST['sex'])){
            $errordesc="sex required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your sex";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $sex = cleanme($_POST['sex']);
        }

        if( !isset($_POST['state'])){
            $errordesc="state required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your state";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $state = cleanme($_POST['state']);
        }

        if( !isset($_POST['country'])){
            $errordesc="country required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your country";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $country = cleanme($_POST['country']);
        }
        

        // if( empty($firstName) || empty($lastName) ||  empty($phoneno) || empty($dob) || empty($sex) ||empty($state) || empty($country) ){
        //     //all input required / bad request
        //     $errordesc="Bad request";
        //     $linktosolve="htps://";
        //     $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
        //     $errordata=returnError7003($errordesc,$linktosolve,$hint);
        //     $text="Please fill all require data input";
        //     $method=getenv('REQUEST_METHOD');
        //     $data=returnErrorArray($text,$method,$endpoint,$errordata);
        //     respondBadRequest($data);
        // }

        // if ( !validatePhone($phoneno) ){
        //     $errordesc = "Invalid Phone number";
        //     $linktosolve = 'https://';
        //     $hint = "Phone number must a valid phone number";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondBadRequest($data);
        // }

        // // check if phone is the same as current phone
        // $query = "SELECT * FROM `users` WHERE `id` = ? AND `phoneno` = ?";
        // $stmt = $connect->prepare($query);
        // $stmt->bind_param("ss", $user_id, $phoneno);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $num_row = $result->num_rows;

        // if ($num_row < 1){
        //     // check if phone is unique
        //     $error = checkifFieldisUnique($connect, "users" , "phoneno" , $phoneno);
        //     if ( $error ){
        //         $errordesc = $error;
        //         $linktosolve = 'https://';
        //         $hint = "Phone number must be unique";
        //         $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //         $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //         respondBadRequest($data);
        //     }
        // }

        //update using userpubkey
        $sql = "UPDATE users SET fname = ?, lname = ?, phoneno = ?, state = ?, country = ?, dob= ?, sex = ? WHERE id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('ssssssss', $firstName, $lastName, $phoneno, $state, $country, $dob, $sex, $user_id);
        $stmt->execute();
        $row_affected = $stmt->affected_rows;


        if ( $stmt->error ){
            $errordesc = $stmt->error;
            $linktosolve = 'https://';
            $hint = "DB error or invalid Input, Kindly check DB connection";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        if ( $stmt->execute() ){
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "User Updated";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else{
            //invalid input/ server error
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="invalid userkey or DB issue";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }




    }else{
        // method not allowed
        $errordesc="Method not allowed";
        $linktosolve="htps://";
        $hint=["Ensure to use the method stated in the documentation."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Method used not allowed";
        $method=getenv('REQUEST_METHOD');
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondMethodNotAlowed($data);
    }

    
?>