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

        $logistics = getLogisticsWithPubKey($connect, $user_pubkey);
        $user = getUserWithPubKey($connect, $user_pubkey);
        $shop = getShopWithPubKey($connect, $user_pubkey);
        $admin = checkIfIsAdmin($connect, $user_pubkey);

        // check if user is admin
        if (!$admin && !$user && !$logistics && !$shop ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if (  $user  ){
            $email = getTableEmail($connect, "users" ,$user_pubkey);
            $user_type = 4;
        }

        if ( $shop ){
            $email = getTableEmail($connect, "shops", $user_pubkey);
            $user_type = 2;
        }

        if ( $logistics ){
            $email = getTableEmail($connect, "logistics", $user_pubkey);
            $user_type = 3;
        }
        if ( $admin ){
            if (!isset($_GET['user_type'])){
                $errordesc = "All fields must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required user type field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $user_type = cleanme($_GET['user_type']);

                if (!is_numeric($user_type)){
                    $errordesc = "Invaid User type Passed";
                    $linktosolve = 'https://';
                    $hint = "Kindly pass the required user type field in this endpoint";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }
            }
            if (!isset($_GET['email'])){
                $errordesc = "All fields must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required email field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $email = cleanme($_GET['email']);

                if (!validateEmail($email)){
                    $errordesc = "Invalid email passed";
                    $linktosolve = 'https://';
                    $hint = "Kindly pass a valid email field in this endpoint";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }
                
            }
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

        $offset = ($page_no - 1) * $no_per_page;
        

        // get user total balance
        $query = "SELECT * FROM `usersessionlog` WHERE `email` = ? AND user_type = ? ";
        $getAll = $connect->prepare($query);
        $getAll->bind_param("ss", $email, $user_type);
        $getAll->execute();
        $result = $getAll->get_result();
        $total_num_row = $result->num_rows;
        $totalPage = ceil($total_num_row / $no_per_page);

        $query = "SELECT * FROM `usersessionlog` WHERE `email` = ? AND user_type = ? LIMIT ?, ? ";
        $getAll = $connect->prepare($query);
        $getAll->bind_param("ssss", $email, $user_type, $offset, $no_per_page);
        $getAll->execute();
        $result = $getAll->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $totalSession = []; 

            while($row = $result->fetch_assoc()){
                
                $activity = ( $row['activity'] == 1 ) ? "Login" : "Register";
                $email = $row['email'];
                $ip_address = $row['ipaddress'];
                $browser = $row['browser'];
                $date = $row['date'];
                $location = $row['location'];

                array_push($totalSession, array(
                    'id' => $row['id'],
                    'activity' => $activity,
                    'email' => $email,
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