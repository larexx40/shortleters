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

        $user = getUserWithPubKey($connect, $user_pubkey);
        $admin_id = checkIfIsAdmin($connect, $user_pubkey);
        // send error if ur is not in the database
        
        if (!$user && !$admin_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $admin_id ){
            if ( !isset($_GET['user_id']) ){
                $errordesc = "All fields must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required user id field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $user_id = cleanme($_GET['user_id']);
            }
        }else{
            $user_id = $user;
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

        $no_per_page = 8;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            if ($sort > 0){
                $query = "SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE `userid` = ? AND defultaddress = ? AND (users.fname LIKE ? OR users.lname LIKE ? OR users.email LIKE ? OR deliveryaddress.address LIKE ? OR deliveryaddress.state LIKE ? OR deliveryaddress.country LIKE ?)";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("ssssssss", $user_id, $status, $searching, $searching, $searching, $searching, $searching, $searching);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                
                $query = 'SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE `userid` = ? AND defultaddress = ? AND (users.fname LIKE ? OR users.lname LIKE ? OR users.email LIKE ? OR deliveryaddress.address LIKE ? OR deliveryaddress.state LIKE ? OR deliveryaddress.country LIKE ? ) LIMIT ?, ?';
                $stmt = $connect->prepare($query);
                $stmt->bind_param("ssssssssss", $user_id, $status, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $num_row = $result->num_rows;

            }else{
                $query = "SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE `userid` = ? AND (users.fname LIKE ? OR users.lname LIKE ? OR users.email LIKE ? OR deliveryaddress.address LIKE ? OR deliveryaddress.state LIKE ? OR deliveryaddress.country LIKE ? )";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("sssssss", $user_id, $searching, $searching, $searching, $searching, $searching, $searching);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                
                $query = 'SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE `userid` = ? AND (users.fname LIKE ? OR users.lname LIKE ? OR users.email LIKE ? OR deliveryaddress.address LIKE ? OR deliveryaddress.state LIKE ? OR deliveryaddress.country LIKE ? ) LIMIT ?, ?';
                $stmt = $connect->prepare($query);
                $stmt->bind_param("sssssssss", $user_id, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $num_row = $result->num_rows;
            }
        }else{
            if ($sort > 0){
                $query = "SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE userid = ? AND defultaddress = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("ss", $user_id, $status);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                
                $query = 'SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE userid = ? AND defultaddress = ? LIMIT ?, ?';
                $stmt = $connect->prepare($query);
                $stmt->bind_param("ssss", $user_id, $status ,$offset, $no_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $num_row = $result->num_rows;

            }else{
                $query = "SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE userid = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $user_id);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                
                $query = 'SELECT deliveryaddress.*, users.email AS user_email FROM `deliveryaddress` LEFT JOIN users ON deliveryaddress.userid = users.id WHERE userid = ? LIMIT ?, ?';
                $stmt = $connect->prepare($query);
                $stmt->bind_param("sss", $user_id, $offset, $no_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $num_row = $result->num_rows;
            }
        }


        if ($num_row > 0){
            // $row = mysqli_fetch_assoc($result);

            $allAddress = []; 

            while ( $row = mysqli_fetch_assoc($result) ) {
                $id = ( $row ) ? $row['id'] : "";
                $user_id = ( $row ) ? $row['userid'] : "";
                $user_fullname = (!empty($user_id) ) ? getUserFullname($connect, $user_id) : ""; 
                $user_email = ( $row ) ? $row['user_email'] : "";
                $phone = ( $row ) ? $row['phoneno'] : "";
                $longtitude = ( $row ) ? $row['longitude'] : "";
                $latitude = ( $row ) ? $row['latitude'] : "";
                $default = ( $row ) ? $row['defultaddress'] : "";
                $addressno = ( $row ) ? $row['address_no'] : "";
                $address = ( $row ) ? $row['address'] : "";
                $lga = ( $row ) ? $row['lga'] : "";
                $address_state = ( $row ) ? $row['state'] : "";
                $address_country = ( $row ) ? $row['country'] : "" ;
                $zipCode = ( $row ) ? $row['zipcode'] : "";

                $maindata = [
                    "id"=>$id,
                    "user_id"=>$user_id,
                    'user_fullname' => $user_fullname,
                    'user_email' => $user_email,
                    "phone_no"=>$phone,
                    "longtitude"=>$longtitude,
                    "latitude"=>$latitude,
                    "default_status"=>$default,
                    "addressno"=> $addressno,
                    "address"=> $address,
                    "address_state" => $address_state,
                    "address_country" => $address_country,
                    "Local government"=> $lga ,
                    "Zipcode"=>$zipCode
                ];

                array_push($allAddress, $maindata);
            }

            

            
            $errordesc = "";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "User Details Fetched";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $allAddress, $status);
            respondOK($data);

        }else{
            $text= "No address found";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
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