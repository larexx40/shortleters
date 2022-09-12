<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    //include ("../apifunctions.php");
    //include "../connectdb.php";
    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']);


    if($method =='GET'){
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
        $userPubKey = $decodeToken->usertoken;
        //every user can get location
        //confirm if only admin or location id

        $user_id = getUserWithPubKey($connect, $userPubKey);
        $admin = checkIfIsAdmin($connect, $userPubKey);
        $logistic_id = checkIfLogistic($connect, $userPubKey);
        $shop_id = checkIfShopOwner($connect, $userPubKey);

        if (!$user_id && !$admin && !$logistic_id && !$shop_id){
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "user, admin, shop and logistics are only allowed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( isset($_GET['logistic_id']) ){
            $logistic_id = cleanme($_GET['logistic_id']);
        }else{
            $errordesc =  "logistic_id not passed";
            $linktosolve = 'https://';
            $hint = "pass locationid you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (isset($_GET['loc_id'])) {
            $loc_id = cleanme($_GET['loc_id']);
        } else {
            $errordesc =  "location id not passed";
            $linktosolve = 'https://';
            $hint = "pass locationid you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
    
        if (!isset ($_GET['weight']) ) {  
            $errordesc =  "product weight not passed";
            $linktosolve = 'https://';
            $hint = "pass weight you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        } else {  
            $weight = $_GET['weight'];  
        }

        $sqlQuery = "SELECT * FROM `logistics_prices` WHERE `logistic_id` = ? AND `location_id` = ?";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("ss", $logistic_id, $loc_id);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;   
        
        //check for database connection 
        if($stmt->error){
            //DB error || invalid input
            $errordesc= $stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text= $stmt->error;
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }
        //return fetched data as array
        if($numRow > 0){
            //`
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                if ($row['lbsweightmin'] > $weight){
                    $errordesc =  "Shipment weight not up to minimum for this location";
                    $linktosolve = 'https://';
                    $hint = "pass locationid you want to get";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }
                if ($weight > $row['lbsweightmax']){
                    $errordesc =  "Shipment weight more than maximum for this location";
                    $linktosolve = 'https://';
                    $hint = "pass locationid you want to get";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }

                $price = $weight * $row['price'];

                $data = array(
                    'price' => $price
                );
                $text= "Price Fetched";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }
            
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'locations'=> $allResponse
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
            //not found
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Record Not Found";
            $method = getenv('REQUEST_METHOD');
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }


    }else {
        // method not allowed
        $errordesc="Method not allowed";
        $linktosolve="htps://";
        $hint=["Ensure to use the method stated in the documentation."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Method used not allowed";
        $method=getenv('REQUEST_METHOD');
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondMethodNotAlowed($data);
    }
?>