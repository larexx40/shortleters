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
        $adminid = checkIfIsAdmin($connect,$userpubkey);

        if(!$adminid){
            // send user not found response to the user
            $errordesc =  "User not a admin";
            $linktosolve = 'https://';
            $hint = "Only admin access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }

        //confirm if Highlight id is passed
        if (!isset($_POST['systemSettingsid'])){
            $errordesc = "systemSettingsid must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $systemSettingsid = cleanme($_POST['systemSettingsid']);
        }
        //check status passed
        if ( !isset($_POST['status']) ){
            $errordesc="Highlight status required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Highlight status must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $status = cleanme($_POST['status']);
        }

        if ($status == 0 || $status == "inactive"){
            $changeStatus = 0;
            $message = "Deactivated";
        }elseif ($status == 1 || $status == 'active'){
            $changeStatus = 1;
            $message = "Activated";
        }else{
            $changeStatus = "";
        }

        if ( $changeStatus != 0 && $changeStatus !== 1){
            $errordesc = "Status passed is invalid ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the status passed is either active or inactive which is 1 and 0 respectively";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        //confirm if highlightid is not empty
        if(empty($systemSettingsid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in the systemSettingsid ";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        
        $sql = "UPDATE `systemsettings` SET `status`= ? WHERE `sys_setting_id` = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('ss', $changeStatus, $systemSettingsid);
        $stmt->execute();

        if ( $stmt->affected_rows > 0 ){
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "systemsettings status set to $message";
            $errordata = [];
            $text = "systemsettings set to $message";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        
        }else{
            //systemsettings not found
            $errordesc = "systemsettings with id not found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid building id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data); 
        }
    }else{
        // method not allowed
        $errordesc="Method not allowed";
        $linktosolve="htps://";
        $hint=["Ensure to use the method stated in the documentation."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Method used not allowed";
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondMethodNotAlowed($data);
    }  
?>