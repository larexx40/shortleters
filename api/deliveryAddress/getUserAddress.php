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
        
        //check if user or admin
        $userid = getUserWithPubKey($connect, $userpubkey);
        $adminid =checkIfIsAdmin($connect, $userpubkey);

        if(!$userid && !$adminid){
            //return respond user not authorized
            $errordesc =  "User not allowed";
            $linktosolve = 'https://';
            $hint = "Only Admin and User can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data); 
        }

        if($adminid){
            if(!isset($_GET['userid'])){
                $errordesc="pass in user id";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Pass in userid";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
                
            }else {
                $userid = cleanme($_GET['userid']);    
            }
        }

        if(empty($userid)){
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

        if (isset($_GET['search'])) {
            $search = cleanme($_POST['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        if (isset ($_GET['noPerPage']) ) {  
            if(!empty($_GET['noPerPage']) && is_numeric($_GET['noPerPage']) ){
                $noPerPage = $_GET['noPerPage']; 
            }else{
                $noPerPage =3;
            }
        } else {  
            $noPerPage =3;  
        }
        
        $offset = ($page_no - 1) * $noPerPage;
    
        if (!empty($search) && $search!="" && $search!=' '){
            //search productCategory from database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`,`address_no`, `address`, `defultaddress` 
                            FROM `deliveryaddress` WHERE (`fullname` like ? OR `state` like ? OR `address` like ? OR  `lga` like ?) AND userid = ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sssss",  $searchParam, $searchParam, $searchParam, $searchParam, $userid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`,`address_no`, `address`, `defultaddress` 
                            FROM `deliveryaddress` WHERE (`fullname` like ? OR `state` like ? OR `address` like ? OR  `lga` like ?) AND userid = ? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sssssss",  $searchParam, $searchParam, $searchParam, $searchParam, $userid, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;  
        }else {
            //get all data
            $sqlQuery = "SELECT * FROM `deliveryaddress` WHERE userid = ? ORDER BY id DESC";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("s", $userid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);
            //echo $numRow;

            $sqlQuery = "SELECT * FROM `deliveryaddress` WHERE userid = ? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("sss", $userid, $offset, $noPerPage);
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
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $userid = $row['userid'];
                $lga = $row['lga'];
                $phoneno = $row['phoneno'];
                $fullname = $row['fullname'];
                $state = $row['state'];
                $country = $row['country'];
                $zipcode = $row['zipcode'];
                $address = $row['address'];
                $addressno = $row['address_no'];
                $defultaddress = $row['defultaddress'];
                array_push($allResponse, array("id"=>$id, "userid"=>$userid, "lga"=>$lga, "phoneno"=>$phoneno, "fullname"=>$fullname, "state"=>$state,  "country"=>$country, "zipcode"=>$zipcode, "address"=>$address, "addressno"=>$addressno, "defultaddress"=>$defultaddress));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'deliveryAddress'=> $allResponse
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