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
        $pubkey = $decodedToken->usertoken;

        $admin = checkIfIsAdmin($connect, $pubkey);
        $user_id = getUserWithPubKey($connect, $pubkey);
        $shop_id = checkIfShopOwner($connect, $pubkey);
        $logistics_id = getLogisticsWithPubKey($connect, $pubkey);

        if  (!$admin && !$user_id && !$shop_id && !$logistics_id ){

            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ($admin){
            
            if ( !isset($_GET['userid']) ){
                // send error if complaint field is not passed
                $errordesc = "All fields must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required complaint field in this register endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $user = cleanme($_GET['userid']);
            }
        
            if (!isset( $_GET['user_type'])){
                // send error if complaint field is not passed
                $errordesc = "All fields must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required complaint field in this register endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $user_type = cleanme($_GET['user_type']);
            }

            if ($user_type == 2 || $user_type == 'shop'){
                $type = 2;
            }
            if ($user_type == 3 || $user_type == 'logistics'){
                $type = 3;
            }
            if ($user_type == 4 || $user_type == 'user'){
                $type = 4;
            }

        }else{
            if ( $shop_id ){
                $user = $shop_id;
                $type = 2;
            }
            if ( $logistics_id ){
                $user = $logistics_id;
                $type = 3;
            }
            if ( $user_id ){
                $user = $user_id;
                $type = 4;
            }
        }

        if (!isset($_GET['search'])) {
            $search = "";
        } else {
            $search = cleanme($_GET['search']);

        }

    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = cleanme($_GET['page']);  
        }

        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        if (isset($_GET['sortStatus'])) {
            $status = cleanme($_GET['sortStatus']); //status =1 or 0
        } else {
            $status = "";
        }

        
        
        $offset = ($page_no - 1) * $no_per_page;

        // check if search is passed and complete the search
        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";

            // check if sort parameter is passed
            if ( $sort > 0 ){
                $query = "SELECT
                    usercomplains.id,
                    user_id,
                    complain,
                    usercomplains.adminseen,
                    usercomplains.created_at,
                    usercomplains.updated_at,
                    usercomplains.status,
                    usercomplains.user_type
                FROM
                    usercomplains
                LEFT JOIN users ON usercomplains.user_id = users.id
                WHERE
                usercomplains.user_type = ? AND usercomplains.user_id = ? AND usercomplains.status = ? AND (usercomplains.complain LIKE ? OR users.fname LIKE ? OR users.lname LIKE ? )";
                
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $type, $user, $status ,$searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "SELECT
                    usercomplains.id,
                    `user_id`,
                    `complain`,
                    usercomplains.adminseen,
                    usercomplains.created_at,
                    usercomplains.updated_at,
                    usercomplains.status,
                    usercomplains.user_type
                FROM
                    `usercomplains`
                LEFT JOIN `users` ON `usercomplains`.`user_id` = users.id
                WHERE
                    user_type = ? AND user_id = ? AND usercomplains.status = ? AND ( usercomplains.complain LIKE ? OR users.fname LIKE ? OR users.lname LIKE ? ) LIMIT ?, ?";
                    
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssss",  $type,$user, $status ,$searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

            }else{
                $query = "SELECT
                    usercomplains.id,
                    user_id,
                    complain,
                    usercomplains.adminseen,
                    usercomplains.created_at,
                    usercomplains.updated_at,
                    usercomplains.status,
                    usercomplains.user_type
                FROM
                    usercomplains
                LEFT JOIN users ON usercomplains.user_id = users.id
                WHERE
                usercomplains.user_type = ? AND usercomplains.user_id = ? AND (usercomplains.complain LIKE ? OR users.fname LIKE ? OR users.lname LIKE ? )";
                
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss",$type,$user,  $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "SELECT
                    usercomplains.id,
                    `user_id`,
                    `complain`,
                    usercomplains.adminseen,
                    usercomplains.created_at,
                    usercomplains.updated_at,
                    usercomplains.status,
                    usercomplains.user_type
                FROM
                    `usercomplains`
                LEFT JOIN `users` ON `usercomplains`.`user_id` = users.id
                WHERE
                    `user_type` = ? AND `user_id` = ? AND ( usercomplains.complain LIKE ? OR users.fname LIKE ? OR users.lname LIKE ? ) LIMIT ?, ?";
                    
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss",  $type,$user, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
            }
            // get the total number of pages            

        }else{
            // check if sort is passed if search is not passed
            if ( $sort > 0 ){
                // Get total number of complains in the system
                $query = "SELECT * FROM `usercomplains` WHERE `user_id` = ? AND `user_type` = ? AND status = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("sss", $user, $type, $status);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM `usercomplains` WHERE `user_id` = ? AND `user_type` = ? AND status = ? LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sssss", $user, $type, $status ,$offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            }else{
                // Get total number of complains in the system
                $query = "SELECT * FROM `usercomplains` WHERE `user_id` = ? AND `user_type` = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("ss", $user, $type);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM `usercomplains` WHERE `user_id` = ? AND `user_type` = ? LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("ssss", $user, $type, $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            }        

        }

        if ($num_row > 0){
            $allComplain = [];


            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $userid = $row['user_id'];
                $fullname = getUserFullname($connect, $row['user_id']);
                $complain = $row['complain'];
                $seen = ( $row['adminseen'] == 0) ? "unread" : "read";
                $complain_status = ($row['status'] ) ? $row['status'] : "";
                $status = ( $complain_status == 0) ? "Pending" : "Resolved";
                $user_type = ( $row['user_type'] )? $row['user_type'] : "";
                $date = ($row['created_at']) ? date("H:i:s", strtotime($row['created_at'])) : "";
                
                if ( $user_type == 2 ){
                    $user = 'shop';
                }
                if ( $user_type == 3 ){
                    $user = 'logistics';
                }
                if ( $user_type == 4 ){
                    $user = 'user';
                }

                array_push($allComplain, array(
                    'id' => $id,
                    'user_id' => $user_id,
                    'name' => $fullname,
                    'complain' => $complain,
                    'admin_seen' => $seen,
                    'date' => $date,
                    'status' => $status,
                    'status_code' => $complain_status,
                    'user_type' => $user_type,
                    'user' => $user
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'complains' => $allComplain
            );
            $text= "Search completed";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc = "No Complain Found";
        $linktosolve = 'https://';
        $hint = "Kindly make sure the table has been populated";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondOK($data);

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