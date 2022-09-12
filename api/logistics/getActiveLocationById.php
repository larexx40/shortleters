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
    //include "../connectdb.php";
    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']);


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
        //every user can get location
        //confirm if only admin or location id

        if ( isset($_GET['logistic_id']) ){
            $logistic_id = cleanme($_GET['logistic_id']);
        }else{
            $errordesc =  "logistic_id not passed";
            $linktosolve = 'https://';
            $hint = "pass locationid you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
         if (!isset ($_GET['noPerPage']) ) {  
            $noPerPage = 4;
        } else {  
            $noPerPage = $_GET['noPerPage'];  
        }  
        $offset = ($page_no - 1) * $noPerPage;

        $status =1;

        if (!empty($search) && $search!="" && $search!=' '){
            //search logistic location in database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT logistic_locations.id AS id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                            logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                            FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id
                            WHERE (logistic_locations.name like ? OR logistics.name like ? ) AND logistic_locations.logistic_id = ? AND logistic_locations.status = ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssss", $searchParam, $searchParam, $logistic_id ,$status);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssssss", $searchParam, $searchParam, $logistic_id ,$status,$offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;  
        }else {
            //get all data
            $sqlQuery = "SELECT logistic_locations.id AS id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                        logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                        FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id 
                        WHERE logistic_locations.status = ? AND logistic_locations.logistic_id = ? ORDER BY id DESC";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("ss", $status, $logistic_id);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);
            //echo $numRow;

            $sqlQuery = "$sqlQuery LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("ssss", $status, $logistic_id ,$offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;
        }   
        
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
        if($numRow > 0){
            //`
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $locationName = $row['location_name'];
                $logisticid = $row['logistic_id'];
                $logisticName = $row['logistic_name'];
                $longitude = $row['longitude'];
                $latitude = $row['latitude'];
                $status = $row['status'];
                array_push($allResponse, array("id"=>$id, "locationName"=>$locationName, "logisticid"=>$logisticid, "logisticName"=>$logisticName, "latitude"=>$latitude, "longitude"=>$longitude, "status"=>$status,));
            }
            
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'locations'=> $allResponse
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
            //not found
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Record Not Found";
            $method = getenv('REQUEST_METHOD');
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