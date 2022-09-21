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

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }

        //sort with status
        if (isset($_GET['sortStatus']) && is_numeric($_GET['sortStatus'])) {
            $availability = cleanme($_GET['sortStatus']); //status =0-6
        } else {
            $availability = "";
        }

        //sort with status
        if (isset($_GET['status']) && is_numeric($_GET['status'])) {
            $feature = cleanme($_GET['status']); //status =0-6
        } else {
            $feature = 1;
        }

        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            if($sort > 0){  
                // Get total number of complains in the system
                $query = "SELECT apartments.id, apartments.name, apartments.title, apartments.price,  apartments.building_type_id, building_types.name AS building_name, apartments.availability, apartments.feature, apartments.apartment_id, apartments.agent_id, users.fname, users.lname, apartments.apartment_status FROM `apartments` 
                        LEFT JOIN building_types ON building_types.build_id = apartments.building_type_id LEFT JOIN users ON users.id = apartments.agent_id
                        WHERE (apartments.name like ? OR apartments.title LIKE ? OR building_types.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ? ) AND `feature` = ? AND availability = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("sssssss",$searching, $searching, $searching, $searching, $searching, $feature, $availability);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sssssssss",$searching, $searching, $searching, $searching, $searching, $feature, $availability, $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;

            }else{ 
                // Get total number of complains in the system
                $query = "SELECT apartments.id, apartments.name, apartments.title, apartments.price,  apartments.building_type_id, building_types.name AS building_name, apartments.availability, apartments.feature, apartments.apartment_id, apartments.agent_id, users.fname, users.lname, apartments.apartment_status FROM `apartments` 
                        LEFT JOIN building_types ON building_types.build_id = apartments.building_type_id LEFT JOIN users ON users.id = apartments.agent_id  WHERE `feature` = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $feature);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sss", $feature, $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            } 

        }else{//no seearch
            if($sort > 0){  
                // Get total number of complains in the system
                $query = "SELECT apartments.id, apartments.name, apartments.title, apartments.price,  apartments.building_type_id, building_types.name AS building_name, apartments.availability, apartments.feature, apartments.apartment_id, apartments.agent_id, users.fname, users.lname, apartments.apartment_status FROM `apartments` 
                        LEFT JOIN building_types ON building_types.build_id = apartments.building_type_id LEFT JOIN users ON users.id = apartments.agent_id  WHERE `feature` = ? AND availability = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("ss", $feature, $availability);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("ssss", $feature, $availability, $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;

            }else{ 
                // Get total number of complains in the system
                $query = "SELECT apartments.id, apartments.name, apartments.title, apartments.price,  apartments.status, apartments.building_type_id, building_types.name AS building_name, apartments.availability, apartments.feature, apartments.apartment_id, apartments.agent_id, users.fname, users.lname, apartments.apartment_status FROM `apartments` 
                        LEFT JOIN building_types ON building_types.build_id = apartments.building_type_id LEFT JOIN users ON users.id = apartments.agent_id  WHERE `feature` = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $feature);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sss", $feature, $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            } 

        }

        if ($num_row > 0){
            $allResponse =[];
            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $title = $row['title'];
                $price = $row["price"];
                $availabilityCode = $row['availability'];
                $availability = ($row["availability"] > 0)? "Booked" : "Available";
                $building_type_id = $row["building_type_id"];
                $building_type_name = $row['building_name'];
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
                $agentName =  $row['fname']. $row['lname'] ;
                // $agentName = ($agentName) ? $agentName : null;
     
                array_push($allResponse, array(
                    'id' => $row['apartment_id'],
                    'name' => $name,
                    'status_code' => $status_code,
                    'status' => $status,
                    'title' => $title,
                    'price' => $price,
                    'availabilityCode'=>$availabilityCode,
                    'availability' => $availability,
                    'building_type_name' => $building_type_name,
                    'apartment_status_code' => $apartment_status_code,
                    'apartment_status' => $apartment_status,
                    'agentName'=>$agentName,
                    
                ));
            }
            $data =[
                'features' => $allResponse,
            ];
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