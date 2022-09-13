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


    if($method =='POST'){
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
        //confirm user

        if(!isset($_POST['productid'])){
            $errordesc="productid required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your productid";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $productid = cleanme($_POST['productid']);   
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
         if (!isset ($_GET['noPerPage']) ) {  
            $noPerPage = 4;
        } else {  
            $noPerPage = $_GET['noPerPage'];  
        }  
        $offset = ($page_no - 1) * $noPerPage;
    
        if (!empty($search) && $search!="" && $search!=' '){
            //search productCategory from database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT productreview.id, productreview.userid, users.username, productreview.productid, products.name AS product_name, productreview.review, productreview.ratestar
                            FROM `productreview` LEFT JOIN users ON productreview.userid = users.id LEFT JOIN products ON productreview.productid = products.id 
                            WHERE (users.username LIKE ? OR products.name LIKE ? OR productreview.review LIKE ?) AND productreview.productid = ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $productid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "SELECT productreview.id, productreview.userid, users.username, productreview.productid, products.name AS product_name, productreview.review, productreview.ratestar 
                            FROM `productreview` LEFT JOIN users ON productreview.userid = users.id LEFT JOIN products ON productreview.productid = products.id 
                            WHERE (users.username LIKE ? OR products.name LIKE ? OR productreview.review LIKE ?) AND productreview.productid =? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssss", $searchParam ,$searchParam, $searchParam, $productid ,$offset, $noPerPage,);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;  
        }else {
            //get all data
            $sqlQuery = "SELECT productreview.id, productreview.userid, users.username, productreview.productid, products.name AS product_name, productreview.review, productreview.ratestar 
            FROM `productreview` LEFT JOIN users ON productreview.userid = users.id LEFT JOIN products ON productreview.productid = products.id WHERE productreview.productid =? ORDER BY id DESC";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("ss", $productid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);
            //echo $numRow;

            $sqlQuery = "SELECT productreview.id, productreview.userid, users.username, productreview.productid, products.name AS product_name, productreview.review, productreview.ratestar 
            FROM `productreview` LEFT JOIN users ON productreview.userid = users.id LEFT JOIN products ON productreview.productid = products.id WHERE productreview.productid =? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("sss", $productid, $offset, $noPerPage);
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
                $username = $row['username'];
                $productid = $row['productid'];
                $productName = $row['product_name'];
                $review = $row['review'];
                $rateStar = $row['ratestar'];
                array_push($allResponse,array("id"=>$id,"userid"=>$userid,"username"=>$username,"productid"=>$productid,"productName"=>$productName, "review"=>$review, "rateStar"=>$rateStar));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'review'=> $allResponse
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