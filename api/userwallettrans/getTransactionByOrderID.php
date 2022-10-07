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

        if ( !isset($_POST['orderid']) ){

            $errordesc=" orderid is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="orderid into must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $orderid = cleanme($_POST['orderid']);
        }

        if (!checkifFieldExist($connect, "userwallettrans" , "orderid" ,$userId)){
            $errordesc = "User does not exist";
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
        
        $no_per_page = 10;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            // get the total number of pages
            $query = "SELECT userwallettrans.id, userwallettrans.userid, `addresssentto`, `transhash`, `livetransid`, `orderid`, `ordertime`, `confirmtime`, `approvedby`, userwallettrans.status , `liveusdrate`, `confirmation`, `syslivewallet`, `cointrackid`, `livecointype`, `addresssentfrm`, `btcvalue`, `theusdval`, `manualstatus`, `approvaltype`, userwallettrans.created_at, userwallettrans.updated_at, `ourrrate`, `amttopay` FROM `userwallettrans` LEFT JOIN users ON userwallettrans.userid = users.id LEFT JOIN coinproducts ON userwallettrans.cointrackid = coinproducts.producttrackid WHERE users.fname LIKE ? OR users.lname LIKE ? OR coinproducts.name LIKE ? OR coinproducts.cointype LIKE ? OR admin.name LIKE ? OR admin.email LIKE ? AND orderid = ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("sssssss", $searching, $searching, $searching, $searching, $searching, $searching, $orderId);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT userwallettrans.id, userwallettrans.userid, `addresssentto`, `transhash`, `livetransid`, `orderid`, `ordertime`, `confirmtime`, `approvedby`, userwallettrans.status , `liveusdrate`, `confirmation`, `syslivewallet`, `cointrackid`, `livecointype`, `addresssentfrm`, `btcvalue`, `theusdval`, `manualstatus`, `approvaltype`, userwallettrans.created_at, userwallettrans.updated_at, `ourrrate`, `amttopay` FROM `userwallettrans` LEFT JOIN users ON userwallettrans.userid = users.id LEFT JOIN coinproducts ON userwallettrans.cointrackid = coinproducts.producttrackid WHERE users.fname LIKE ? OR users.lname LIKE ? OR coinproducts.name LIKE ? OR coinproducts.cointype LIKE ? OR admin.name LIKE ? OR admin.email LIKE ? AND orderid = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sssssssss", $searching,  $searching, $searching, $searching, $searching, $searching, $userid ,$offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allTransaction = [];

                while($row = $result->fetch_assoc()){
                    if ($row['status'] == 0) {
                        $statusName = "pending";
                    }
            
                    if ($row['status'] == 1) {
                        $statusName = "autowithdraw completed";
                    }
            
                    if ($row['status'] == 2) {
                        $statusName = "in wallet";
                    }
                    if ($row['status'] == 3) {
                        $statusName = "cancelled";
                    }
                    if ($row['status'] == 4) {
                        $statusName = "scam";
                    }

                    // get approval type name
                    if ($row['approvaltype'] == 0) {
                        $typename = "none";
                    }
                    if ($row['approvaltype'] == 1) {
                        $typename = "automation";
                    }
                    if ($row['approvaltype'] == 2) {
                        $typename = "manual";
                    }


                    

                    $id = $row['id'];
                    $user_id = $row['userid'];
                    $userFulname = getUserFullname($connect, $row['userid']);
                    $addresssentto = $row['addresssentto'];
                    $status = $row['status'];
                    $statusInWords = $statusName; 
                    $transhash = $row['transhash'];
                    $livetransid = $row['livetransid'];
                    $orderId = $row['orderid'];
                    $orderTime = gettheTimeAndDate($row['ordertime']);
                    $confirmtime = gettheTimeAndDate($row['confirmtime']);
                    $admin_id = $row['approvedby'];
                    $adminName = getNameFromField($connect, "admin", "id", $row['approvedby']);
                    $adminEmail = getEmailFromField($connect, "admin", "id", $row['approvedby']);
                    $liveusdrate = $row['liveusdrate'];
                    $confirmation = $row['confirmation'];
                    $syslivewallet = $row['syslivewallet'];
                    $cointrackid = $row['cointrackid'];
                    $coinName = getNameFromField($connect, "coinproducts", "producttrackid", $row['cointrackid']);
                    $livecointype = $row['livecointype'];
                    $addresssentfrm = $row['addresssentfrm'];
                    $btcvalue = $row['btcvalue'];
                    $theusdval = $row['theusdval'];
                    $manualstatus = $row['manualstatus'];
                    $ourrrate = $row['ourrrate'];
                    $amttopay = $row['amttopay'];
                    $approvaltype = $row['approvaltype'];
                    $approvalName = $typename;
                    $created = $row['created_at'];
                    $updated = $row['updated_at'];
                    
                    array_push($allTransaction, array("id"=>$id, 
                    "user_id"=>$user_id, "userFullName"=>$userFulname, "addresssentto"=>$addresssentto, "status"=>$status, "status_meaning"=>$statusInWords, 
                    "transhash"=>$transhash, "livetransid"=>$livetransid , "order_id"=>$orderId,  "order_time"=>$orderTime, "confirm_time"=>$confirmtime,
                    "confirmation"=>$confirmation, "syslivewallet"=>$syslivewallet, "cointrack_id"=>$cointrackid, "coin_name"=>$coinName, "livecointype"=>$livecointype, 
                    "addresssentfrm"=>$addresssentfrm, "btcvalue"=>$btcvalue , "theusdval"=>$theusdval, "manualstatus"=>$manualstatus, "ourrrate"=>$ourrrate,
                    "amttopay"=>$addresssentfrm, "approvaltype"=>$approvaltype, "approvalName"=>$approvalName,  
                    "admin_id"=>$admin_id, "admin_name"=>$adminName , "admin_email"=>$adminEmail,  "liveusdrate"=>$livetransid, "created_at"=>$created, "updated_at"=>$updated));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'transactions' => $allTransaction
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
            $query = "SELECT * FROM `userwallettrans` WHERE AND orderid = ? = ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("s", $orderid);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT * FROM `userwallettrans` WHERE userid = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sss", $userId ,$offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allTransaction = [];

                while($row = $result->fetch_assoc()){
                    if ($row['status'] == 0) {
                        $statusName = "pending";
                    }
            
                    if ($row['status'] == 1) {
                        $statusName = "autowithdraw completed";
                    }
            
                    if ($row['status'] == 2) {
                        $statusName = "in wallet";
                    }
                    if ($row['status'] == 3) {
                        $statusName = "cancelled";
                    }
                    if ($row['status'] == 4) {
                        $statusName = "scam";
                    }

                    // get approval type name
                    if ($row['approvaltype'] == 0) {
                        $typename = "none";
                    }
                    if ($row['approvaltype'] == 1) {
                        $typename = "automation";
                    }
                    if ($row['approvaltype'] == 2) {
                        $typename = "manual";
                    }


                    

                    $id = $row['id'];
                    $user_id = $row['userid'];
                    $userFulname = getUserFullname($connect, $row['userid']);
                    $addresssentto = $row['addresssentto'];
                    $status = $row['status'];
                    $statusInWords = $statusName; 
                    $transhash = $row['transhash'];
                    $livetransid = $row['livetransid'];
                    $orderId = $row['orderid'];
                    $orderTime = gettheTimeAndDate($row['ordertime']);
                    $confirmtime = gettheTimeAndDate($row['confirmtime']);
                    $admin_id = $row['approvedby'];
                    $adminName = getNameFromField($connect, "admin", "id", $row['approvedby']);
                    $adminEmail = getEmailFromField($connect, "admin", "id", $row['approvedby']);
                    $liveusdrate = $row['liveusdrate'];
                    $confirmation = $row['confirmation'];
                    $syslivewallet = $row['syslivewallet'];
                    $cointrackid = $row['cointrackid'];
                    $coinName = getNameFromField($connect, "coinproducts", "producttrackid", $row['cointrackid']);
                    $livecointype = $row['livecointype'];
                    $addresssentfrm = $row['addresssentfrm'];
                    $btcvalue = $row['btcvalue'];
                    $theusdval = $row['theusdval'];
                    $manualstatus = $row['manualstatus'];
                    $ourrrate = $row['ourrrate'];
                    $amttopay = $row['amttopay'];
                    $approvaltype = $row['approvaltype'];
                    $approvalName = $typename;
                    $created = $row['created_at'];
                    $updated = $row['updated_at'];
                    
                    array_push($allTransaction, array("id"=>$id, 
                    "user_id"=>$user_id, "userFullName"=>$userFulname, "addresssentto"=>$addresssentto, "status"=>$status, "status_meaning"=>$statusInWords, 
                    "transhash"=>$transhash, "livetransid"=>$livetransid , "order_id"=>$orderId,  "order_time"=>$orderTime, "confirm_time"=>$confirmtime,
                    "confirmation"=>$confirmation, "syslivewallet"=>$syslivewallet, "cointrack_id"=>$cointrackid, "coin_name"=>$coinName, "livecointype"=>$livecointype, 
                    "addresssentfrm"=>$addresssentfrm, "btcvalue"=>$btcvalue , "theusdval"=>$theusdval, "manualstatus"=>$manualstatus, "ourrrate"=>$ourrrate,
                    "amttopay"=>$addresssentfrm, "approvaltype"=>$approvaltype, "approvalName"=>$approvalName,  
                    "admin_id"=>$admin_id, "admin_name"=>$adminName , "admin_email"=>$adminEmail,  "liveusdrate"=>$livetransid, "created_at"=>$created, "updated_at"=>$updated));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'transactions' => $allTransaction
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


