<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
    
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    if ($method == 'GET') {
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

        //check if its admin
        if (!isset($_GET['id'])) {
            $errordesc =  "Api id not passed";
            $linktosolve = 'https://';
            $hint = "pass id of api you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        } else {
            $id = cleanme($_GET['id']);
        }

        if (!is_numeric($id) ){
            // send response if the id passed isn't numeric
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        if(empty($id)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in blog id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                        FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id WHERE blog.`id`= ?";
            $stmt = $connect->prepare($sqlQuery);
            $stmt->bind_param("s",$id);
            $stmt->execute();  
            $result = $stmt->get_result();

            //check for db error || connection lost
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
            if($result->affected_rows > 0){
                //pass fetched data as array maindata[]
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $adminid = $row['adminid'];
                $adminName = $row['admin_name'];
                $dateAdded = $row['dateadded'];
                $blogImage = $row['blogimage'];
                $blogHeadline = $row['blogheadline'];
                $howManyMinRead = $row['howmanyminread'];
                $blogContent = $row['blogcontent'];
                $draft = $row['draft'];

                $maindata=[
                    "id"=>$id,
                    "adminid"=>$adminid,
                    "adminName"=>$adminName,
                    "dateAdded"=>$dateAdded,
                    "blogImage"=>$blogImage,
                    "blogHeadline"=>$blogHeadline, 
                    "howManyMinRead"=>$howManyMinRead, 
                    "blogContent"=>$blogContent, 
                    "draft"=>$draft
                ];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "Data found";
                $method = getenv('REQUEST_METHOD');
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);

            }else{
                // incorrect email
                $errordesc="Record not found";
                $linktosolve="htps://";
                $hint=["pass in valid id"];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="data with id not found";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
        }
        
    }else{
        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);

    }
?>