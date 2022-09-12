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
        //get company details to decode usertoken
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
        //every user can access here

        if (!isset($_GET['locationid'])) {
            $errordesc =  "locationid not passed";
            $linktosolve = 'https://';
            $hint = "pass locationid you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        } else {
            $locationid = cleanme($_GET['locationid']);
        }

        if (!is_numeric($locationid) ){
            // send response if the locationid passed isn't numeric
            $errordesc = "Invalid locationid passed";
            $linktosolve = 'https://';
            $hint = "locationid is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
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
        }else{
            //
            //get logistic_location where id = locationid
            $sqlQuery = "SELECT logistic_locations.id,logistic_locations.name AS location_name, logistic_locations.logistic_id, 
                        logistics.name AS logistic_name, logistic_locations.longitude,logistic_locations.latitude, logistic_locations.status
                        FROM logistic_locations LEFT JOIN logistics ON logistic_locations.logistic_id = logistics.id
                        WHERE logistic_locations.id = ?";
            $stmt = $connect->prepare($sqlQuery);
            $stmt->bind_param("s",$locationid);
            $stmt->execute();  
            $result = $stmt->get_result();

            //check for db error || connection lost
            if(!$stmt->execute()){
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
            if($result->num_rows > 0){
                //pass fetched data as array maindata[]
                $response = [];
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $locationName = $row['location_name'];
                $logisticid = $row['logistic_id'];
                $logisticName =$row['logistic_name'];
                //get the initials of location name
                $names = explode(" ", $locationName);
                $initials = '';
                foreach($names as $name){
                    $initials.=strtoupper(substr($name,0,1));
                }
                $longitude = $row['longitude'];
                $latitude = $row['latitude'];
                $status = $row['status'];
                if($status == 1){
                    $status = 'Active';
                }else{
                    $status = 'Inactive';
                }

                $maindata=[
                    "id"=>$id,
                    "locationName"=>$locationName, 
                    "logisticid"=>$logisticid,
                    "logisticName"=>$logisticName, 
                    "initials"=>$initials,
                    "longitude"=>$longitude, 
                    "latitude"=>$latitude,
                    "status"=>$status
                ];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "Data found";
                $method = getenv('REQUEST_METHOD');
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);

            }else{
                // incorrect locationid
                $errordesc="Record not found";
                $linktosolve="htps://";
                $hint=["pass in valid location id"];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="location with id not found";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
        }
        
    }else{
        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);

    }
?>