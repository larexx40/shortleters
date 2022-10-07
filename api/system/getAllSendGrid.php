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

        if  (!checkIfIsAdmin($connect, $pubkey) ){

            // send user not found response to the user
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (isset($_GET['sort'])){
            $status = cleanme($_GET['sort']);
        }else{
            $status = "";
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
        if (!isset($_GET['per_page'])){
            $no_per_page = 5;
        }else{
            $no_per_page = cleanme($_GET['per_page']);
        }
        
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";

            if ( $status !== "" && $status !== " "){
                
                // get Total number of page 
                $query = "SELECT * FROM sendgridapidetails WHERE status = ? AND ( name Like ? OR emailfrom Like ?)";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $status ,$searching, $searching);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $total_num_row = $resut->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM sendgridapidetails WHERE status = ? AND( name Like ? OR emailfrom Like ?) LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssss", $status , $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $num_row = $resut->num_rows;
            }else{
                // get Total number of page 
                $query = "SELECT * FROM sendgridapidetails WHERE name Like ? OR emailfrom Like ? ";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ss", $searching, $searching);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $total_num_row = $resut->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM sendgridapidetails WHERE name Like ? OR emailfrom Like ? LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssss", $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $num_row = $resut->num_rows;

            }
            
            
            
        }else{

            if ($status !== "" && $status !== " "){
                
                // Get total number Pages in the database
                $query = "SELECT * FROM sendgridapidetails WHERE status = ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("s", $status);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $total_num_row = $resut->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM sendgridapidetails WHERE status = ? LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $status ,$offset, $no_per_page);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $num_row = $resut->num_rows;
            }else{
                // Get total number Pages in the database
                $query = "SELECT * FROM sendgridapidetails";
                $queryStmt = $connect->prepare($query);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $total_num_row = $resut->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page);

                $query = "SELECT * FROM sendgridapidetails LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ss", $offset, $no_per_page);
                $queryStmt->execute();
                $resut = $queryStmt->get_result();
                $num_row = $resut->num_rows;
            }
            

        }

        if ($num_row > 0){
            $allApi = [];
            
            while($api = $resut->fetch_assoc()){
                $secretid = $api['secreteid'];
                $api_key = $api['apikey'];
                if ($api['status'] == 0){
                    $status = "inactive";
                }else{
                    $status = "active";
                }
                $name = $api['name'];
                $email = $api['emailfrom'];

                array_push($allApi, array(
                    'id' => $api['id'],
                    'secret_id' => $secretid,
                    'api_key' => $api_key,
                    'status_code' => $api['status'],
                    'status' => $status,
                    'name' => $name,
                    'email_from' => $email
                ));
            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'details' => $allApi
            );
            $text= "Search completed";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }

        $text= "Address not Found";
        $data = [];
        $status = true;
        $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
        respondOK($successData);
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