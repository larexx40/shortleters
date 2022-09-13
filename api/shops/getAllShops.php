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
        if (!checkIfIsAdmin($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can add, delete, update and get Termi Table Details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
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
        
            // get the total number of pages
            if ($sort > 0){
                $query = "SELECT * FROM `shops` WHERE status = ? AND ( `name` LIKE ? OR `shop_email` LIKE ? OR `username` LIKE  ? OR `shoptype` LIKE ? OR country LIKE ? OR city LIKE ?)";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("sssssss", $status ,$searching, $searching, $searching, $searching, $searching, $searching);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 
    
                // Output page
                $query = "SELECT * FROM `shops` WHERE status = ? AND (`name` LIKE ? OR `shop_email` LIKE ? OR `username` LIKE  ? OR `shoptype` LIKE ? OR country LIKE ? OR city LIKE ? ) LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sssssssss", $status ,$searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;

            }else{
                $query = "SELECT * FROM `shops` WHERE `name` LIKE ? OR `shop_email` LIKE ? OR `username` LIKE ? OR `shoptype` LIKE ? OR country LIKE ? OR city LIKE ?";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("ssssss", $searching, $searching, $searching, $searching, $searching, $searching);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);  
    
                // Output page
                $query = "SELECT * FROM `shops` WHERE `name` LIKE ? OR `shop_email` LIKE ? OR `username` LIKE  ? OR `shoptype` LIKE ? OR country LIKE ? OR city LIKE ? LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ssssssss", $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }
            

        }else{
            if ($sort > 0){
                $query = "SELECT * FROM `shops` WHERE status = ?";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("s", $status);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);
    
                // Output page
                $query = "SELECT * FROM `shops` WHERE status = ? LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sss", $status, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }else{
                $query = "SELECT * FROM `shops`";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);  
    
                // Output page
                $query = "SELECT * FROM `shops` LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ss", $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }

        } 
        
        if ($num_row > 0){
            $allShop = [];

            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $name = $row['name'];
                $country = $row['country'];
                $address = $row['address'];
                $city = $row['city'];
                $accept_order = ( $row['accept_order'] == 1) ? "accepting Orders" : "not accepting orders";
                $minCost = $row['min_cost'];
                $open_time = ($row['open_time']) ? date("h:iA", $row['open_time']) : ""; 
                $close_time = ($row['close_time']) ? date("h:iA", $row['close_time']) : "";
                $office_phone = $row['office_phone'];
                $office_whatapp = $row['office_whatapp'];
                $shop_email = $row['shop_email'];
                $image = $row['image'];
                $openstatus = ($row['openstatus'] == 1) ? "open" : "closed";
                $description= $row['description'];
                $balance= $row['bal'];
                $username = $row['username'];
                
                if ( $row['status'] == 0 ){
                    $shop_status = "Banned";
                }
                if ( $row['status'] == 1 ){
                    $shop_status = "Active";
                }
                if ( $row['status'] == 2 ){
                    $shop_status = "Suspended";
                }
                if ( $row['status'] == 3 ){
                    $shop_status = "Frozen";
                }

                array_push($allShop, array("id"=>$id, "name"=>$name, "country"=>$country, "address"=>$address, "city"=>$city, "accept_order"=>$accept_order, 
                "mincost"=>$minCost, "open_time"=>$open_time, "close_time"=>$close_time, "office_phone"=>$office_phone, 
                "office_whatapp"=>$office_whatapp , "shop_email"=>$shop_email , "openstatus"=>$openstatus, "image"=>$image, "description"=>$description, "balance"=>$balance, "status_code" => $row['status'] ,"status" => $shop_status ,"username" => $username));
            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'shop' => $allShop
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{

            $errordesc = "No shops Currently";
            $linktosolve = 'https://';
            $hint = "Ensure Shops table has been populated";
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


