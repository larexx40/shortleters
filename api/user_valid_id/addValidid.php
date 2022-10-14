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
    $maindata= [];
 
    if ($method == 'POST') {
        //get company details to decode usertoken
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        //check if isadmin
        $userid = checkIfIsAdmin($connect,$userpubkey);
        if(!$userid){
            // send user not found response to the user
            $errordesc =  "User not a found";
            $linktosolve = 'https://';
            $hint = "Register to access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }

        //INSERT INTO `user_valid_identity`(`id`, `user_valid_identity_id`, 
        //`identity_no`, `userid`, `user_validid_type`, `image_url`, `status`,
        if ( !isset($_POST['identity_no']) ){
            // send error if howmanyminread field is not passed
            $errordesc = "Space type identity_no must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $identity_no = cleanme($_POST['identity_no']);
        }

        if ( !isset($_FILES['image_url']) ){
            // send error if howmanyminread field is not passed
            $errordesc = "Space type image_url must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $image_url = cleanme($_FILES['image_url']);
        }

        if ( !isset($_POST['user_validid_type']) ){
            // send error if howmanyminread field is not passed
            $errordesc = "Space type user_validid_type must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $user_validid_type = cleanme($_POST['user_validid_type']);
        }

        if (empty($user_validid_type) || empty($identity_no) || empty($image_url) ){
            // send error if inputs are empty
            $errordesc = "User valid identity required";
            $linktosolve = 'https://';
            $hint = "Pass in valid  details, it can't be empty";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        
        $status =0;
        $user_valid_identity_id = generateUniqueShortKey($connect,'user_valid_identity','user_valid_identity_id');
        $imageName = uploadImage($image, "validIdentity", $endpoint, $method);
        $imageUrl = $imageurl."/validIdentity/". $imageName;

        $query = "INSERT INTO `user_valid_identity`(`user_valid_identity_id`, `identity_no`, `status`, userid) VALUES (?,?,?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssss", $user_valid_identity_id, $identity_no, $status, $userid);

        //INSERT INTO `user_valid_identity`(`id`, `user_valid_identity_id`, `identity_no`, `userid`, 
        //`user_validid_type`, `image_url`, `status`,
        if ( $stmt->execute() ){
            $text= "Valid id successfully added";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, $maindata, $data, $status);
            respondOK($successData);
        }else{
            $errordesc =  $stmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondInternalError($data);
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