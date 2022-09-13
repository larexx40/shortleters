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
    $endpoint = basename($_SERVER['PHP_SELF']);

    if($method =='GET'){
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
        $adminpubkey = $decodeToken->usertoken;
        //confirm adminkey from jwt
        if(!checkIfIsAdmin($connect, $adminpubkey)){
            //respond not admin
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        $adminid =checkIfIsAdmin($connect, $adminpubkey);

        if(!isset($_GET['id'])){
            $errordesc="id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="pass in valid id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $id = cleanme($_GET['id']);
        }
        //check if its numeric
        if(!is_numeric($id)){
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="pass in valid id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        if(empty($id)){
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
            //delete blog
            $sqlQuery = "DELETE FROM `blog` WHERE id =?";
            $stmt = $connect->prepare($sqlQuery);
            $stmt->bind_param("s",$id);
            $stmt->execute();
            $affectedRow =$stmt->affected_rows;

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
                // return success message
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = ["Blog deleted from the database"];
                $errordata = [];
                $text = "Blog successfully deleted";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);
            }else{
                //id not found response
                $errordesc="Blog id not found";
                $linktosolve="htps://";
                $hint='id not in database';
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Blog id not found";
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
