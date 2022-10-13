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
    $endpoint = basename($_SERVER['PHP_SELF']);

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
        $adminid = checkIfIsAdmin($connect,$userpubkey);
        if(!$adminid){
            // send user not found response to the user
            $errordesc =  "User not a admin";
            $linktosolve = 'https://';
            $hint = "Only admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        //confirm how to pass in the id
        if(!isset($_POST['user_valid_identity_id'])){
            $errordesc=" user_valid_identity_id id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in user_valid_identity_id";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $user_valid_identity_id = cleanme($_POST['user_valid_identity_id']); 
        }
    
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

        if (empty($user_validid_type) || empty($identity_no) || empty($image_url) || empty($user_valid_identity_id)){
            // send error if inputs are empty
            $errordesc = "User valid identity required";
            $linktosolve = 'https://';
            $hint = "Pass in valid  details, it can't be empty";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        
        
        //INSERT INTO `user_valid_identity`(`id`, `user_valid_identity_id`, 
        //`identity_no`, `userid`, `user_validid_type`, `image_url`, `status`,
        $sql = "UPDATE `user_valid_identity` SET image_url = ?, SET user_validid_type = ?, SET identity_no = ? WHERE `user_valid_identity_id` = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('ssss', $image_url, $user_validid_type, $identity_no, $user_valid_identity_id);
        $update =$stmt->execute();
        if($update){
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Valid Identity Card Updated";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else{
            //invalid input || server error
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="invalid api id or Check DB connection";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
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