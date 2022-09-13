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
        //Confirm who can access this route

        $userid = checkIfUser($connect, $userpubkey);
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

        if(!isset($_GET['status'])){
            $errordesc="pass in order status id";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in order status";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $orderStatus = cleanme($_GET['status']);    
        }

        if(!is_numeric($orderStatus) ) {
            // Inavlid input
            $errordesc = "Insert a valid order status";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
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

        if ($orderStatus == "packing" || $orderStatus == 0){
            $status = 0;
        }

        if ($orderStatus == "delivered" || $orderStatus == 1){
            $status = 1;
        }
        if ($orderStatus == "processing" || $orderStatus == 2){
            $status = 2;
        }
        if ($orderStatus == "shipped" || $orderStatus == 3){
            $status = 3;
        }
        if ($orderStatus == "dispatched" || $orderStatus == 4){
            $status = 4;
        }
        if ($orderStatus == "arrive" || $orderStatus == 5){
            $status = 5;
        }
        if ($orderStatus == "pending" || $orderStatus == 6){
            $status = 6;
        }

        if (!empty($search) && $search!="" && $search!=' '){
            //search productCategory from database 
            $searchQuery = "SELECT productcart.`id`,productcart.ordertime, productcart.paid, productcart.`user_id`, users.fname AS firstname, users.lname AS lastname, productcart.`orderstatus_id`, productcart.`track_id`,
                        productcart.`orderref_number`, productcart.`logisticid`, logistics.name AS logistic_name, productcart.assigntodeliveryman, productcart.seenbyseller, productcart.`totalpaid`,  productcart.`totalweightlbs`,productcart.noofprod_ordered, productcart.delivery_charge
                        FROM `productcart` LEFT JOIN users ON productcart.`user_id` = users.id LEFT JOIN logistics ON productcart.`logisticid` = logistics.id
                        WHERE (users.fname LIKE ? OR users.lname LIKE ? OR productcart.track_id LIKE ? OR productcart.orderref_number LIKE ? OR logistics.name LIKE ? )
                        AND productcart.orderstatus_id = ? AND productcart.`user_id` =? ";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam ,$status, $userid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sssssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam ,$status, $userid, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows; 
            
        }else {
            //get data without search
            $searchQuery = "SELECT productcart.`id`,productcart.ordertime, productcart.paid, productcart.`user_id`, users.fname AS firstname, users.lname AS lastname, productcart.`orderstatus_id`, productcart.`track_id`,
                        productcart.`orderref_number`, productcart.`logisticid`, logistics.name AS logistic_name, productcart.assigntodeliveryman, productcart.seenbyseller, productcart.`totalpaid`,  productcart.`totalweightlbs`,productcart.noofprod_ordered, productcart.delivery_charge
                        FROM `productcart` LEFT JOIN users ON productcart.`user_id` = users.id LEFT JOIN logistics ON productcart.`logisticid` = logistics.id
                        WHERE productcart.orderstatus_id = ? AND productcart.`user_id` =? ";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ss", $status, $userid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssss", $status, $userid, $offset, $noPerPage);
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
                $userid = $row['user_id'];
                $firstname =$row['firstname'];
                $lastname =$row['lastname'];
                $fullname = $firstname." ".$lastname;
                $orderRefno = $row['orderref_number'];
                $seenBySeller = $row['seenbyseller'];
                $assignToDeliveryMan = $row['assigntodeliveryman'];
                $logisticid = $row['logisticid'];
                $logisticName = $row['logistic_name'];
                $trackid = $row['track_id'];
                $deliveryCharge = $row['delivery_charge'];
                $totalPaid = $row['totalpaid'];
                $totalweightlbs = $row['totalweightlbs'];
                $noOfItem = $row['noofprod_ordered'];                
                $paid = ($row['paid'] == 1) ? "Paid" : "Pay on delivery";
                $orderTime = gettheTimeAndDate($row['ordertime']);
                if ( $row['orderstatus_id'] == 0 ){
                    $orderStatusid = "Packing";
                }
                if ( $row['orderstatus_id'] == 1 ){
                    $orderStatusid = "Delivered";
                }
                if ( $row['orderstatus_id'] == 2 ){
                    $orderStatusid = "Processing";
                }
                if ( $row['orderstatus_id'] == 3 ){
                    $orderStatusid = "Shipped";
                }
                if ( $row['orderstatus_id'] == 4 ){
                    $orderStatusid = "Dispatched";
                }
                if ( $row['orderstatus_id'] == 5 ){
                    $orderStatusid = "Arrived";
                }
                if ( $row['orderstatus_id'] == 6 ){
                    $orderStatusid = "Pending";
                }

                array_push($allResponse, array(
                    "id"=>$id, "userid"=>$userid, "firstname"=>$firstname,"lastname"=>$lastname, "fullname"=>$fullname, "orderRefno"=>$orderRefno, "seenBySeller"=>$seenBySeller, "orderStatusid"=>$orderStatusid, "assignToDeliveryMan"=>$assignToDeliveryMan,
                    "logisticid"=>$logisticid, "logisticName"=>$logisticName, "deliveryCharge"=>$deliveryCharge, "totalPaid"=>$totalPaid, "totalweightlbs"=>$totalweightlbs, 
                    "noOfItem"=>$noOfItem,"orderTime"=>$orderTime, "paid"=>$paid, "trackid"=>$trackid
                ));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'productCarts'=> $allResponse
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
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, null, $status);
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