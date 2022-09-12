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

        if(!checkIfIsAdmin($connect,$userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not a shop owner";
            $linktosolve = 'https://';
            $hint = "Only shop owner can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $adminid = checkIfIsAdmin($connect,$userpubkey);

        //confirm how to pass in the id
        if(!isset($_POST['id'])){
            $errordesc="id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in  id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $id = cleanme($_POST['id']); 
        }

        if ( !isset($_POST['blogImage']) ){
            // send error if blogimage field is not passed
            $errordesc = "Blogimage must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required review field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $blogImage = cleanme($_POST['blogImage']);
        }

        if ( !isset($_POST['blogHeadline']) ){
            // send error if blogheadline field is not passed
            $errordesc = "Blogheadline must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required productid field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $blogHeadline = cleanme($_POST['blogHeadline']);
        }

        if ( !isset($_POST['howManyMinRead']) ){
            // send error if howmanyminread field is not passed
            $errordesc = "HowManyMinRead must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required rateStar field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $howManyMinRead = cleanme($_POST['howManyMinRead']);
        }

        if ( !isset($_POST['blogContent']) ){
            // send error if blogContent field is not passed
            $errordesc = "blogContent must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required rateStar field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $blogContent = cleanme($_POST['blogContent']);
        }

        if (empty($blogImage)|| empty($blogHeadline)|| empty($howManyMinRead) || empty($blogContent)){
            // send error if inputs are empty
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require data input";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            // UPDATE db with id
            //`adminid`='',`dateadded`='',`blogimage`='',`blogheadline`='',`howmanyminread`='',`blogcontent`=',`draft`= 
            $sql = "UPDATE `blog` SET blogheadline = ?, howmanyminread = ?, blogcontent = ? WHERE id = ? AND adminid = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param('sssss', $blogHeadline, $howManyMinRead, $blogContent, $id, $adminid);
            $update =$stmt->execute();

            if($update){
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "Blog contentent Updated";
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