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

        //check if isadmin
        // $adminid = checkIfIsAdmin($connect,$userpubkey);
        $user_id = getUserWithPubKey($connect, $userpubkey);
        
        if(!$user_id){
            // send user not found response to the user
            $errordesc =  "User not a admin";
            $linktosolve = 'https://';
            $hint = "Only admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }

        if ( !isset($_POST['apartment_id']) ){
            // send error if name field is not passed
            $errordesc = "Highlight name must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_POST['apartment_id']);
        }

        if ( !isset($_POST['highlight_id']) ){
            $errordesc = "Highlight icon must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $highlight_id = cleanme($_POST['highlight_id']);
        }

        if (empty($apartment_id) || empty($highlight_id)){
            // send error if inputs are empty
            $errordesc = "Highlight inputs are required";
            $linktosolve = 'https://';
            $hint = "Pass in Highlight details, it can't be empty";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        
        if ( !checkifFieldExist($connect, "highlights", "highlightid", $highlight_id) ){
            
            $errordesc = "Highlights not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !checkifFieldExist($connect, "apartments", "apartment_id", $apartment_id) ){
            $errordesc = "Apartment not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $query = "SELECT highlights_ids FROM `apartments` WHERE apartment_id = ? AND agent_id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $apartment_id, $user_id);
        $stmt->execute();
        $result= $stmt->get_result();
        $num_row = $result->num_rows;


        if ( $num_row ){
            $row = $result->fetch_assoc();
            $ids = $row['highlights_ids'];

            if ( empty($ids) ){
                $update_query = "UPDATE `apartments` SET `highlights_ids`= ? WHERE `apartment_id` = ? AND agent_id = ? ";
                $update_stmt = $connect->prepare($update_query);
                $update_stmt->bind_param("sss", $highlight_id, $apartment_id, $user_id);
                $update = $update_stmt->execute();
                
                if ($update){
                    $text= "Highlight successfully added";
                    $status = true;
                    $data = [];
                    $successData = returnSuccessArray($text, $method, $endpoint, $maindata, $data, $status);
                    respondOK($successData);
                }

                if ( $update_stmt->error ){
                    $errordesc =  $update_stmt->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                    respondInternalError($data);
                }


            }else{
                if ( str_contains($ids, "$highlight_id") ){
                    $errordesc = "Highlight already exist";
                    $linktosolve = 'https://';
                    $hint = "Kindly pass valid value to all the fields";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }

                $new_ids = $ids.",".$highlight_id;
                $update_query = "UPDATE `apartments` SET `highlights_ids`= ? WHERE `apartment_id` = ? AND agent_id = ? ";
                $update_stmt = $connect->prepare($update_query);
                $update_stmt->bind_param("sss", $new_ids, $apartment_id, $user_id);
                $update = $update_stmt->execute();
                
                if ($update){
                    $text= "Highlight successfully added";
                    $status = true;
                    $data = [];
                    $successData = returnSuccessArray($text, $method, $endpoint, $maindata, $data, $status);
                    respondOK($successData);
                }

                if ( $update_stmt->error ){
                    $errordesc =  $update_stmt->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                    respondInternalError($data);
                }
            }
        }else{
            $errordesc = "Apartment not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $stmt->error ){
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