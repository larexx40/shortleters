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

        // $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        // $pubkey = $decodedToken->usertoken;

        // $admin =  checkIfIsAdmin($connect, $pubkey);
        // $agent = getShopWithPubKey($connect, $user_pubkey);
        // $user = getUserWithPubKey($connect, $user_pubkey);

        // if  (!$admin){

        //     // send user not found response to the user
        //     $errordesc =  "User not an Admin";
        //     $linktosolve = 'https://';
        //     $hint = "Only Admin has the ability to add send grid api details";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondUnAuthorized($data);
        // }

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

    
        if (isset($_GET['sort_price_range'])) {
            if (isset($_GET['start'])){
                $start_price = cleanme($_GET['start']);
            }else{
                $start_price = "";
            }

            if (isset($_GET['end'])){
                $end_price = cleanme($_GET['end']);
            }else{
                $end_price = "";
            }
             //sort result by status if > 0
        } else {
            $price_sort = null;
        }

        // date sort 
        if (isset($_GET['sort_date'])) {
            if (isset($_GET['check_in'])){
                $check_in = cleanme($_GET['check_in']);
            }else{
                $check_in = "";
            }

            if (isset($_GET['check_out'])){
                $check_out = cleanme($_GET['check_out']);
            }else{
                $check_out = "";
            }
             //sort result by status if > 0
        } else {
            $date_sort = null;
        }
        if (isset($_GET['sort_guest'])) {
            $sort_guest = cleanme($_GET['sort_guest']); //sort result by status if > 0
        } else {
            $sort_guest = null;
        }

        if (isset($_GET['sort_country'])) {
            $country_sort = cleanme($_GET['sort_country']); //sort result by status if > 0
        } else {
            $country_sort = null;
        }
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;
        $status = "1";

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            if ($country_sort || $sort_guest || $date_sort || $price_sort){

                // if all  Sort parameters are passed
                if ($country_sort && $sort_guest && $date_sort && $price_sort){
                    // get the total number of pages
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                }

                // if 3 Sort parameters are passed

                if ( $country_sort && $sort_guest && $date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND apartments.apartment_country = ? AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssss", $status, $check_in, $check_out, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssssss", $status, $check_in, $check_out, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }

                if ( $country_sort && $sort_guest && !$date_sort && $price_sort ){
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssss", $status, $start_price, $end_price, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }

                if ( $country_sort && !$sort_guest && $date_sort && $price_sort ){
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ?  AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }

                if ( !$country_sort && $sort_guest && $date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?)  AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }

                // if 2 Sort Paraemters are Passed
                if ( $country_sort && $sort_guest && !$date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND apartments.apartment_country = ? AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssss", $status,  $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssss", $status, $country_sort, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }

                if ( $country_sort && !$sort_guest && $date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND apartments.apartment_country = ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssss", $status, $check_in, $check_out, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssss", $status, $check_in, $check_out, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                
                if ( !$country_sort && $sort_guest && $date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssss", $status, $check_in, $check_out, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssss", $status, $check_in, $check_out, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( $country_sort && !$sort_guest && !$date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssss", $status, $start_price, $end_price, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssss", $status, $start_price, $end_price, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( !$country_sort && $sort_guest && !$date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND (apartments.price BETWEEN ? AND ?)  AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssss", $status, $start_price, $end_price, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssssss", $status, $start_price, $end_price, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( !$country_sort && !$sort_guest && $date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssssss", $status, $check_in, $check_out, $start_price, $end_price, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                // 1 Sort Parameter is Passed
                if ($country_sort && !$sort_guest && !$date_sort && !$price_sort){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND apartments.apartment_country = ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssss", $status, $country_sort, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssss", $status,  $country_sort,  $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                if (!$country_sort && $sort_guest && !$date_sort && !$price_sort){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND apartments.max_guest <= ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssss", $status, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssssssssss", $status, $sort_guest, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                if (!$country_sort && !$sort_guest && $date_sort && !$price_sort){
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssss", $status, $check_in, $check_out, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssss", $status, $check_in, $check_out, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                if (!$country_sort && !$sort_guest && !$date_sort && $price_sort){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND  (apartments.price BETWEEN ? AND ?) AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssss", $status, $start_price, $end_price, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssssssss", $status, $start_price, $end_price, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                
            }else{
                // get the total number of pages
                $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND ( apartments.name LIKE ? OR apartment_category.name LIKE ? OR apartments.title LIKE ? OR apartments.description LIKE ? OR apartments.apartment_address LIKE ? OR apartments.apartment_lga LIKE ? OR apartments.apartment_city LIKE ? OR apartments.apartment_state LIKE ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssssss", $status, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                  $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssssssss", $status, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }            

        }else{

            if ($country_sort || $sort_guest || $date_sort || $price_sort){

                // if all  Sort parameters are passed
                if ($country_sort && $sort_guest && $date_sort && $price_sort){
                    // get the total number of pages
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                }

                // if 3 Sort parameters are passed

                if ( $country_sort && $sort_guest && $date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND apartments.apartment_country = ? AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $check_in, $check_out, $country_sort, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $check_in, $check_out, $country_sort, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }

                if ( $country_sort && $sort_guest && !$date_sort && $price_sort ){
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $start_price, $end_price, $country_sort, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( $country_sort && !$sort_guest && $date_sort && $price_sort ){
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $check_in, $check_out, $start_price, $end_price, $country_sort, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( !$country_sort && $sort_guest && $date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $check_in, $check_out, $start_price, $end_price, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $check_in, $check_out, $start_price, $end_price, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }

                // if 2 Sort Paraemters are Passed
                if ( $country_sort && $sort_guest && !$date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND apartments.apartment_country = ? AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sss", $status,  $country_sort, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $country_sort, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }

                if ( $country_sort && !$sort_guest && $date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ?  AND apartments.apartment_country = ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status, $check_in, $check_out, $country_sort);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $status, $check_in, $check_out, $country_sort, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( !$country_sort && $sort_guest && $date_sort && !$price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status, $check_in, $check_out, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $status, $check_in, $check_out, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( $country_sort && !$sort_guest && !$date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND (apartments.price BETWEEN ? AND ?) AND apartments.apartment_country = ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status, $start_price, $end_price, $country_sort);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $status, $start_price, $end_price, $country_sort, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( !$country_sort && $sort_guest && !$date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND  (apartments.price BETWEEN ? AND ?) AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status, $start_price, $end_price, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $status, $start_price, $end_price, $sort_guest, $searching, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                if ( !$country_sort && !$sort_guest && $date_sort && $price_sort ){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? AND (apartments.price BETWEEN ? AND ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $check_in, $check_out, $start_price, $end_price);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $check_in, $check_out, $start_price, $end_price, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    
                }
                // 1 Sort Parameter is Passed
                if ($country_sort && !$sort_guest && !$date_sort && !$price_sort){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND apartments.apartment_country = ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ss", $status, $country_sort);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status,  $country_sort, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                if (!$country_sort && $sort_guest && !$date_sort && !$price_sort){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND apartments.max_guest <= ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ss", $status, $sort_guest);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status, $sort_guest, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                if (!$country_sort && !$sort_guest && $date_sort && !$price_sort){
                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND bookings.preferred_check_in != ? AND bookings.preferred_check_in != ? ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sss", $status, $check_in, $check_out);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $check_in, $check_out, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                if (!$country_sort && !$sort_guest && !$date_sort && $price_sort){

                    $query = "SELECT apartments.* FROM apartments LEFT JOIN bookings ON bookings.apartment_id = apartments.apartment_id LEFT JOIN apartment_category ON apartment_category.category_id = apartments.category_id WHERE apartments.apartment_status = ? AND (apartments.price BETWEEN ? AND ?) ORDER BY apartments.id DESC, apartments.feature DESC";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sss", $status, $start_price, $end_price);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $start_price, $end_price, $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                }
                
            }else{
                // get the total number of pages
                $query = "SELECT * FROM `apartments` WHERE `apartment_status` = ? ORDER BY feature DESC, id DESC";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("s", $status);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $status, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }

        }

        if ($num_row > 0){
            $allApartments = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $title = $row['title'];
                $images = getApartmentImage($connect, "apartment_images", "apartment_id", $row['apartment_id']);
                $description = $row['description'];
                $space_description = $row["space_description"];
                $guest_access = $row["guest_access"];
                $other_details = $row["other_details"];
                $host_type_id = $row["host_type_id"];
                $host_type_name = getNameFromField($connect, "host_type", "host_type_id", $host_type_id);
                $price = $row["price"];
                $no_of_adults = $row["no_of_adults"];
                $no_of_kids = $row["no_of_kids"];
                $no_of_pets = $row["no_of_pets"];
                $no_of_floor = $row["no_of_floor"];
                $listing_currency_id = $row["listing_currency_id"];
                $listing_currency_name = getNameFromField($connect, "listing_currency", "currency_id", $listing_currency_id);
                $available_floor = $row["available_floor"];
                $safety_ids = ($row["safety_ids"])? explode(",", $row["safety_ids"]) : null;
                $safety_id_name = [];
                if ($safety_ids){
                    for ($i = 0; $i < count($safety_ids); $i++){
                        $id_name = getNameFromField($connect, "guest_safety", "guest_safetyid", $safety_ids[$i]);
                        array_push($safety_id_name, array(
                            'safety_id' => $safety_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $custom_link = $row["custom_link"];
                $availability = $row['availability'];
                $availability = ($row["availability"] > 0)? "Booked" : "Available";
                $getting_around_details = $row["getting_around_details"];
                $neighbourhood_description = $row["neighbourhood_description"];
                $highlights_ids = ($row["highlights_ids"])? explode(",", $row["highlights_ids"]) : null;
                $highlights_id_name = [];
                if ($highlights_ids){
                    for ($i = 0; $i < count($highlights_ids); $i++){
                        $id_name = getNameFromField($connect, "highlights", "highlightid", $highlights_ids[$i]);
                        array_push($highlights_id_name, array(
                            'highlight_id' => $highlights_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $building_type_id = $row["building_type_id"];
                $building_type_name = getNameFromField($connect, "building_types", "build_id", $building_type_id);
                $sub_building_type_id = $row["sub_building_type_id"];
                $sub_building_type_name = getNameFromField($connect, "sub_building_types", "sub_build_id", $sub_building_type_id);
                $amenities_ids = ($row["amenities_id"])? explode(",", $row["amenities_id"]) : null;
                $amenities_id_name = [];
                if ($amenities_ids){
                    for ($i = 0; $i < count($amenities_ids); $i++){
                        $id_name = getNameFromField($connect, "sub_amenities", "sub_amen_id", $amenities_ids[$i]);
                        array_push($amenities_id_name, array(
                            'amenities_id' => $amenities_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $space_type_id = $row["space_type_id"];
                $space_type_name = getNameFromField($connect, "space_type", "space_id", $space_type_id);
                if ( $row['apartment_status'] == 1 ){
                    $apartment_status = "Listed";
                }
                if ( $row['apartment_status'] == 2 ){
                    $apartment_status = "Snoozed";
                }
                if ( $row['apartment_status'] == 3 ){
                    $apartment_status = "Unlisted";
                }
                if ( $row['apartment_status'] == 4 ){
                    $apartment_status = "Deactivated";
                }
                $apartment_status_code = $row['apartment_status'];
                $agent_id = $row['agent_id'];
                // $space_type_name = getNameFromField($connect, "space_type", "space_id", $space_type_id);
                $apartment_address = $row["apartment_address"];
                $apartment_country = $row["apartment_country"];
                $apartment_city = $row["apartment_city"];
                $apartment_state = $row["apartment_state"];
                $longtitude = $row["longtitude"];
                $latitude = $row["latitude"];
                $apartment_lga = $row["apartment_lga"];
                $location_sharing = ($row["location_sharing"] > 0)? "Sharing" : "Not Sharing";
                $scenic_ids = ($row["scenic_ids"])? explode(",", $row["scenic_ids"]): null;
                $scenic_id_name = [];
                if ($scenic_ids){
                    for ($i = 0; $i < count($scenic_ids); $i++){
                        $id_name = getNameFromField($connect, "scenic_view", "scenicid", $scenic_ids[$i]);
                        array_push($scenic_id_name, array(
                            'scenic_id' => $scenic_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $min_stay = $row["min_stay"];
                $max_stay = $row["max_stay"];
                $duration = $row["duration"];
                $check_in_day = $row["check_in_day"];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($allApartments, array(
                    'id' => $row['apartment_id'],
                    'name' => $name,
                    'status_code' => $status_code,
                    'status' => $status,
                    'title' => $title,
                    'description' => $description,
                    'images' => ($images) ? $images : null,
                    'space_description' => $space_description,
                    'guest_access' => $guest_access,
                    'other_details' => $other_details,
                    'host_type_id' => $host_type_id,
                    'host_type_name' => ($host_type_name) ? $host_type_name : null,
                    'price' => $price,
                    'no_of_adults' => $no_of_adults,
                    'no_of_kids' => $no_of_kids,
                    'no_of_pets' => $no_of_pets,
                    'no_of_floor' => $no_of_floor,
                    'listing_currency_id' => $listing_currency_id,
                    'listing_currency_name' => ($listing_currency_name) ? $listing_currency_name : null,
                    'available_floor' => $available_floor,
                    'safety_ids' => $safety_id_name,
                    'custom_link' => $custom_link,
                    'availability' => $availability,
                    'availability' => $availability,
                    'neighbourhood_description' => $neighbourhood_description,
                    'getting_around_details' => $getting_around_details,
                    'highlights_ids' => $highlights_id_name,
                    'building_type_id' => $building_type_id,
                    'building_type_name' => ($building_type_name) ?  $building_type_name : null,
                    'sub_building_type_id' => $sub_building_type_id,
                    'sub_building_type_name' => ($sub_building_type_name) ?  $sub_building_type_name : null,
                    'amenities_ids' => $amenities_id_name,
                    'space_type_id' => $space_type_id,
                    'space_type_name' => ($space_type_name) ?  $space_type_name : null,
                    'apartment_status_code' => $apartment_status_code,
                    'apartment_status' => $apartment_status,
                    'agent_id' => $agent_id,
                    'apartment_address' => $apartment_address,
                    'apartment_country' => $apartment_country,
                    'apartment_city' => $apartment_city,
                    'apartment_state' => $apartment_state,
                    'longtitude' => $longtitude,
                    'latitude' => $latitude,
                    'apartment_lga' => $apartment_lga,
                    'location_sharing' => $location_sharing,
                    'location_sharing_code' => $row["location_sharing"],
                    'scenic_ids' => $scenic_id_name,
                    'min_stay' => $min_stay,
                    'max_stay' => $max_stay,
                    'duration' => $duration,
                    'check_in_day' => $check_in_day,
                    'created' => $created,
                    'updated' => $updated,
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'apartments' => $allApartments
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