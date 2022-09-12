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

        if (!checkIfIsAdmin($connect, $pubkey) ){
            // send a response that the user is neither a user or an admin
            $errordesc =  "User not Found or has been banned";
            $linktosolve = 'https://';
            $hint = "Only active users and admin can get complains";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !isset($_GET['id']) ){
            // send error if complaint field is not passed
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required complain id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $complain_id = cleanme($_GET['id']);
        }

        if (!is_numeric($complain_id)){
            $errordesc = "Inavlid id passed";
            $linktosolve = 'https://';
            $hint = "Kindly make sure a valid id is passed to the endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // get complain since all is good
        $query = "SELECT * FROM `usercomplains` WHERE `id` = ?";
        $getById = $connect->prepare($query);
        $getById->bind_param("s", $complain_id);
        $getById->execute();
        $result = $getById->get_result();
        $num_row = $result->num_rows;

        if ($getById->error){
            // send db error
            $errordesc =  $queryStmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }

        if ($num_row > 0){
            
            $row = $result->fetch_assoc();

            $fullname = getUserFullname($connect, $row['user_id']);
            $complain = $row['complain'];
            $status = ($row['adminseen'] == 0) ? "unread" : "read";

            $complain = array(
                'name' => $fullname,
                'complain' => $complain,
                'status' => $status
            );
            $data = $complain;
            $text= "Search completed";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc = "Complain not found";
            $linktosolve = 'https://';
            $hint = "Kindly make sure a valid id is passed to the endpoint";
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