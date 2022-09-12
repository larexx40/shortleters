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

    if ($method == 'POST') {
        //Get company private key
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        // cheeck if it thesuper admin
        if(!checkIfIsSuperAdmin($connect, $userpubkey)){
            //respond not admin
            $errordesc =  "User not a Super admin";
            $linktosolve = 'https://';
            $hint = "Only Super admin has the ability to access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }        
        
        //check and validate input
        if ( !isset($_POST['id']) ){
            // send error if status is not passed
            $errordesc = "id must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $id = cleanme($_POST['id']);
        }

        if(!is_numeric($id)){
            // send response if the id passed isn't numeric
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if admin exist
        $query = 'SELECT * FROM admin WHERE id = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;
 
        if($stmt->error){
            //DB error || invalid input
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Database comection error";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }
        if ($num_row > 0){
            $ban = 0;
            $active = 1;
            //check the status
            $row = $result->fetch_assoc();
            $status = $row['status'];

            if($status == 1){
                //admin is active
                //.....change status to ban
                // Set the current status to 0
                $sqlQuery = "UPDATE admin SET status = ? WHERE id = ? ";
                $stmt = $connect->prepare($sqlQuery);
                $stmt->bind_param("ss", $ban, $id);
                $stmt->execute();

                if ( $stmt->affected_rows > 0 ){
                    $maindata=[];
                    $errordesc = " ";
                    $linktosolve = "htps://";
                    $hint = "Admin status set to ban";
                    $errordata = [];
                    $text = "Admin successfully banned";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondOK($data);
                
                }

            }else {
                //admin ban
                //....change status to active
                $sqlQuery = "UPDATE admin SET status = ? WHERE id = ? ";
                $stmt = $connect->prepare($sqlQuery);
                $stmt->bind_param("ss", $active, $id);
                $stmt->execute();

                if ( $stmt->affected_rows > 0 ){
                    $maindata=[];
                    $errordesc = " ";
                    $linktosolve = "htps://";
                    $hint = "Admin status set to active";
                    $errordata = [];
                    $text = "Admin successfully activated";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondOK($data);
                }

            }

            if($stmt->error){
                //invalid input || server error
                $errordesc=$stmt->error;
                $linktosolve="htps://";
                $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="invalid api id or Check DB connection";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondInternalError($data);
            }
        }else{
            // return response (Admin not found in the DB)
            $errordesc = "Admin not found";
            $linktosolve = 'https://';
            $hint = "Kindly pass the valid adminkey";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);   
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