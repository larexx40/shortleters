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

        if(!checkIfIsAdmin($connect, $userpubkey)){
            // send Admin not found response
            $errordesc =  "Admin  not found";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $adminid = checkIfIsAdmin($connect, $userpubkey);

        if ( !isset($_FILES['blogImage']) ){
            // send error if blogimage field is not passed
            $errordesc = "Blogimage must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required review field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $blogImage = $_FILES['blogImage'];
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

        $dateAdded = time();
        $draft =1;
    
        if (empty($blogImage)|| empty($blogHeadline)|| empty($howManyMinRead) || empty($blogContent) || empty($draft)){
            // send error if inputs are empty
            $errordesc = "Blog inputs are required";
            $linktosolve = 'https://';
            $hint = "Pass in article details, it can't be empty";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
            //uploadImage($img, "products", $endpoint, $method);
        }
        $imageLink = uploadImage($blogImage, "blogImages", $endpoint, $method);
        $query = "INSERT INTO `blog`(`adminid`, `dateadded`, `blogimage`, `blogheadline`, `howmanyminread`, `blogcontent`,`draft`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sssssss", $adminid, $dateAdded, $imageLink, $blogHeadline, $howManyMinRead, $blogContent, $draft);

        if ( $stmt->execute() ){
            $text= "Blog Successfully posted";
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