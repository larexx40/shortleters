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

       //confirm if space type id is passed
       if(!isset($_POST['transactionid'])){
        $errordesc="Transactionid required";
        $linktosolve="htps://";
        $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Pass in space type  id";
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondBadRequest($data);
        
        }else {
            $transactionid = cleanme($_POST['transactionid']); 
        }

        //confirm if space type id is not empty
        if(empty($transactionid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in the transactionid ";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        
        $sqlQuery = "SELECT `id`, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, `status`, `approvaltype`,`amttopay` FROM `user_transactions`";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s",$transactionid);
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
            //pass fetched data as array maindata[]
            $id = $row['id'];
            $userid = $row['userid'];
            $transactionid = $row['transactionid'];
            $transaction_type = $row['transaction_type'];
            $booking_id = $row['booking_id'];
            $ordertime = $row['ordertime'];
            $approvedby = $row['approvedby'];
            $approvaltype = $row['approvaltype'];
            $amttopay = $row['amttopay'];
            $statusCode = $row['status'];

            if($statusCode == 1){
                $status = "Active";
            }else{
                $status = "Inactive";
            }
            $maindata=[
                "id"=>$id,
                "userid"=>$userid,
                "transactionid"=>$transactionid,
                "transaction_type"=>$transaction_type,
                "booking_id"=>$booking_id,
                "ordertime"=>$ordertime,
                "approvedby"=>$approvedby,
                "approvaltype"=>$approvaltype,
                "status"=>$status,
                "amttopay"=>$amttopay,
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
            // incorrect building id
            $errordesc="Record not found";
            $linktosolve="htps://";
            $hint=["pass in valid id"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="data with id not found";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
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