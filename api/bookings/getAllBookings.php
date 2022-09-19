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
                $query = "SELECT bookings.* FROM `bookings` LEFT JOIN admin ON admin.id = bookings.booking_id LEFT JOIN apartments ON apartments.apartment_id = bookings.apartment_id WHERE paid = ? AND ( apartments.name LIKE ? OR admin.name LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR gender LIKE ? OR phone LIKE ? OR bookings.email LIKE ? OR identification_type LIKE ? )";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssssss", $status ,$searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching );
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssssssssss", $status,$searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows; 
            }else{
                // get the total number of pages
                $query = "SELECT bookings.* FROM `bookings` LEFT JOIN admin ON admin.id = bookings.booking_id LEFT JOIN apartments ON apartments.apartment_id = bookings.apartment_id WHERE apartments.name LIKE ? OR admin.name LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR gender LIKE ? OR phone LIKE ? OR bookings.email LIKE ? OR identification_type LIKE ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssssssss", $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching );
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssssssssss", $searching, $searching, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }            

        }else{

            if ($sort > 0){
                // Get total number of complains in the system
                $query = "SELECT * FROM `bookings` WHERE paid = ?";
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
                $query = "SELECT * FROM `bookings`";
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
            $allBookings = [];

            while($row = $result->fetch_assoc()){
                $paid_code = $row['paid'];
                $paid_status = ($row['paid'] == 1) ? "Paid" : "Not Paid";
                // $admin_id =  $row['admin_id'];
                // $admin_name =  ( $admin_id )? getNameFromField($connect, "admin ", "id", $admin_id) : null;
                $first_name =  $row['first_name'];
                $f_initials = ($first_name)? strtoupper(substr("$first_name",0,1)) : null;
                $last_name =  $row['last_name'];
                $l_initials = ($last_name)? strtoupper(substr("$last_name", 0, 1)): null;
                $initials = $f_initials.$l_initials;
                $gender = $row['gender'];
                $phone = $row['phone'];
                $email = $row["email"];
                $apartment_id = $row["apartment_id"];
                $apartment_price = $row["apartment_price"];
                $apartment_name = getNameFromField($connect, "apartments", "apartment_id", $apartment_id);
                $address = $row["address"];
                $occupation_or_workplace = $row["occupation_or_workplace"];
                $preferred_check_in = $row["preferred_check_in"];
                $prefferred_check_out = $row["prefferred_check_out"];
                $total_amount_paid = $row['total_amount_paid'];
                // $min_people = $row["min_people"];
                $no_of_people = $row["no_of_people"];
                // $max_people = $row["max_people"];
                $identification_type = $row["identification_type"];
                $identification_img = $row["identification_img"];
                $customer_note = $row["customer_note"];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($allBookings, array(
                    'id' => $row['booking_id'],
                    // 'admin_id' => $admin_id,
                    // 'admin_name' => ($admin_name) ? $admin_name : null,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'initials'=>$initials,
                    'gender' => $gender,
                    'phone' => $phone,
                    'email' => $email,
                    'apartment_id' => $apartment_id,
                    'apartment_price' => $apartment_price,
                    'apartment_name' => ($apartment_name) ? $apartment_name : null,
                    'address' => $address,
                    'occupation_or_workplace' => $occupation_or_workplace,
                    'preferred_check_in' => $preferred_check_in,
                    'prefferred_check_out' => $prefferred_check_out,
                    'total_amount_paid' => $total_amount_paid,
                    // 'min_people' => $min_people,
                    'no_of_people' => $no_of_people,
                    // 'max_people' => $max_people,
                    'identification_type' => $identification_type,
                    'identification_img' => $identification_img,
                    'customer_note' => $customer_note,
                    'paid_code' => $paid_code,
                    'paid_status' => $paid_status,
                    'created' => $created,
                    'updated' => $updated,
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'bookings' => $allBookings
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