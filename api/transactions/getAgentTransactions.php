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
       if(!isset($_GET['userid'])){
        $errordesc="Transactionid required";
        $linktosolve="htps://";
        $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Pass in space type  id";
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondBadRequest($data);
        
        }else {
            $userid = cleanme($_GET['userid']); 
        }

        //confirm if space type id is not empty
        if(empty($userid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in the transactionid ";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
        
        $sqlQuery = "SELECT user_transactions.* FROM `user_transactions` LEFT JOIN bookings ON bookings.booking_id = user_transactions.booking_id LEFT JOIN apartments ON apartments.apartment_id = bookings.apartment_id WHERE apartments.agent_id = ? OR user_transactions.userid = ?";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("ss",$userid, $userid);
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
        $stmt->close();
        
        if($numRow > 0){
            //pass fetched data as array maindata[]
            $allTransactions = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $userid = $row['userid'];
                $username = getUserFullname($connect, $userid);
                $transactionid = $row['transactionid'];
                $transaction_type = $row['transaction_type'];
                if ( $transaction_type == 1){
                    $type = "Fund  Wallet";
                }
                if ( $transaction_type == 2){
                    $type = "Agent Payment";
                }
                if ( $transaction_type == 3){
                    $type = "Payment for Apartment";
                }

                $booking_id = $row['booking_id'];
                $ordertime = $row['ordertime'];
                $approvedby = $row['approvedby'];
                $getAdminName = ($approvedby) ? getNameFromField($connect, "admin", "id", $approvedby) : null;
                $approvaltype = $row['approvaltype'];
                if ($approvaltype == 1){
                    $approvaltypeName = "Manual";
                }
                if ($approvaltype == 2){
                    $approvaltypeName = "Automatic";
                }
                $amttopay = $row['amttopay'];
                $statusCode = $row['status'];

                if($statusCode == 1){
                    $status = "Paid";
                }else{
                    $status = "Not Paid";
                }

                array_push($allTransactions, array(
                    "id"=>$id,
                    "userid"=>$userid,
                    'userfullname' => ($username) ? $username : null,
                    "transactionid"=>$transactionid,
                    "transaction_type"=>$transaction_type,
                    "type" => $type,
                    "booking_id"=>$booking_id,
                    "ordertime"=>$ordertime,
                    "approvedby"=>$approvedby,
                    'admin_name' => ($getAdminName)? $getAdminName : null,
                    "approvaltype"=>$approvaltype,
                    'approval_type_name' => $approvaltypeName,
                    "status_code" => $statusCode,
                    "status"=>$status,
                    "amttopay"=>$amttopay,
                ));
            }
            
            $data = [
                "transactions" => $allTransactions
            ];
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            // incorrect building id
            $errordesc="Record not found";
            $linktosolve="htps://";
            $hint=["pass in valid id"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="data with id not found";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
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