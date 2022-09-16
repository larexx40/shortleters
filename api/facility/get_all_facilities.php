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

        $admin =  checkIfIsAdmin($connect, $pubkey);
        // $agent = getShopWithPubKey($connect, $user_pubkey);
        // $user = getUserWithPubKey($connect, $user_pubkey);

        if  (!$admin){

            // send user not found response to the user
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
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
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            if ($sort > 0){
               
                // get the total number of pages
                $query = "SELECT  `facility_id`, `name`, `description`, `created_at`, `updated_at`, `status` FROM `facilities` WHERE status = ? AND ( name LIKE ? OR description LIKE ?) ";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $status, $searching, $searching );
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssss", $status, $searching, $searching , $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows; 
            }else{
                // get the total number of pages
                $query = "SELECT  `facility_id`, `name`, `description`, `created_at`, `updated_at`, `status` FROM `facilities` WHERE name LIKE ? OR icon LIKE ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ss", $searching, $searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssss", $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }            

        }else{

            if ($sort > 0){
                // Get total number of complains in the system
                $query = "SELECT * FROM `facilities` WHERE `status` = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $status);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sss", $status ,$offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            }else{
                // Get total number of complains in the system
                $query = "SELECT * FROM `facilities`";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("ss", $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
                
            }
            

        }

        if ($num_row > 0){
            $allFacilities = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $description = $row['description'];
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($allFacilities, array(
                    'id' => $row['facility_id'],
                    'name' => $name,
                    'description' => $description,
                    'status_code' => $status_code,
                    'status' => $status,
                    'created' => $created,
                    'updated' => $updated
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'facilities' => $allFacilities
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc = "No Records found";
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