<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../../cartsfunction.php";    
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    if ($method == 'GET') {
        //Get company private key for jwtauth
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

        //check if user is a registered logistics
        if(!checkIfLogistic($connect, $userpubkey)){
            //respond not registered logistics
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        $logisticid = checkIfLogistic($connect, $userpubkey);

        if ( !isset($_GET['id']) ){
            // send error if status is not passed
            $errordesc = "id must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }else{
            $locationid = cleanme($_GET['id']);
        }

        if(empty($locationid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require address information";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {

            // check if the location is in the database
            $query = 'SELECT status FROM logistic_locations WHERE id = ? AND logistic_id = ?';
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ss", $locationid, $logisticid);
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
                $notActive = 0;

                $active = 1;
                //confirm the status of the logistic location
                $row = $result->fetch_assoc();
                $status = $row['status'];
    
                if($status == 1){
                    $message = "deactivate";
                    //location is active
                    //.....change status to ban
                    // Set the current status to 0
                    $sqlQuery = "UPDATE logistic_locations SET status = ? WHERE id = ? AND logistic_id = ?";
                    $stmt = $connect->prepare($sqlQuery);
                    $stmt->bind_param("sss", $notActive, $locationid, $logisticid);
                    $stmt->execute();
                }else{
                    $message = "activated";
                    //....change status to active
                    $sqlQuery = "UPDATE logistic_locations SET status = ? WHERE id = ? AND logistic_id = ?";
                    $stmt = $connect->prepare($sqlQuery);
                    $stmt->bind_param("sss", $active, $locationid, $logisticid);
                    $stmt->execute();
                }
                if ( $stmt->affected_rows > 0 ){
                    $maindata=[];
                    $errordesc = " ";
                    $linktosolve = "htps://";
                    $hint = "location status changed";
                    $errordata = [];
                    $text = "location successfully $message";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondOK($data);
                
                }else{
                    //invalid input || server error
                    $errordesc=$stmt->error;
                    $linktosolve="htps://";
                    $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="invalid location id or Check DB connection";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondInternalError($data);
                }
            }else{
                // return response (location not found in the DB)
                $errordesc = "Location not found";
                $linktosolve = 'https://';
                $hint = "Kindly pass the valid Location id";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                respondBadRequest($data);   
            }
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