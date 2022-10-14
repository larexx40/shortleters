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

        //check if aadmin or user
        $adminid = checkIfIsAdmin($connect,$userpubkey);
        $userid = checkIfUser($connect, $userpubkey);
        if (!$userid && !$adminid){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        if ( $adminid ){
            if ( !isset($_GET['userid']) ){
                $errordesc = "User id must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required user id field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $userid = cleanme($_GET['userid']);
            }
        }


        //confirm if userid is not empty
        if(empty($userid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in the space type id ";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        
       //SELECT `id`, `user_valid_identity_id`, `identity_no`, `userid`, `user_validid_type`, `image_url`, `status`, `created_at`, `updated_at` FROM `user_valid_identity` WHERE 1
        $sqlQuery = "SELECT `id`, `user_valid_identity_id`, `identity_no`, `userid`, `user_validid_type`, `image_url`, `status` FROM `user_valid_identity` WHERE `userid` = ?";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s",$userid);
        $stmt->execute();  
        $result = $stmt->get_result();
        $numRow = $result->num_rows;

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
        if($numRow > 0){
            //pass fetched data as array maindata[]
            //SELECT `id`, `user_valid_identity_id`, `identity_no`, `userid`, `user_validid_type`, `user_validid_type`, `status`,
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $user_valid_identity_id = $row['user_valid_identity_id'];
            $identity_no = $row['identity_no'];
            $user_validid_type = $row['user_validid_type'];
            $image_url = $row['image_url'];
            $userid = $row['userid'];
            $user_validid_type = $row['user_validid_type'];
            if($user_validid_type == 1){
                $identity_type = "NIMC";
            }elseif($user_validid_type == 2){
                $identity_type = "Voters Card";
            }elseif($user_validid_type == 3){
                $identity_type = "Valid Id card";
            }elseif($user_validid_type == 4){
                $identity_type = "International Passport";
            }else{
                $identity_type= null;
            }

            $statusCode = $row['status'];
            if($statusCode == 1){
                $status = "Verified";
            }elseif($statusCode == 0){
                $status = "Pending";
            }else{
                $status = 'Failed';
            }
            $maindata=[
                "id"=>$id,
                "user_valid_identity_id"=>$user_valid_identity_id,
                "identity_no"=>$identity_no,
                "user_validid_type"=>$user_validid_type,
                'identity_type'=>$identity_type,
                "image_url"=>$image_url,
                "status"=>$status,
                "statusCode"=>$statusCode,
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
            // incorrect building id
            $errordesc="Record not found";
            $linktosolve="htps://";
            $hint=["pass in valid id"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="data with id not found";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
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