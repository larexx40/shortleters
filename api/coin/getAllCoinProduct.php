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
        $noPerPage = 4;  
        $offset = ($page_no - 1) * $noPerPage;

        if (!empty($search) && $search!="" && $search!=' '){
            //search productCategory from database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT * FROM coinproducts WHERE (`name` like ? OR `trackid` like ? OR `platformtype` like ?)";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = 'SELECT * FROM coinproducts WHERE (`name` like ? OR `trackid` like ? OR `platformtype` like ?) ORDER BY id DESC LIMIT ?,?';
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssssS", $searchParam, $searchParam, $searchParam, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;  
        }else {
            //get all data
            $sqlQuery = "SELECT * FROM coinproducts";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            $sqlQuery = "SELECT * FROM coinproducts ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("ss", $offset, $noPerPage);
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
                $name = $row['name'];
                $productTrackid = $row['producttrackid'];
                $merchantid = $row['merchantid'];
                $rate = $row['rate'];
                $coinType= $row['cointype'];
                $img = $row['img'];
                $platformType= $row['platformtype'];
                $colorCode = $row['colorcode'];
                $typeTag= $row['typetag'];
                $isType = $row['istype'];
                $whereToShow= $row['wheretoshow'];
                $liveRateFunctions = $row['liveratefunctions'];
                $status= $row['status'];
                array_push($allResponse, array(
                    "id"=>$id, "name"=>$name, 
                    "productTrackid"=>$productTrackid, 
                    "merchantid"=>$merchantid, 
                    "rate"=>$rate, 
                    "cointype"=>$coinType, 
                    "status"=>$status,
                    "platformtype"=>$platformType, 
                    "img"=>$img, "colorCode"=>$colorCode, 
                    "typeTag"=>$typeTag, 
                    "isType"=>$isType, 
                    "whereToShow"=>$whereToShow, 
                    "liveRateFunctions"=>$liveRateFunctions
                ));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'coinProducts'=> $allResponse
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