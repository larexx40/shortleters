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
    include "../connectdb.php";
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
        $adminpubkey = $decodeToken->usertoken;
        //check if its admin
        if(!checkIfIsAdmin($connect, $adminpubkey)){
            //respond not admin
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        if (isset($_GET['sortStatus'])) {
            $status = cleanme($_GET['sortStatus']); //status =0-6
        } else {
            $status = "";
        }

        // check the status passed
        if ($status == "Inactive" || $status == 0){
            $sortStatus = 0;
        }

        if ($status == "Active" || $status == 1){
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
                //search for data in database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT * FROM `monifyapidetails` WHERE (`name` like ? OR `apimerchant` like ? OR `apiwallet` like ?) AND status =?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $sortStatus);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $searchQuery= "$searchQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $sortStatus, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;

            }else{
                //get without search
                $sqlQuery = "SELECT * FROM `monifyapidetails` WHERE status = ?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("s", $sortStatus);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
                //echo $numRow;
    
                $sqlQuery = "$sqlQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("sss",$sortStatus, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;

            }
        }else{
            //no need sort
            if (!empty($search) && $search!="" && $search!=' '){
                //search for data in database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT * FROM `monifyapidetails` WHERE `name` like ? OR `apimerchant` like ? OR `apiwallet` like ?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "SELECT * FROM `monifyapidetails` WHERE `name` like ? OR `apimerchant` like ? OR `apiwallet` like ? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sssss", $searchParam, $searchParam, $searchParam, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
    
            }else {
                //get all data in database
                $sqlQuery = "SELECT * FROM `monifyapidetails`";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
                //echo $numRow;
    
                $sqlQuery = "SELECT * FROM `monifyapidetails` ORDER BY id DESC LIMIT ?,?";
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
        //retuurn fetched data as array
        if($numRow > 0){
            $allResponse = [];
            while($data = $result->fetch_assoc()){
                $id = $data['id'];
                $secretekey = $data['secretekey'];
                $apikey = $data['apikey'];
                $status = $data['status'];
                if($status == 1){
                    $status ="Active";
                }else{
                    $status = "Inactive";
                }
                $name = $data['name'];
                $apimerchant = $data['apimerchant'];
                $apiwallet = $data['apiwallet'];
                $apiaccno = $data['apiaccno'];
                array_push($allResponse,array("id"=>$id,"secretekey"=>$secretekey, "apikey"=>$apikey, "status"=>$status, "name"=>$name, "apimerchant"=>$apimerchant, "apiwallet"=>$apiwallet, "apiaccno"=>$apiaccno));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'monifys'=> $allResponse
            ];
            //$maindata=[$maindata];
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
            $data = returnErrorArray($text, $method, $endpoint, $errordata, $maindata, $status);
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