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

        // pass the sorting parameter
        if (isset($_GET['sort'])){
            $status = cleanme($_GET['sort']);
        }else{
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

        if (!isset($_GET['per_page'])){
            $no_per_page = 5;
        }else{
            $no_per_page = cleanme($_GET['per_page']);
        }
        
        
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";

            if ( $status !== "" && $status !== " "){
                $query = "SELECT * FROM `smartsolutionapidetails` WHERE status = ? AND ( `name` LIKE ? OR `sendfrom` LIKE ? ) ";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("sss", $status, $searching, $searching);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);  

                // Output page
                $query = "SELECT * FROM `smartsolutionapidetails` WHERE status = ? AND ( `name` LIKE ? OR `sendfrom` LIKE ? ) LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sssss", $status ,$searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }else{
                // get the total number of pages
                $query = "SELECT * FROM `smartsolutionapidetails` WHERE `name` LIKE ? OR `sendfrom` LIKE ? ";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("ss", $searching, $searching);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);  

                // Output page
                $query = "SELECT * FROM `smartsolutionapidetails` WHERE `name` LIKE ? OR `sendfrom` LIKE ? LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ssss", $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }
            

        }else{

            if ( $status !== "" && $status !== " "){
                $query = "SELECT * FROM `smartsolutionapidetails` WHERE status = ?";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("s", $status);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);  

                // Output page
                $query = "SELECT * FROM `smartsolutionapidetails` WHERE status = ? LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sss", $status, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }else{
                $query = "SELECT * FROM `smartsolutionapidetails`";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);  
    
                // Output page
                $query = "SELECT * FROM `smartsolutionapidetails` LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ss", $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows; 
            }
            
        }

        if ($num_row > 0){
            $allApi = [];

            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $send_from = $row['sendfrom'];
                $key = $row['apitoken'];
                $name = $row['name'];
                $send_type = $row['sendtype'];
                $routing = $row['routing'];
                $status = ($row['status'] == 0) ? "inactive" : "active";
                
                array_push($allApi, array(
                    'id' => $id,
                    'sendFrom' => $send_from,
                    'apiToken' => $key,
                    'name' => $name,
                    'sendtype' => $send_type,
                    'routing' => $routing,
                    'status_code' => $row['status'],
                    'status' => $status
                ));
            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $totalPage,
                'smart' => $allApi
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
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
    }

?>