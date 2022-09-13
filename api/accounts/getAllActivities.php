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

        $admin = checkIfIsAdmin($connect, $user_pubkey);

        // check if user is admin
        if (!$admin ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
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

        if (!isset($_GET['per_page'])){
            $no_per_page = 8;
        }else{
            $no_per_page = cleanme($_GET['per_page']);
        }

        if (isset($_GET['sort'])){
            $status = cleanme($_GET['sort']);
        }else{
            $status = "";
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";

            if ( $status !== "" && $status !== " "){
                $query = "SELECT * FROM `usersessionlog` WHERE `user_type` = ? AND (`email` LIKE ? OR username LIKE ? OR ipaddress LIKE ? OR browser LIKE ? )";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sssss", $status, $searching, $searching, $searching, $searching);
                $getAll->execute();
                $result = $getAll->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ? ";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sssssss", $status, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }else{
                $query = "SELECT * FROM `usersessionlog` WHERE `email` LIKE ? OR username LIKE ? OR ipaddress LIKE ? OR browser LIKE ? ";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ssss", $searching, $searching, $searching, $searching);
                $getAll->execute();
                $result = $getAll->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ? ";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ssssss", $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;

            }
        
        }else{

            if ( $status !== "" && $status !== " "){
                // get user total balance
                $query = "SELECT * FROM `usersessionlog` WHERE user_type = ? ";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("s", $status);
                $getAll->execute();
                $result = $getAll->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $query = "$query LIMIT ?, ? ";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sss", $status, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;

            }else{
                // get user total balance
                $query = "SELECT * FROM `usersessionlog`";
                $getPages = $connect->prepare($query);
                $getPages->execute();
                $result = $getPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);

                $limit_query = "$query LIMIT ?, ? ";
                $getAll = $connect->prepare($limit_query);
                $getAll->bind_param("ss", $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;

            }
        }
        

        if ($num_row > 0){
            $totalSession = []; 

            while($row = $result->fetch_assoc()){
                
                $activity = ( $row['activity'] == 1 ) ? "Login" : "Register";
                $username = $row['username'];
                $ip_address = $row['ipaddress'];
                $browser = $row['browser'];
                $date = $row['date'];
                $location = $row['location'];

                array_push($totalSession, array(
                    'id' => $row['id'],
                    'activity' => $activity,
                    'username' => $username,
                    'ip' => $ip_address,
                    'browser' => $browser,
                    'date' => $date,
                    'location' => $location
                ));
                

            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $totalPage,
                'totalSession' => $totalSession
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }else{

            $errordesc = "No records";
            $linktosolve = 'https://';
            $hint = "Kindly make sure the table has been populated";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

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