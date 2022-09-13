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

        if (!isset($_GET['id'])) {
            $errordesc =  "Api id not passed";
            $linktosolve = 'https://';
            $hint = "pass id of api you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        } else {
            $api_id = cleanme($_GET['id']);
        }

        if (!is_numeric($api_id) ){
            // send response if the id passed isn't numeric
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $query = "SELECT * FROM sendgridapidetails WHERE id = ?";
        $queryStmt = $connect->prepare($query);
        $queryStmt->bind_param("i", $api_id);
        $queryStmt->execute();
        $resut = $queryStmt->get_result();
        $num_row = $resut->num_rows;

        if ($queryStmt->error){
            // send db error
            $errordesc =  $queryStmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }

        if ($num_row > 0){
            $api = $resut->fetch_assoc();
            $secretid = $api['secreteid'];
            $api_key = $api['apikey'];
            if ($api['status'] == 0){
                $status = "inactive";
            }else{
                $status = "active";
            }
            $name = $api['name'];
            $email = $api['emailfrom'];

            $maindata=[
                'id' => $api['id'],
                'secret_id' => $secretid,
                'api_key' => $api_key,
                'status_code' => $api['status'],
                'status' => $status,
                'name' => $name,
                'email_from' => $email
            ];
            $text= "Search completed";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $maindata, $status);
            respondOK($successData);
            

        }else{
            $text= "Sendgrid Api not found";
            $data = [];
            $status = true;
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