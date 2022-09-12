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

        // get if the user is a shop
        $shop_id = getShopWithPubKey($connect, $user_pubkey);
        $admin = checkIfIsAdmin($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if (!$shop_id && !$admin){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $admin ){
            if (!isset($_GET["shopid"] ) ){
                $errordesc = "shop id field must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required shop id field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $shop_id = cleanme($_GET["shopid"]);
            }
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
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            
            if ( $sort > 0){
                // get the total number of pages
                $query = "SELECT shop_locations.id, shop_id, shop_locations.name, longitude, latitude, shop_locations.created_at, shop_locations.updated_at, shop_locations.status FROM shop_locations LEFT JOIN `shops` ON shop_locations.shop_id = shops.id WHERE ( shops.name LIKE ? OR shop_locations.name LIKE ? ) AND shop_locations.shop_id = ? AND shop_locations.status = ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssss", $searching ,$searching, $shop_id, $status);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 
    
                $query = "SELECT shop_locations.id, shop_id, shop_locations.name, longitude, latitude, shop_locations.created_at, shop_locations.updated_at, shop_locations.status FROM shop_locations LEFT JOIN `shops` ON shop_locations.shop_id = shops.id WHERE ( shops.name LIKE ? OR shop_locations.name LIKE ? ) AND shop_locations.shop_id = ? AND shop_locations.status = ? LIMIT ?, ?";
                $gtTotalLoc = $connect->prepare($query);
                $gtTotalLoc->bind_param("ssssss", $searching, $searching ,$shop_id, $status ,$offset, $no_per_page);
                $gtTotalLoc->execute();
                $result = $gtTotalLoc->get_result();
                $num_row = $result->num_rows;

            }else{
                // get the total number of pages
                $query = "SELECT shop_locations.id, shop_id, shop_locations.name, longitude, latitude, shop_locations.created_at, shop_locations.updated_at, shop_locations.status FROM shop_locations LEFT JOIN `shops` ON shop_locations.shop_id = shops.id WHERE ( shops.name LIKE ? OR shop_locations.name LIKE ? ) AND shop_locations.shop_id = ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $searching, $searching, $shop_id);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 
    
                $query = "SELECT shop_locations.id, shop_id, shop_locations.name, longitude, latitude, shop_locations.created_at, shop_locations.updated_at, shop_locations.status FROM shop_locations LEFT JOIN `shops` ON shop_locations.shop_id = shops.id WHERE ( shops.name LIKE ? OR shop_locations.name LIKE ? ) AND shop_locations.shop_id = ? LIMIT ?, ?";
                $gtTotalLoc = $connect->prepare($query);
                $gtTotalLoc->bind_param("sssss", $searching, $searching ,$shop_id, $offset, $no_per_page);
                $gtTotalLoc->execute();
                $result = $gtTotalLoc->get_result();
                $num_row = $result->num_rows;
            }
 
        }else{
            if ( $sort > 0){
                // Get total number of complains in the system
                $query = "SELECT * FROM `shop_locations` WHERE shop_id = ? AND status = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("ss", $shop_id, $status);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "SELECT * FROM `shop_locations` WHERE shop_id = ? AND status = ? LIMIT ?, ?";
                $gtTotalLoc = $connect->prepare($query);
                $gtTotalLoc->bind_param("ssss", $shop_id, $status ,$offset, $no_per_page);
                $gtTotalLoc->execute();
                $result = $gtTotalLoc->get_result();
                $num_row = $result->num_rows;

            }else{
                // Get total number of complains in the system
                $query = "SELECT * FROM `shop_locations` WHERE shop_id = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $shop_id);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "SELECT * FROM `shop_locations` WHERE shop_id = ? LIMIT ?, ?";
                $gtTotalLoc = $connect->prepare($query);
                $gtTotalLoc->bind_param("sss", $shop_id, $offset, $no_per_page);
                $gtTotalLoc->execute();
                $result = $gtTotalLoc->get_result();
                $num_row = $result->num_rows;  
            }
            

        }

        if ($num_row > 0){
            $allLocations = [];

            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $shopname = getShopname($connect, $row['shop_id']);
                $location = $row['name'];
                $status = ($row['status'] == 0) ? "Inactive" : "Active";
                $latitude = $row['latitude'];
                $longtitude = $row['longitude'];
                
                array_push($allLocations, array(
                    'id' => $id,
                    'shopname' => $shopname,
                    'location' => $location,
                    'longitude' => $longtitude,
                    'latitude' => $latitude,
                    'status' => $status,
                    'status_code' => $row['status'],
                    'shop_id' => $row['shop_id']
                ));
            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'Location' => $allLocations
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }else{
            $errordesc = "No Records found";
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