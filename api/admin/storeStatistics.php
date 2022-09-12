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

        // cheeck if it thesuper admin
        if(!checkIfIsAdmin($connect, $userpubkey)){
            //respond not admin
            $errordesc =  "User not a Super admin";
            $linktosolve = 'https://';
            $hint = "Only Super admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        //count number of order, customer, product and category
        $noOfOrder = countRow($connect, 'productcart', 'id');
        $noOfUser = countRow($connect, 'users', 'id');
        $noOfCategory = countRow($connect, 'productcategories', 'id');
        $noOfProduct = countRow($connect, 'products', 'id');
        $storeStats= [
            "orders"=>$noOfOrder,
            "users"=>$noOfUser,
            "productcategories"=>$noOfCategory,
            "products"=>$noOfProduct,
        ];
        
        $maindata=[
            'storeStatistics' => $storeStats
        ];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "Order created";
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