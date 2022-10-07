<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    // check if the right request was sent
    if ($method == 'POST') {
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
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }

        $adminID = checkIfIsAdmin($connect, $user_pubkey);

        if ( !isset($_POST['termi_id']) ){
            $errordesc="id of row to update is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="id of row to update must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $termiID = cleanme($_POST['termi_id']);
        }

        if ( !is_numeric($termiID) ){
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Kindly pass a valid termi id";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        // Delete the data 
        $query = "DELETE FROM `termiapidetails` WHERE id = ?";
        $delete = $connect->prepare($query);
        $delete->bind_param("s", $termiID );
        

        if ( $delete->execute()){
            $data = [];
            $text= "Termi Api successfully Deleted";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, null, $data, $status);
            respondOK($successData);
        }

        if ( $delete->error ){
            $errordesc =  $delete->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondInternalError($data);
        }
        
    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);
    }

?>