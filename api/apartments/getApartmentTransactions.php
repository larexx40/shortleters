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
       if(!isset($_GET['apartment_id'])){
        $errordesc="apartment id required";
        $linktosolve="htps://";
        $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Pass in space apartment id";
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondBadRequest($data);
        
        }else {
            $apartment_id = cleanme($_GET['apartment_id']); 
        }

        //confirm if space type id is not empty
        if(empty($apartment_id)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in the apartment id ";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
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

        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        } 
        $offset = ($page_no - 1) * $no_per_page;
        
        $query = "SELECT user_transactions.transactionid, user_transactions.booking_id ,user_transactions.ordertime, user_transactions.amttopay, user_transactions.status, bookings.user_id, bookings.first_name, bookings.last_name FROM `user_transactions` LEFT JOIN bookings ON bookings.booking_id = user_transactions.booking_id WHERE bookings.apartment_id = ?";
        $gtTotalPgs = $connect->prepare($query);
        $gtTotalPgs->bind_param("s", $apartment_id);
        $gtTotalPgs->execute();
        $result = $gtTotalPgs->get_result();
        $total_num_row = $result->num_rows;
        $total_pg_found =  ceil($total_num_row / $no_per_page); 

        $query = "$query LIMIT ?, ?";
        $gtTotalcomplains = $connect->prepare($query);
        $gtTotalcomplains->bind_param("sss", $apartment_id ,$offset, $no_per_page);
        $gtTotalcomplains->execute();
        $result = $gtTotalcomplains->get_result();
        $num_row = $result->num_rows;

        //check for db error || connection lost
        if(!$gtTotalcomplains->execute()){
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

        $gtTotalcomplains->close();
        
        if($num_row > 0){
            //pass fetched data as array maindata[]
            $all_transaction = [];
            while ($row = $result->fetch_assoc()){
                $userid = $row['user_id'];
                if ($userid){
                    $user_fullname = ( $userid )? getUserFullname($connect, $userid) : null;
                }else{
                    $user_fullname = $row['last_name']. " ". $row["first_name"];
                }
                
                $transactionid = $row['transactionid'];
                $booking_id = $row['booking_id'];
                $ordertime = gettheTimeAndDate(strtotime($row['ordertime']));
                $amttopay = $row['amttopay'];
                $statusCode = $row['status'];

                if($statusCode == 1){
                    $status = "Active";
                }else{
                    $status = "Inactive";
                }

                array_push($all_transaction, array(
                    "id"=>$transactionid,
                    "userid"=>$userid,
                    'user_fullname' => ($user_fullname)? $user_fullname : null,
                    "booking_id"=>$booking_id,
                    "ordertime"=>$ordertime,
                    'status_code' => $statusCode,
                    "status"=>$status,
                    "amttopay"=>$amttopay,
                ));

            }
            
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'apartment_transaction' => $all_transaction
            );
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