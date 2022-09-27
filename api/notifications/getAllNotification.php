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
        if (!checkIfIsAdmin($connect, $user_pubkey) ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

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
            $type =$_GET['sortType'] ;
        } else {
            $type = '';
        }

        // pagination and search parameters
        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 5;  
        }

        $offset = ($page_no - 1) * $no_per_page;

        if($sort > 0){
            if(is_numeric($status) && !is_numeric($type)){//get where only status is passed
                //sort with notificationstatus
                if (!empty($search) && $search != "" && $search != " "){
                    $searching = "%{$search}%";
                    // get the total number of pages
                    $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                            LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                            LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                            WHERE (apartments.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ?) AND usernotification.notificationstatus =?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ssss", $searching, $searching, $searching, $status);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    $totalPage = ceil($num_row / $no_per_page);  
        
                    // Output page
                    $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ssssss", $searching, $searching, $searching, $status, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
        
                    
                }else{
                    $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                            LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                            LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                            WHERE usernotification.notificationstatus = ? ";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("s",$status);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    $totalPage = ceil($num_row / $no_per_page);  
        
                    // Output page
                    $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("sss",$status, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    
        
                }
            }
            if(!is_numeric($status) && is_numeric($type)){//get where only status is passed
                //sort with notificationtype
                if (!empty($search) && $search != "" && $search != " "){
                    $searching = "%{$search}%";
                    // get the total number of pages
                    $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                            LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                            LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                            WHERE (apartments.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ?) AND usernotification.notificationtype =?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ssss", $searching, $searching, $searching, $type);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    $totalPage = ceil($num_row / $no_per_page);  
        
                    // Output page
                    $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ssssss", $searching, $searching, $searching, $type, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
        
                    
                }else{
                    $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                            LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                            LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                            WHERE usernotification.notificationtype = ? ";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("s",$type);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    $totalPage = ceil($num_row / $no_per_page);  
        
                    // Output page
                    $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("sss",$type, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
        
                }
            }
            if(is_numeric($status) && is_numeric($type)){//get where only status is passed
                //sort with notificationtype and notificationstatus
                if (!empty($search) && $search != "" && $search != " "){
                    $searching = "%{$search}%";
                    // get the total number of pages
                    $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                            LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                            LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                            WHERE (apartments.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ?) AND usernotification.notificationstatus =? AND usernotification.notificationtype =?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("sssss", $searching, $searching, $searching, $status, $type);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    $totalPage = ceil($num_row / $no_per_page);  
        
                    // Output page
                    $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("sssssss", $searching, $searching, $searching, $status, $type, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
        
                    
                }else{
                    $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                            LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                            LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                            WHERE usernotification.notificationstatus = ? AND usernotification.notificationtype =? ";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ss",$status, $type);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                    $totalPage = ceil($num_row / $no_per_page);  
        
                    // Output page
                    $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ssss",$status, $type, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
        
                }
            }
            if(!is_numeric($status) && !is_numeric($type)){
                $errordesc="Pass in type or status";
                $linktosolve="htps://";
                $hint=["Ensure you pass a valid Email","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="pass in type or status";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }

        }else{
            if (!empty($search) && $search != "" && $search != " "){
                $searching = "%{$search}%";
                // get the total number of pages
                $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                        LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                        LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id 
                        WHERE apartments.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sss", $searching, $searching, $searching);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
                $totalPage = ceil($num_row / $no_per_page);  
    
                // Output page
                $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sssss", $searching, $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
    
                
            }else{
                $query = "SELECT usernotification.* FROM `usernotification` LEFT JOIN users ON usernotification.user_id = users.id 
                        LEFT JOIN bookings ON usernotification.booking_id = bookings.booking_id 
                        LEFT JOIN apartments ON usernotification.apartment_id = apartments.apartment_id ";
                $getAll = $connect->prepare($query);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
                $totalPage = ceil($num_row / $no_per_page);  
    
                // Output page
                $query = "$query ORDER BY usernotification.id LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ss", $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
    
            }
        }

        

        if ($num_row > 0){

            $allNotification = [];

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

                array_push($allNotification, array("id"=>$id, "status"=>$status, 'statusCode'=>$statusCode, "notificationtype"=>$notificationtype, "notificationtext"=>$notificationtext, "apartment_id"=>$apartment_id, "apartmentName"=>$apartmentName, "booking_id"=>$booking_id,
                "transaction_id"=>$transaction_id));
            }

            $data = array(
                'totalPage' => $totalPage,
                'notifications' => $allNotification
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


