<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";
    //include "../connectdb.php";
    
    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']); 
    $maindata = []; 

    if (getenv('REQUEST_METHOD')== 'GET') {
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

        if(!checkIfLogistic($connect, $userpubkey)){
            // send Logistic not found response
            $errordesc =  "Logistic  not found";
            $linktosolve = 'https://';
            $hint = "Only Logistic can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $logisticid = checkIfLogistic($connect, $userpubkey);
        //get Logistic details
        $getLogistic = $connect->prepare("SELECT * FROM logistics WHERE id = ?");
        $getLogistic->bind_param("s",$logisticid);
        $getLogistic->execute();
        $result = $getLogistic->get_result();

        if($result->num_rows > 0){
            //user exist
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
            $userPubKey = $row['userpubkey'];
            $status = $row['status'];
            $country = $row['country'];
            $address = $row['address'];
            $city = $row['city'];
            $acceptOrder = $row['accept_order'];
            
            $ratePerDistance = $row['rateperdistance'];
            $openTime = $row['open_time'];
            $closeTime = $row['close_time'];
            $Phone = $row['office_phone'];
            $officeWhatsapp = $row['office_whatapp'];
            $shopEmail = $row['shop_email'];
            $description = $row['description'];
            $closeTime = $row['close_time'];
            $image = $row['image'];
            $currency = $row['currency'];
            $openstatus = $row['openstatus'];
            $bal = $row['bal'];                
            $dateloggedin = time();
            $browser= $_SERVER['HTTP_USER_AGENT'];
            $userIp = getIPAddress();
            $location = "naija";
            $userType = "Logistics";
            if($acceptOrder == 1){
                $acceptOrder = "Accepting order";
            }else{
                $acceptOrder = "Not accepting order";
            }
            if($openstatus == 1){
                $openstatus = 'Closed';
            }else{
                $openstatus = 'Open';
            }
            $maindata = [
                "id"=>$id,
                "email"=>$shopEmail,
                "name"=>$name,
                "status"=>$status,
                "username"=>$username,                
                "country"=>$country,
                "address"=>$address,
                "city"=>$city,
                "openTime"=>$openTime,
                "closeTime"=>$closeTime,
                "phone"=>$Phone,
                "officeWhatsapp"=>$officeWhatsapp,
                "description"=>$description, 
                "closeTime"=>$closeTime,
                "image"=>$image,
                "currency"=>$currency,
                "openstatus"=>$openstatus,
                "acceptOrder"=>$acceptOrder,
                "bal"=>$bal,
            ];
            $errordesc = "";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Logistic Details Fetched";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else {
            //pubkey does not exist
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid logistic id", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Logistic does not exist";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }           

        
    }else{
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