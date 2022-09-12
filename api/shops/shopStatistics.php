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
        //check if its super admin
        //Get company private key
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

        $admin = checkIfIsAdmin($connect, $userpubkey);
        $shopid = checkIfUser($connect, $userpubkey);

        if(!$admin && !$shopid ){
            // send user not found response to the user
            $errordesc =  "User cannot access this route";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        
        if ($admin){
            if (isset($_GET['shopid'])) {
                $shopid = cleanme($_GET['shopid']);

                if (!is_numeric($shopid)){
                    $errordesc =  "Invalid Shop id Passed";
                    $linktosolve = 'https://';
                    $hint = "Pass a valid Shop id";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                    respondBadRequest($data);
                }
            } else {
                $errordesc =  "Shop id not passed";
                $linktosolve = 'https://';
                $hint = "Pass a valid Shop id";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                respondBadRequest($data);
            }
        }

        //get distict product ordered
        $sqlQuery = "SELECT  products.shop_id, COUNT(DISTINCT productorders.product_id) AS product_ordered FROM `productorders` LEFT JOIN products on productorders.product_id = products.productid WHERE products.shop_id= ?";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $shopid);
        $stmt->execute();  
        $result = $stmt->get_result();
        $numRow = $result->num_rows;

        //check for db error || connection lost
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

        if($numRow > 0){
            $stmt->close();
            $row = $result->fetch_assoc();
            $noOfProductOrdered = $row['product_ordered'];
        }

        //count number of shop order, shop customer, shop product
        $noOfProduct = countRowwithParam($connect, 'products', 'shop_id', $shopid);
        $noOfUser = countRow($connect, 'users', 'id');
        $shopStats= [
            "orders"=>$noOfProductOrdered,
            "products"=>$noOfProduct,
        ];
        
        $maindata=[
            'shopStatistics' => $shopStats
        ];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "Data fetched";
        $status = true;
        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
        respondOK($data);

    
        
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