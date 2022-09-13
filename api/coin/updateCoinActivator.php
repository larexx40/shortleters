<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']);
    
    if($method =='POST'){
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
        $userPubKey = $decodeToken->usertoken;
        //check if its admin
        if(!checkIfIsAdmin($connect, $userPubKey)){
            //respond not admin
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        // Check if the email field is passed
        if (!isset($_POST['coinActivatorid'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $coinActivatorid = cleanme($_POST['coinActivatorid']);
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
        if(!isset($_POST['apisecrete'])){
            $errordesc="apisecrete required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input apisecrete";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $apiSecrete = cleanme($_POST['apisecrete']);
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
        $status = 0;
        $trackid = generateUniqueShortKey($connect, "coinactivators", "trackid");
        
        if(empty($name) || empty($apiSecrete)||empty($apiKey)||empty($platformType)){
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
            //insert into database
            $sqlQuery = "UPDATE coinactivators SET `name`= ?, `apikey` = ?, `apisecrete` =?, `trackid` =?, `status` = ?, `platformtype` = ? WHERE id = ?";
            $stmt = $connect->prepare($sqlQuery);
            $stmt->bind_param("sssssss",$name, $apiKey, $apiSecrete, $trackid, $status, $platformType, $coinActivatorid);
            $stmt->execute();
            $affectedRow = $stmt->affected_rows;

            if(!$stmt->execute()){
                //DB error || invalid input
                $errordesc=$stmt->error;
                $linktosolve="htps://";
                $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Database comection error";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondInternalError($data);
            }

            if($affectedRow > 0){
                //added, return success message
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "Coin Activaor Inserted Successfully";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondInternalError($data);
            }else {
                //return id not found respond
                $errordesc=$stmt->error;
                $linktosolve="htps://";
                $hint=['id not found ', 'same value inserted'];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="id not found or same value inserted";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
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
