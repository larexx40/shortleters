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
    $maindata=[];

    if ($method == 'GET') {
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

        if(!checkIfIsAdmin($connect, $userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not Allowed";
            $linktosolve = 'https://';
            $hint = "Only admin can access this route ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $userid = checkIfUser($connect, $userpubkey);

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        if (isset($_GET['sortStatus']) && is_numeric($_GET['sortStatus'])) {
            $status = cleanme($_GET['sortStatus']); //status =0-6
        } else {
            $status = "";
        }

        // check the status passed
        // if ($status == "default" || $status == 0){
        //     $sortStatus = 0;
        // }

        // if ($status == "delivered" || $status == 1){
        //     $sortStatus = 1;
        // }
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

        if($status > 0){
            //sort with default address
            if (!empty($search) && $search!="" && $search!=' '){
                //search productCategory from database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`, `address`, `address_no`, `address`, `defultaddress` 
                                FROM `deliveryaddress` WHERE (`fullname` like ? OR `state` like ? OR `address` like ? OR  `lga` like ?) AND defultaddress =?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sssss", $searchParam, $searchParam, $searchParam, $searchParam, $status);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $status, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  

            }else{
                //get without search
                $sqlQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`, `address`, `address_no`, `address`, `defultaddress` 
                            FROM `deliveryaddress` WHERE defultaddress =?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("s", $status);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $sqlQuery = "$sqlQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("sss", $status, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
            }
        }else{
            //no need to sort
            if (!empty($search) && $search!="" && $search!=' '){
                //search productCategory from database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`, `address`, `address_no`, `address`, `defultaddress` 
                                FROM `deliveryaddress` WHERE (`fullname` like ? OR `state` like ? OR `address` like ? OR  `lga` like ?)";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = 'SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`, `address`, `address_no`,`defultaddress` 
                                FROM `deliveryaddress` WHERE (`fullname` like ? OR `state` like ? OR `address` like ? OR  `lga` like ?) ORDER BY id DESC LIMIT ?,?';
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $searchParam, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`, `address`, `address_no`, `address`, `defultaddress` 
                            FROM `deliveryaddress`";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                $sqlQuery = "SELECT `id`,`userid`,`lga`,`phoneno`,`fullname`,`state`,`country`,`zipcode`, `address`,`address_no`,`defultaddress` 
                            FROM `deliveryaddress` ORDER BY id DESC LIMIT ?,?";
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
                array_push($allResponse, array(
                    "id"=>$id, "userid"=>$userid, "lga"=>$lga, 
                    "phoneno"=>$phoneno, "fullname"=>$fullname,
                    "state"=>$state, 
                    "country"=>$country, "zipcode"=>$zipcode, 
                    "address"=>$address, "addressno"=>$addressno, 
                    "defultaddress"=>$defultaddress
                ));
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