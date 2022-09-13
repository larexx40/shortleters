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
        
        // send error if ur is not in the database
        if (!getShopWithPubKey($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not found";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $shop_id = getShopWithPubKey($connect, $user_pubkey);

        

        $status = 1;

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
        
        $no_per_page = 8;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
             // get the total number of pages
             $query = "SELECT shop_locations.id, shop_id, shop_locations.name, longitude, latitude shop_locations.created_at, shop_locations.updated_at, shop_locations.status FROM shop_locations LEFT JOIN `shops` ON shop_locations.shop_id = shops.id WHERE name Like ? AND status = ? AND shops.id = ?";
             $queryStmt = $connect->prepare($query);
             $queryStmt->bind_param("sss", $searching, $status, $shop_id);
             $queryStmt->execute();
             $resut = $queryStmt->get_result();
             $num_row = $resut->num_rows;
             $total_pg_found =  ceil($num_row / $no_per_page);
 
            $query = "SELECT shop_locations.id, shop_id, shop_locations.name, longitude, latitude shop_locations.created_at, shop_locations.updated_at, , shop_locations.status FROM shop_locations LEFT JOIN `shops` ON shop_locations.shop_id = shops.id WHERE name Like ? AND status = ? AND shops.id = ? LIMIT ?, ?";
            $gtTotalLoc = $connect->prepare($query);
            $gtTotalLoc->bind_param("sssss", $searching, $status, $shop_id, $offset, $no_per_page);
            $gtTotalLoc->execute();
            $result = $gtTotalLoc->get_result();
            $num_row = $result->num_rows;
 
             if ($num_row > 0){
                $allLocations = [];

                while($row = $resut->fetch_assoc()){
                    $shopname = getShopname($connect, $row['shop_id']);
                    $location = $row['name'];
                    $status = ($row['status'] == 0) ? "inactive" : "active";
                    
                    array_push($allLocations, array(
                        'shopname' => $shopname,
                        'location' => $location,
                        'status' => $status
                    ));
                }

                $data = array(
                    'totalPage' => $total_pg_found,
                    'complains' => $allLocations
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
             }else{
                $errordesc = "Location not found";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
        }else{
            // Get total number of complains in the system
            $query = "SELECT `shop_id`, `name`, `created_at`, `updated_at`, `longitude`, `latitude`, `status` FROM `shop_locations` WHERE status = ? AND shop_id = ?";
            $gtTotalPgs = $connect->prepare($query);
            $gtTotalPgs->bind_param("ss", $status, $shop_id);
            $gtTotalPgs->execute();
            $result = $gtTotalPgs->get_result();
            $num_row = $result->num_rows;
            $total_pg_found =  ceil($num_row / $no_per_page);

            $query = "SELECT `shop_id`, `name`, `created_at`, `updated_at`, `longitude`, `latitude`, `status` FROM `shop_locations` WHERE status = ? AND shop_id = ? LIMIT ?, ?";
            $gtTotalLoc = $connect->prepare($query);
            $gtTotalLoc->bind_param("ssss", $status, $shop_id, $offset, $no_per_page);
            $gtTotalLoc->execute();
            $result = $gtTotalLoc->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allLocations = [];

                while($row = $resut->fetch_assoc()){
                    $shopname = getShopname($connect, $row['shop_id']);
                    $location = $row['name'];
                    $status = ($row['status'] == 0) ? "inactive" : "active";
                    
                    array_push($allLocations, array(
                        'shopname' => $shopname,
                        'location' => $location,
                        'status' => $status
                    ));
                }

                $data = array(
                    'totalPage' => $total_pg_found,
                    'complains' => $allLocations
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);

            }else{
                $errordesc = "No Records";
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