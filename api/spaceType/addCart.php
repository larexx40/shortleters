<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']);

    if ($method == 'POST') {
        //Collect userpubkey from header
        //use pubkey to fetch details
        //send details as response to be passed to updateprofile text field

        //get companydetalis and servername for auth token
        $detailsID =1;
        $JWTParams = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $JWTParams->bind_param('i', $detailsID);
        $JWTParams->execute();
        $result = $JWTParams->get_result();
        $row = $result->fetch_assoc();
        $companyprivateKey = $row['privatekey'];
        $minutetoend = $row['tokenexpiremin'];
        $serverName = $row['servername'];

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        if(!checkIfUser($connect, $userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not registered";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $userid = checkIfUser($connect, $userpubkey);

        //.....generate cart details for items in local storage cart.......
        //collect and validate inputs
        if(!isset($_POST['logisticid'])){
            $errordesc="logisticid required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your logisticid";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $logisticid = cleanme($_POST['logisticid']);   
        }

        if(!isset($_POST['deliveryAddressid'])){
            $errordesc="Delivery Address id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in the user's defsult address";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $deliveryAddressid = cleanme($_POST['deliveryAddressid']);  
        }

        if(!isset($_POST['shipType'])){
            $errordesc="shiptype required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your shiptype";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $shipType = cleanme($_POST['shipType']);    
        }

        if(!isset($_POST['deliveryCharge'])){
            $errordesc="Delivery charge required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in the delivery charge";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $deliveryCharge = cleanme($_POST['deliveryCharge']);    
        }

        if(!isset($_POST['totalWeight'])){
            $errordesc="totalweight required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your totalweight";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {
            $totalWeight = cleanme($_POST['totalWeight']); 
        }

        if(!isset($_POST['noOfItem'])){
            $errordesc="Number of Item required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your Number of Item";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {
            $noOfItem = cleanme($_POST['noOfItem']); 
        }

        //...........auto generate unique inputs.........
        //orderstatusid 0=packing 1=delivered 2=processed 3=shiped 4=dispatched 5=arrived 6=pending
        $orderStatusid = 6; //=pending by default
        $paid = 0;// default
        $totalPaid = 0;//default
        //generate trackid
        $trackid = generateUniqueShortKey($connect,'productcart', 'track_id');
        //order_ref_no
        $orderRefno = generateOrderrefno($connect);

        if(empty($userid)||empty($logisticid)||empty($deliveryAddressid)||empty($shipType)||empty($totalWeight)||empty($deliveryCharge)|| empty($noOfItem)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require data input";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        //insert into productcart db
        //update later(totalpaid,assigntodeliveryman,deliveredtime,seenbyseller,seenbylogistic,ordertime)
        $sqlQuery = "INSERT INTO productcart(user_id, orderstatus_id, orderref_number, logisticid, deliveryaddress_id, delivery_charge, ship_type, paid, totalweightlbs,track_id, noofprod_ordered) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("sssssssssss", $userid,$orderStatusid,$orderRefno,$logisticid,$deliveryAddressid,$deliveryCharge, $shipType, $paid, $totalWeight, $trackid, $noOfItem );
        $insertCart = $stmt->execute();
        if ($insertCart) {
            $maindata=[
                "orderRefno"=>$orderRefno,
                "orderStatuid"=>$orderStatusid,
                "totalAmount"=>$totalPaid,
                "totalWeight"=>$totalWeight,
                "shippingFee"=>$deliveryCharge,
                "shipType"=>$shipType,
                "deliveryAddressid"=>$deliveryAddressid,
                "noOfItemn"=>$noOfItem
            ];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Product Cart generated Successfully.";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondInternalError($data);
        }else{
            //DB error invalid input
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Failled to insert user records, fill all require data input";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
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