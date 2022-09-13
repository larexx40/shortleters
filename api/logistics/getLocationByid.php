<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
    include "../connectdb.php";
    

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
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        } else {
            $locationid = cleanme($_GET['locationid']);
        }

        if (isset($_POST['sort'])) {
            $sort = cleanme($_POST['sort']); //sort result by status if > 0
        } else {
            $sort = "";
        }

        if (isset($_POST['sortstatus'])) {
            $status = cleanme($_POST['sortstatus']); //sort result by status if > 0
        } else {
            $status = "";
        }

        if (!is_numeric($locationid) ){
            // send response if the locationid passed isn't numeric
            $errordesc = "Invalid locationid passed";
            $linktosolve = 'https://';
            $hint = "locationid is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
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
            if ($sort > 0){
                // if($status == 1){
                    //get active location
                    $squlQuery = "SELECT * FROM `logistic_locations` WHERE `id`= ? AND status = ?";
                    $stmt = $connect->prepare($squlQuery);
                    $stmt->bind_param("ss",$locationid, $status);
                    $stmt->execute();  
                    $result = $stmt->get_result();
                // }
                // if($status == 0){
                //     //get inactive location
                //     $squlQuery = "SELECT * FROM `logistic_locations` WHERE `id`= ? AND status = ?";
                //     $stmt = $connect->prepare($squlQuery);
                //     $stmt->bind_param("ss",$locationid, $status);
                //     $stmt->execute();  
                //     $result = $stmt->get_result();
                // }
                
            }else{
                //no need to sort
                $squlQuery = "SELECT * FROM `logistic_locations` WHERE `id`= ?";
                $stmt = $connect->prepare($squlQuery);
                $stmt->bind_param("s",$locationid);
                $stmt->execute();  
                $result = $stmt->get_result();

            }
            //.......return get result...........
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
                $name = $row['name'];
                $logisticid = $row['logistic_id'];
                $longitude = $row['longitude'];
                $latitude = $row['latitude'];
                array_push($response, array("id"=>$id, "name"=>$name, "logisticid"=>$logisticid, "longitude"=>$longitude, "latitude"=>$latitude));

                $maindata['logistic_location']= $response;
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
                $text="logistic location with id not found";
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
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);

    }
?>