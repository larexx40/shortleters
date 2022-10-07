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

        $user_id = getUserWithPubKey($connect, $user_pubkey);
        $admin = checkIfIsAdmin($connect, $user_pubkey);


        // check if user is admin
        if ( !$user_id && !$admin ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $admin ){
            if ( !isset($_GET['userid'])) {

                $errordesc="user id is required";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="user id must be passed";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
    
            }else{
                $user_id = cleanme($_GET['userid']);
            }
        }


        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = cleanme($_GET['page']);  
        }

        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 5;  
        }

        $offset = ($page_no - 1) * $no_per_page;


        
        // Output page
        $query = "SELECT usernotification.*, user_transactions.transaction_type, user_transactions.amttopay  FROM `usernotification` 
                LEFT JOIN user_transactions ON usernotification.transaction_id = user_transactions.transactionid 
                where `user_id` = ?";
        $getAll = $connect->prepare($query);
        $getAll->bind_param("s", $user_id);
        $getAll->execute();
        $result = $getAll->get_result();
        $total_num_row = $result->num_rows;
        $total_pg_found =  ceil($total_num_row / $no_per_page);

        $query = "$query LIMIT ?,?";
        $getAll = $connect->prepare($query);
        $getAll->bind_param("sss", $user_id, $offset, $no_per_page);
        $getAll->execute();
        $result = $getAll->get_result();
        $num_row = $result->num_rows;

            if ($num_row > 0){
            $all_Notifications = [];

                while($row = $result->fetch_assoc()){
                    $statusCode = $row['notificationstatus'];
                    $status = ($row['notificationstatus'] == 1)? "completed" : "pending";
                    $notificationtype = $row['notificationtype'];
                    // if ($row['notificationtype'] == 1) {
                    //     $type = "normal";
                    // }
            
                    // if ($row['notificationtype'] == 2) {
                    //     $type = "product";
                    // }
            
                    
                    $id = $row['id'];
                    $notificationtext = $row['notificationtext'];
                    $notificationcode = $row['notificationcode'];
                    $fullname = getUserFullname($connect, $row['user_id']);
                    $apartment_id = $row['apartment_id'];
                    $apartmentName = ($apartment_id) ? getNameFromField($connect, "apartments" , "apartment_id" , $apartment_id) : null;
                    $booking_id = $row['booking_id'];
                    $transaction_id = $row['transaction_id']; 
                    $transaction_typeCode = $row['transaction_type'];
                    if($transaction_typeCode== 1){
                        $transaction_type = "Fund Wallet";
                    }elseif($transaction_typeCode== 2){
                        $transaction_type = "Withdraw";
                    }elseif($transaction_typeCode== 3){
                        $transaction_type = "Book Apartment";
                    }else{
                        $transaction_type = '';
                    }
                    $amount = $row['amttopay'];
                    $read_statusCode = $row['read_status'];  
                    $read_status = ($row['read_status'] == 0 )? "Unread" : "Read";
                    $date = $row['created_at'];             

                    array_push($all_Notifications, array("id"=>$id, 'read_statusCode'=>$read_statusCode, 'read_status'=>$read_status, "status"=>$status, 'statusCode'=>$statusCode, "notificationtype"=>$notificationtype, "notificationtext"=>$notificationtext, "apartment_id"=>$apartment_id, "apartmentName"=>$apartmentName, "booking_id"=>$booking_id,
                    'amount'=>$amount, "transaction_id"=>$transaction_id, 'transaction_typeCode'=>$transaction_typeCode, 'transaction_type'=>$transaction_type, 'date'=>$date));
                }

                $data = array(
                    'page' => $page_no,
                    'per_page' => $no_per_page,
                    'total_data' => $total_num_row,
                    'totalPage' => $total_pg_found,
                    'notification' => $all_Notifications
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "No User Notifications";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondOK($data);

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