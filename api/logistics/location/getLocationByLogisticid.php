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
    include "../../cartsfunction.php";

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
        $userpubkey = $decodeToken->usertoken;
        //check if admin or logistic
        $logisticid = checkIfLogistic($connect, $userpubkey);
        $adminid =checkIfIsAdmin($connect, $userpubkey);

        if(!$adminid && !$logisticid){
            //return respond user not authorized
            $errordesc =  "User not allowed";
            $linktosolve = 'https://';
            $hint = "Only Admin and Loogistic can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        
        if($adminid){
            if(!isset($_GET['logisticid'])){
                $errordesc="pass in user id";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Pass in logisticid";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
                
            }else {
                $logisticid = cleanme($_GET['logisticid']);    
            }
        }

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        if (isset($_GET['sortStatus'])) {
            if(!empty($_GET['sortStatus']) && is_numeric($_GET['sortStatus']) ){//status =1 or 0
                $status = cleanme($_GET['sortStatus']);
            }else{     
                $status = 0;
            }
        } else {
            $status = 0;
        }

        // check the status passed
        if ($status == 0 || $status == "inactive"){
            $sortStatus = 0;
        }

        if ($status == 1 || $status == 'active'){
            $sortStatus = 1;
        }

        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
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

        if($sort > 0){
            //sort with status
            if (!empty($search) && $search!="" && $search!=' '){
                //search logistic location in database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                                logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                                FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id
                                WHERE (logistic_locations.name like ? OR logistics.name like ? ) AND logistic_locations.status =? AND logistic_locations.logistic_id =?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss", $searchParam, $searchParam,$sortStatus, $logisticid);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssssss", $searchParam, $searchParam, $sortStatus, $logisticid, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else{
                //get all data
                $sqlQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                            logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                            FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id
                            WHERE logistic_locations.logistic_id =? AND logistic_locations.status =?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("ss", $logisticid, $sortStatus);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $sqlQuery = "$sqlQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("ssss", $logisticid, $sortStatus, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
            }

        }else{
            //no need to sort
            if (!empty($search) && $search!="" && $search!=' '){
                //search logistic location in database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                                logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                                FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id
                                WHERE (logistic_locations.name like ? OR logistics.name like ? ) AND logistic_locations.logistic_id =?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sss", $searchParam, $searchParam, $logisticid);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                                logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                                FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id 
                                WHERE (logistic_locations.name like ? OR logistics.name like ? ) AND logistic_locations.logistic_id =? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sssss", $searchParam, $searchParam, $logisticid, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                            logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                            FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id WHERE logistic_locations.logistic_id =?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("s", $logisticid);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
                //echo $numRow;
    
                $sqlQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, logistics.name AS logistic_name, 
                            logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                            FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id WHERE logistic_locations.logistic_id =? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("sss", $logisticid, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
            }   
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
                $status = $row['status'];
                //get the initials of location name
                $names = explode(" ", $locationName);
                $initials = '';
                foreach($names as $name){
                    $initials.=strtoupper(substr($name,0,1));
                }
                $longitude = $row['longitude'];
                $latitude = $row['latitude'];
                $status = $row['status'];
                if($status == 1){
                    $status = 'Active';
                }else{
                    $status = 'Inactive';
                }
                array_push($allResponse, array("id"=>$id, "locationName"=>$locationName, "initials"=>$initials, "logisticid"=>$logisticid, "logisticName"=>$logisticName, "latitude"=>$latitude, "longitude"=>$longitude, "status"=>$status,));
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