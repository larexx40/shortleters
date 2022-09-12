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

    // check if the right request was sent
    if ($method == 'GET') {
        // Get company private key
        $query = 'SELECT * FROM apidatatable';
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row =  mysqli_fetch_assoc($result);
        $companykey = $row['privatekey'];
        $servername = $row['servername'];
        $expiresIn = $row['tokenexpiremin'];

        $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        $user_pubkey = $decodedToken->usertoken;

        // check if user is admin
        if (!checkIfIsAdmin($connect, $user_pubkey) || !getLogisticsWithPubKey($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !isset($_POST['order_ref_no']) ){

            $errordesc="order ref no is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Order ref no must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $orderRefNo = cleanme($_POST['order_ref_no']);
        }

        if (empty($orderRefNo) ) {
            // Inavlid input
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !checkifFieldExist($connect, "productcart" ,"orderref_number" , $orderRefNo) ){
            $errordesc = "Order ref no does not exist";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // pagination and search parameters
        if (isset($_POST['search'])) {
            $search = cleanme($_POST['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        $no_per_page = 5;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            // get the total number of pages
            $query = "SELECT tracking_history.id, tracking_history.orderef_no, tracking_history.orderstatus, tracking_history.detail, tracking_history.created_at, tracking_history.updated_at, tracking_history.user_id, tracking_history.logistics_id FROM `tracking_history` LEFT JOIN users ON tracking_history.user_id = users.id WHERE detail LIKE ? users.fname LIKE ? users.lname LIKE ? AND tracking_history.orderef_no = ? ";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("ssss", $searching, $searching, $searching, $orderRefNo);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT tracking_history.id, tracking_history.orderef_no, tracking_history.orderstatus, tracking_history.detail, tracking_history.created_at, tracking_history.updated_at, tracking_history.user_id, tracking_history.logistics_id FROM `tracking_history` LEFT JOIN users ON tracking_history.user_id = users.id WHERE detail LIKE ? users.fname LIKE ? users.lname LIKE ? AND tracking_history.orderef_no = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("ssssss", $searching,  $searching, $searching, $orderRefNo ,$offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allLogistics = [];

                while($row = $result->fetch_assoc()){
                    if ($row['orderstatus'] == 0) {
                        $status = "packing";
                    }
            
                    if ($row['orderstatus'] == 1) {
                        $status = "delivered";
                    }
            
                    if ($row['orderstatus'] == 2) {
                        $status = "processed";
                    }
                    if ($row['orderstatus'] == 3) {
                        $status = "shipped";
                    }
                    if ($row['orderstatus'] == 4) {
                        $status = "dispatched";
                    }
                    if ($row['orderstatus'] == 5) {
                        $status = "arrived";
                    }
                    if ($row['orderstatus'] == 6) {
                        $status = "pending";
                    }
                    $id = $row['id'];
                    $orderstatus = $row['orderstatus'];
                    $statusInWords = $status; 
                    $orderRefNo = $row['orderef_no'];
                    $created = $row['created_at'];
                    $updated = $row['updated_at'];
                    $user_id = $row['user_id'];
                    $logistics_id = $row['logistics_id'];
                    $userName = getUserFullname($connect, $row['user_id']);
                    $logisticsName = getNameFromField($connect, "logistics" , "id" , $row['logistics_id']);
                    
                    array_push($allLogistics, array("id"=>$id, "order_status"=>$orderstatus, "status_value"=>$statusInWords, "orderRefNo"=>$orderRefNo, "logistics_id"=>$logistics_id, "user_id"=>$user_id, 
                    "user_name"=>$userName, "logistics_name"=>$logisticsName, "created_at"=>$created, "updated_at"=>$updated));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'products' => $allLogistics
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "Record not found";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

            }
        }else{
            $query = "SELECT * FROM `tracking_history` WHERE tracking_history.orderef_no = ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("s", $orderRefNo);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT * FROM `tracking_history` WHERE tracking_history.orderef_no = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sss", $orderRefNo ,$offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allLogistics = [];

                while($row = $result->fetch_assoc()){
                    if ($row['orderstatus'] == 0) {
                        $status = "packing";
                    }
            
                    if ($row['orderstatus'] == 1) {
                        $status = "delivered";
                    }
            
                    if ($row['orderstatus'] == 2) {
                        $status = "processed";
                    }
                    if ($row['orderstatus'] == 3) {
                        $status = "shipped";
                    }
                    if ($row['orderstatus'] == 4) {
                        $status = "dispatched";
                    }
                    if ($row['orderstatus'] == 5) {
                        $status = "arrived";
                    }
                    if ($row['orderstatus'] == 6) {
                        $status = "pending";
                    }
                    $id = $row['id'];
                    $orderstatus = $row['orderstatus'];
                    $statusInWords = $status; 
                    $orderRefNo = $row['orderef_no'];
                    $created = $row['created_at'];
                    $updated = $row['updated_at'];
                    $user_id = $row['user_id'];
                    $logistics_id = $row['logistics_id'];
                    $userName = getUserFullname($connect, $row['user_id']);
                    $logisticsName = getNameFromField($connect, "logistics" , "id" , $row['logistics_id']);
                    
                    array_push($allLogistics, array("id"=>$id, "order_status"=>$orderstatus, "status_value"=>$statusInWords, "orderRefNo"=>$orderRefNo, "logistics_id"=>$logistics_id, "user_id"=>$user_id, 
                    "user_name"=>$userName, "logistics_name"=>$logisticsName, "created_at"=>$created, "updated_at"=>$updated));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'products' => $allLogistics
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "No records";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

            }
        }

        
            

            
    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
    }

?>


