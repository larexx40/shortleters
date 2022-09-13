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

    if ( $method == 'GET'){
        //get companydetalis and servername for auth token
        $detailsID =1;
        $JWTParams = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $JWTParams->bind_param('i', $detailsID);
        $JWTParams->execute();
        $result = $JWTParams->get_result();
        $row = $result->fetch_assoc();
        $companyprivateKey = $row['privatekey'];
        $minutetoend = $row['tokenexpiremin'];
        $serverName = $row['servername'];
    

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        if(!checkIfUser($connect, $userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not registered";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $userid = checkIfUser($connect, $userpubkey);

        if (!isset($_GET['id'])){
            // send error if id of the address to delete isn't passed
            $errordesc = "Address id must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required address id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $addressid = cleanme($_GET['id']);
        }

        //check if its numeric
        if(!is_numeric($addressid)){
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="pass in valid id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        if(empty($addressid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require address information";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        //delete address
        $sqlQuery = 'DELETE FROM deliveryaddress WHERE id = ? AND userid = ?';
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("is", $addressid, $userid);
        $deleteByid=$stmt->execute();
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
            // send response to user that address has been deleted
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = "Address has been Deleted in the database";
            $errordata = [];
            $text = "Address successfully deleted";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //id not found response
            $errordesc="delivery address not found";
            $linktosolve="htps://";
            $hint=["invalid id","delivery address not found"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Delivery address id not found";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        
    }else{
        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);
    }
?>