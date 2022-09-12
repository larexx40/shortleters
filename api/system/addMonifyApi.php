<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    //include ("../apifunctions.php");
    include "../connectdb.php";
    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);

    if($method =='POST'){
        //confirm to generate key
        if(!isset($_POST['secreteKey'])){
            $errordesc="secreteKey required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input secreteKey";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $secreteKey = cleanme($_POST['secreteKey']);
        }

        if(!isset($_POST['apiKey'])){
            $errordesc="apiKey required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input apiKey";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $apiKey = cleanme($_POST['apiKey']);
        }
        if(!isset($_POST['status'])){
            $errordesc="status required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input status";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $status = cleanme($_POST['status']);
        }

        if(!isset($_POST['name'])){
            $errordesc="name required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input name";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $name = cleanme($_POST['name']);
        }

        if(!isset($_POST['apiMerchant'])){
            $errordesc="apiMerchant required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input apiMerchant";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $apiMerchant = cleanme($_POST['apiMerchant']);
        }

        if(!isset($_POST['apiWallet'])){
            $errordesc="apiWallet required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input apiWallet";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $apiWallet = cleanme($_POST['apiWallet']);
        }

        if(!isset($_POST['apiAccno'])){
            $errordesc="apiAccno required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input apiAccno";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $apiAccno = cleanme($_POST['apiAccno']);
        }

        if(empty($secreteKey) || empty($apiKey) ||empty($status) || empty($name) || empty($apiMerchant) || empty($apiWallet) || empty($apiAccno)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require address information";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {
            //insert to db
             //INSERT INTO `apidatatable`(`privatekey`, `tokenexpiremin`, `servername`) VALUES (
            $squlQuery = "INSERT INTO `monifyapidetails`(`secretekey`, `apikey`, `status`, `name`, `apimerchant`, `apiwallet`, `apiaccno`) VALUES  (?,?,?,?,?,?,?)";
            $stmt = $connect->prepare($squlQuery);
            $stmt->bind_param("sssssss",$secreteKey,$apiKey,$status,$name,$apiMerchant, $apiWallet, $apiAccno);
            $addApiDate=$stmt->execute();

            if($addApiDate){
                //added, return success message
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "API Daata Inserted Successfully";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondInternalError($data);
            }else {
                //DB error || invalid input
                $errordesc="Bad request";
                $linktosolve="htps://";
                $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Failled to insert user records, fill all require data input";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondInternalError($data);
            }
        }
    }else {
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
?>