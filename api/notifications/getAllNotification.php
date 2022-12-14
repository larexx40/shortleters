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
        if (!checkIfIsAdmin($connect, $user_pubkey) ){
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
        
        $no_per_page = 8;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            // get the total number of pages
            $query = "SELECT usernotification.id, usernotification.userid, usernotification.notificationtext, usernotification.notificationtype, usernotification.productid, usernotification.orderrefid, usernotification.notificationstatus FROM `usernotification` LEFT JOIN users ON usernotification.userid = users.id LEFT JOIN products ON usernotification.productid = products.id WHERE products.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("sss", $searching, $searching, $searching);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT usernotification.id, usernotification.userid, usernotification.notificationtext, usernotification.notificationtype, usernotification.productid, usernotification.orderrefid, usernotification.notificationstatus FROM `usernotification` LEFT JOIN users ON usernotification.userid = users.id LEFT JOIN products ON usernotification.productid = products.id WHERE products.name LIKE ? OR users.fname LIKE ? OR users.lname LIKE ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sssss", $searching, $searching, $searching, $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            
        }else{
            $query = "SELECT * FROM `usernotification`";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT * FROM `usernotification` LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("ss", $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

        }

        if ($num_row > 0){

            $allNotification = [];

            while($row = $result->fetch_assoc()){
                $status = ($row['notificationstatus'] == 1)? "completed" : "pending";
                if ($row['notificationtype'] == 1) {
                    $type = "normal";
                }
        
                if ($row['notificationtype'] == 2) {
                    $type = "product";
                }
        
                
                $id = $row['id'];
                $text = $row['notificationtext'];
                $code = $row['notificationcode'];
                $fullname = getUserFullname($connect, $row['userid']);
                $productname = ($row['productid'] !== "") ? getNameFromField($connect, "products" , "id" , $row['productid']) : "";
                $orderId = $row['orderrefid'];
                $read_status = ($row['read_status'] == 0 )? "unread" : "read"; 
                

                array_push($allNotification, array("id"=>$id, "status"=>$status, "type"=>$type, "text"=>$text, "productname"=>$productname, "name"=>$fullname, 
                "orderId"=>$orderId, 'read_status' => $read_status));
            }

            $data = array(
                'totalPage' => $totalPage,
                'notifications' => $allNotification
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


