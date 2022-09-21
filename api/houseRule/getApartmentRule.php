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
    $maindata=[];

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
        $userPubKey = $decodeToken->usertoken;

        if(!isset($_GET['apartment_id'])){
            $errordesc="apartment id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in space apartment id";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
            }else {
                $apartment_id = cleanme($_GET['apartment_id']); 
            }
    
            //confirm if space type id is not empty
            if(empty($apartment_id)){
                //all input required / bad request
                $errordesc="Bad request";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Please pass in the apartment id ";
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }

        
    
        if (isset ($_GET['page']) ) { 
            if(!empty($_GET['page']) && is_numeric($_GET['page']) ){
                $page_no = $_GET['page']; 
            }else{
                $page_no = 1;
            }
        } else {  
            $page_no = 1;  
        }

        if (isset ($_GET['noPerPage']) ) {  
            if(!empty($_GET['noPerPage']) && is_numeric($_GET['noPerPage']) ){
                $noPerPage = $_GET['noPerPage']; 
            }else{
                $noPerPage =4;
            }
        } else {  
            $noPerPage =4;  
        } 
        $offset = ($page_no - 1) * $noPerPage;


        //get all data
        $sqlQuery = "SELECT * FROM `apartment_house_rule` WHERE `apart_id` = ? ";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $apartment_id);
        $stmt->execute();
        $result= $stmt->get_result();
        $total_numRow = $result->num_rows;
        $pages = ceil($total_numRow / $noPerPage);

        $sqlQuery = "$sqlQuery ORDER BY id DESC LIMIT ?,?";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("sss", $apartment_id ,$offset, $noPerPage);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;
        
        
        //check for database connection 
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
        //return fetched data as array

        $stmt->close();
        
        if($numRow > 0){
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['apart_rule_id'];
                $houseRuleid = $row['house_rule_id'];
                $house_rules = getFieldsDetails($connect, "house_rule", "house_rule_id", $houseRuleid);
                $apart_id = $row['apart_id'];
                $apartment_name  = ($apart_id)? getNameFromField($connect, "apartments", "apartment_id", $apart_id): null;
                $statusCode = $row['status'];
                if($statusCode == 1){
                    $status = "Active";
                }else{
                    $status = "Inactive";
                }

            array_push($allResponse, array(
                "id"=>$id,
                "houseRuleid"=>$houseRuleid,
                "rules"=>$house_rules,
                "apart_id"=>$apart_id,
                "apartment_name"=>$apartment_name,
                "status"=>$status,
                "statusCode"=>$statusCode,
            ));

            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'houseRules'=> $allResponse
            ];
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //not found
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Record Not Found";
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
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