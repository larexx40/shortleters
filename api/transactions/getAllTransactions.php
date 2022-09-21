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
    $endpoint = basename($_SERVER['PHP_SELF']);
    $maindata=[];

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
        $userPubKey = $decodeToken->usertoken;

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        //sort with status
        if (isset($_GET['sortStatus']) && is_numeric($_GET['sortStatus'])) {
            $status = cleanme($_GET['sortStatus']); //status =0-6
        } else {
            $status = "";
        }

        //sort with transaction type
        if (isset($_GET['sortType'] ) && is_numeric($_GET['sortType']) ) {//web, bank, cash
            $transactionType =$_GET['sortType'] ;
        } else {
            $transactionType = '';
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
            if(is_numeric($status) && !is_numeric($transactionType)){//get where only status is passed
                //sort with status
                if (!empty($search) && $search!="" && $search!=' '){
                    //search user_transactions from database 
                    $searchParam = "%{$search}%"; 
                    $searchQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                                    LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby
                                    WHERE (users.fname like ? OR users.lname  like ?) AND user_transactions.status =?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sss", $searchParam, $searchParam, $status);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sssss",$searchParam, $searchParam, $status, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;  

                }else{
                    //get without search
                    $sqlQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                                LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin ON admin.id = user_transactions.approvedby
                                WHERE user_transactions.status =?";
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
            }
            if(!is_numeric($status) && is_numeric($transactionType)){//get where only transactionType is passed
                //sort with transactionType
                if (!empty($search) && $search!="" && $search!=' '){
                    //search user_transactions from database 
                    $searchParam = "%{$search}%"; 
                    $searchQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                                    LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby
                                    WHERE (users.fname like ? OR users.lname  like ?) AND `transaction_type` =?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sss", $searchParam, $searchParam, $transactionType);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sssss",$searchParam, $searchParam, $transactionType, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;  

                }else{
                    //get without search
                    $sqlQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby WHERE user_transactions.transaction_type = ?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("s", $transactionType);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $sqlQuery = "$sqlQuery ORDER BY user_transactions.id DESC LIMIT ?, ?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("sss", $transactionType, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;
                }
            }
            if(is_numeric($status) && is_numeric($transactionType)){//get where both are passed
                //sort with both status and transactionType
                if (!empty($search) && $search!="" && $search!=' '){
                    //search user_transactions from database 
                    $searchParam = "%{$search}%"; 
                    $searchQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                                    LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby
                                    WHERE (users.fname like ? OR users.lname  like ?) AND `transaction_type` =? AND user_transactions.status = ?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("ssss", $searchParam, $searchParam, $transactionType, $status);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("ssssss",$searchParam, $searchParam, $transactionType, $status, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;  

                }else{
                    //get without search
                    $sqlQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                                LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby
                                WHERE user_transactions.transaction_type =? AND user_transactions.status = ?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("ss", $transactionType, $status);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $sqlQuery = "$sqlQuery ORDER BY id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("ssss", $transactionType, $status, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;
                }
            }
            // if(is_numeric($status) && !is_numeric($transactionType)){//get where none is passed
            //     $errordesc="Pass in transaction_type or status";
            //     $linktosolve="htps://";
            //     $hint=["Ensure you pass a valid Email","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            //     $errordata=returnError7003($errordesc,$linktosolve,$hint);
            //     $text="pass in transaction_type or status";
            //     $method=getenv('REQUEST_METHOD');
            //     $data=returnErrorArray($text,$method,$endpoint,$errordata);
            //     respondBadRequest($data);
            // }
        }else{
            //no need to sort
            if (!empty($search) && $search!="" && $search!=' '){
                //search productCategory from database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                                LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby
                                WHERE (users.fname like ? OR users.lname  like ?) ";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ss",$searchParam,  $searchParam);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss",$searchParam, $searchParam, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT user_transactions.id, `userid`, `transactionid`, `transaction_type`, `booking_id`, `ordertime`, `approvedby`, admin.name AS admin_name, user_transactions.status, `approvaltype`,`amttopay`, users.fname, users.lname FROM `user_transactions` 
                            LEFT JOIN users ON users.id = user_transactions.userid LEFT JOIN admin on admin.id = user_transactions.approvedby";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                $sqlQuery = "$sqlQuery ORDER BY id DESC LIMIT ?,?";
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

        $stmt->close();
        
        if($numRow > 0){
            
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $userid = $row['userid'];
                if ($userid){
                    $username = $row['fname']. $row['lname'];
                }
                
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
                if ( !$userid && $booking_id){
                    $username = getBookingDetails($connect, $booking_id);
                }
                $ordertime = $row['ordertime'];
                $approvedby = $row['approvedby'];
                $adminname = $row['admin_name'];
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
                    $status = "Successful";
                }else{
                    $status = "Pending";
                }

            array_push($allResponse, array(
                "id"=>$id,
                "userid"=>$userid,
                "username"=>$username,
                "transactionid"=>$transactionid,
                "transaction_type"=>$transaction_type,
                "type"=>$type,
                "booking_id"=>$booking_id,
                "ordertime"=>$ordertime,
                "approvedby"=>$approvedby,
                "adminname"=>$adminname,
                "approvaltype"=>$approvaltype,
                "approvaltypeName"=>$approvaltypeName,
                "statusCode"=>$statusCode,
                "status"=>$status,
                "amttopay"=>$amttopay,
            ));

            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'transactions'=> $allResponse
            ];
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
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