<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']);
    $maindata =[];


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
        //can user can get locationPrice
        //confirm if only admin or logistics id

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

        if ($sort > 0){
            if (!empty($search) && $search!="" && $search!=' '){
                //search logistic location in database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                                LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id 
                                WHERE (logistic_locations.name like ? OR logistics.name like ? ) AND logistics_prices.status =?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sss", $searchParam, $searchParam, $sortStatus);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                                LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id 
                                WHERE (logistic_locations.name like ? OR logistics.name like ? ) AND logistics_prices.status = ? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sssss", $searchParam, $searchParam, $sortStatus, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                            LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id
                            WHERE logistics_prices.status =? ORDER BY id DESC";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("s", $sortStatus);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
                //echo $numRow;
    
                $sqlQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                            LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id
                            WHERE logistics_prices.status =? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("sss", $sortStatus, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
            }             
            
        }else{
            // no need to sort i.e no need to pass status
            if (!empty($search) && $search!="" && $search!=' '){
                //search logistic location in database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                                LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id 
                                WHERE (logistic_locations.name like ? OR logistics.name like ? )";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ss", $searchParam, $searchParam,);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                                LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id 
                                WHERE (logistic_locations.name like ? OR logistics.name like ? ) ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss", $searchParam, $searchParam, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                            LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
                //echo $numRow;
    
                $sqlQuery = "SELECT logistics_prices.*, logistic_locations.name AS location_name, logistics.name AS logistic_name FROM `logistics_prices` 
                            LEFT JOIN logistics ON logistics_prices.logistic_id = logistics.id LEFT JOIN logistic_locations ON logistics_prices.location_id = logistic_locations.id ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("ss", $offset, $noPerPage);
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
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $logisticid = $row['logistic_id'];
                $logisticName = $row['logistic_name'];
                $locationid = $row['location_id'];
                $locationName = $row['location_name'];

                //get initials
                $names = explode(" ", $locationName);
                $initials = '';
                foreach($names as $name){
                    $initials.=strtoupper(substr($name,0,1));
                }
                $minWeight = $row['lbsweightmin'];
                $maxWeight = $row['lbsweightmax'];
                $price= $row['price'];
                $status= $row['status'];
                if($status == 1){
                    $status = 'Active';
                }else{
                    $status = 'Inactive';
                }
                array_push($allResponse, array("id"=>$id, "logisticid"=>$logisticid,"logisticName"=>$logisticName, "locationid"=>$locationid, "locationName"=>$locationName, "initials"=>$initials, "minWeight"=>$minWeight, "maxWeight"=>$maxWeight, "price"=>$price, "status"=>$status));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'logisticPrices'=> $allResponse
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