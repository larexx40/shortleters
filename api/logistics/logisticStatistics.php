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
        //Get company private key for jwtauth
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

        //check if user is a registered logistics
        $logisticid = checkIfLogistic($connect, $userpubkey);
        if(!$logisticid){
            //respond not registered logistics
            $errordesc =  "User not a registered Logistic";
            $linktosolve = 'https://';
            $hint = "Only registered logistic can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        //count number of order, customer, product and category;

        $sqlQuery = "SELECT user_id, COUNT(DISTINCT user_id) AS noOfCustomers FROM `productcart`WHERE logisticid = ?";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $logisticid);
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
            $noOfCustomer = $row['noOfCustomers'];
        }
        $noOfOrder = countRow($connect, 'productcart', 'logisticid');
        $storeStats= [
            "orders"=>$noOfOrder,
            "customers"=>$noOfCustomer,
        ];
        
        $maindata=[
            'logisticStatistics' => $storeStats
        ];
        $errordesc = " ";
        $linktosolve = "htps://";
        $hint = [];
        $errordata = [];
        $text = "Logistic Statistics fetched";
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