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
                $query = " SELECT apartment_house_rule.* FROM `apartment_house_rule` LEFT JOIN apartments ON apartments.apartment_id = apartment_house_rule.apart_id LEFT JOIN house_rule ON house_rule.house_rule_id = apartment_house_rule.house_rule_id WHERE apartment_house_rule.status = ? AND ( apartments.name LIKE ? OR apartments.title LIKE ? OR house_rule.name LIKE ? OR house_rule.description LIKE ? ) ";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssss", $status, $searching, $searching, $searching, $searching );
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssss", $status, $searching, $searching , $searching, $searching , $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows; 
            }else{
                // get the total number of pages
                $query = "SELECT apartment_house_rule.* FROM `apartment_house_rule` LEFT JOIN apartments ON apartments.apartment_id = apartment_house_rule.apart_id LEFT JOIN house_rule ON house_rule.house_rule_id = apartment_house_rule.house_rule_id WHERE apartments.name LIKE ? OR apartments.title LIKE ? OR house_rule.name LIKE ? OR house_rule.description LIKE ? ";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssss", $searching, $searching, $searching, $searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssssss", $searching, $searching, $searching, $searching ,$offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }            

        }else{

            if ($sort > 0){
                // Get total number of complains in the system
                $query = "SELECT * FROM `apartment_house_rule` WHERE `status` = ?";
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
                $query = "SELECT * FROM `apartment_house_rule`";
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
            $allRules = [];

            while($row = $result->fetch_assoc()){
                $apartment_id =  $row['apart_id'];
                $apartment_name = getNameFromField($connect, "apartments", "apartment_id", $apartment_id);
                $house_rule = $row['house_rule_id'];
                $house_rule_details = getFieldsDetails($connect, "house_rule", "house_rule_id", $house_rule);
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($allRules, array(
                    'id' => $row['apart_rule_id'],
                    'apartment_id' => $apartment_id,
                    'apartment_name' => ($apartment_name) ? $apartment_name : null,
                    'house_rule' => $house_rule,
                    'house_rule_details' => $house_rule_details,
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
                'apart_rule' => $allRules
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