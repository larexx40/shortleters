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

        $admin = checkIfIsAdmin($connect, $user_pubkey);

        // send error if ur is not in the database
        if ( !$admin ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only admin is authorized is to get all users";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        
        
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

        // Check if status is passed;
        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort result by status if > 0
        } else {
            $sort = "";
        }
    
        if (isset($_GET['sortstatus'])) {
            $status = cleanme($_GET['sortstatus']); //sort result by status if > 0
        } else {
            $status = "";
        }

        if (!isset($_GET['per_page'])){
            $no_per_page = 8;
        }else{
            $no_per_page = cleanme($_GET['per_page']);
        }

        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
           if ($sort > 0){
                $searching = "%{$search}%";
                // get the total number of pages
                $query = "SELECT `id`, `email`, `fname`, `lname`, `phoneno`, `location`, `bal`, `refcode`, `referby`, `fcm`, `adminseen`, status, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `username`, `dob`, `sex` FROM `users` WHERE status = ? AND ( email LIKE ? OR fname LIKE ? OR lname LIKE ? OR state LIKE ? OR state LIKE ? OR country LIKE ? )";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssss", $status ,$searching, $searching, $searching, $searching, $searching, $searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $query = "SELECT `id`, `email`, `fname`, `lname`, `phoneno`, `location`, `bal`, `refcode`, `referby`, `fcm`, `adminseen`, status, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `username`, `dob`, `sex` FROM `users` WHERE status = ? AND ( email LIKE ? OR fname LIKE ? OR lname LIKE ? OR state LIKE ? OR state LIKE ? OR country LIKE ? ) LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssssss", $status ,$searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

           }else{
                $searching = "%{$search}%";
                

                // get the total number of pages
                $query = "SELECT `id`, `email`, `fname`, `lname`, `phoneno`, `location`, `bal`, `refcode`, `referby`, `fcm`, `adminseen`, status, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `username`, `dob`, `sex` FROM `users` WHERE email LIKE ? OR fname LIKE ? OR lname LIKE ? OR state LIKE ? OR state LIKE ? OR country LIKE ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssssss", $searching, $searching, $searching, $searching, $searching, $searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $query = "SELECT `id`, `email`, `fname`, `lname`, `phoneno`, `location`, `bal`, `refcode`, `referby`, `fcm`, `adminseen`, status, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `username`, `dob`, `sex` FROM `users` WHERE email LIKE ? OR fname LIKE ? OR lname LIKE ? OR state LIKE ? OR state LIKE ? OR country LIKE ? LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssssssss", $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;   
           }         

        }else{
            if ($sort > 0){
                // Get total number of complains in the system
                $query = "SELECT * FROM `users` WHERE `status` = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $status);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM `users` WHERE `status` = ? LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sss", $status ,$offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            }else{
                 // Get total number of complains in the system
                    $query = "SELECT * FROM `users`";
                    $gtTotalPgs = $connect->prepare($query);
                    $gtTotalPgs->execute();
                    $result = $gtTotalPgs->get_result();
                    $total_num_row = $result->num_rows;
                    $totalPage = ceil($total_num_row / $no_per_page);

                    $query = "SELECT * FROM `users` LIMIT ?, ?";
                    $gtTotalcomplains = $connect->prepare($query);
                    $gtTotalcomplains->bind_param("ss", $offset, $no_per_page);
                    $gtTotalcomplains->execute();
                    $result = $gtTotalcomplains->get_result();
                    $num_row = $result->num_rows;
            }
        }

        if ($num_row > 0){
            $allUsers = [];

            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $email = $row['email'];
                $firstname = $row['fname'];
                $lastname = $row['lname'];
                $phoneno = $row['phoneno'];
                $location = $row['location'];
                $balance = $row['bal'];
                $refcode = $row['refcode'];
                $state = $row['state'];
                $country = $row['country'];
                $username = $row['username'];
                $dob = $row['dob'];
                $sex = $row['sex'];
                $referredBy = ( getUserFullname($connect, $row['referby']) ) ? getUserFullname($connect, $row['referby']) : "";
                $statusCode = $row['status'];
                if ($row['status'] == 0){
                    $userStatus = "banned";
                }
                if ($row['status'] == 1){
                    $userStatus = "active";
                }
                if ($row['status'] == 2){
                    $userStatus = "suspended";
                }
                if ($row['status'] == 3){
                    $userStatus = "frozen";
                }
                $adminSeen = $row['adminseen'];
                $adminCheck = ($row['adminseen'] == 0) ? "Not seen" : "Seen";

                
                array_push($allUsers, array(
                    'id' => $id,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phoneno' => $phoneno,
                    'location' => $location,
                    'balance' => $balance,
                    'refcode' => $refcode,
                    'state' => $state,
                    'country' => $country,
                    'status_code' => $statusCode,
                    'status' => $userStatus,
                    'status' => $userStatus,
                    'admin_seen_code' => $adminSeen,
                    'admin_seen' => $adminCheck,
                    'username' => $username,
                    'referredBy' => $referredBy,
                    'dob' => $dob,
                    "sex" => $sex
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $totalPage,
                'users' => $allUsers
            );
            $text= "Search completed";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc = "No Records";
        $linktosolve = 'https://';
        $hint = "Kindly make sure the table has been populated";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondOK($data);
       

    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
        
    }


?>