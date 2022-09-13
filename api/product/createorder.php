<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    //include ("../apifunctions.php");
    //include "../connectdb.php";
    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);


    if ($method == 'POST') {
        //....Collect userpubkey from header.....
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

        

        //collect input and check if its empty
        if( !isset( $_POST['logisticid'] ) ){
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

        if(!isset($_POST['deliveryAddressid'] )){
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

        if(!isset( $_POST['deliveryCharge'])){
            $errordesc="Delivery charge required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in the delivery charge";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $deliveryCharge = cleanme( $_POST['deliveryCharge']);    
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

        if(empty($userpubkey)||empty($logisticid)||empty($deliveryAddressid)||empty($shipType)||empty($totalWeight)||empty($deliveryCharge)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require data input";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            //generate cart 
            $orderRefno = generateCart($connect,$userpubkey,$logisticid,$deliveryAddressid,$deliveryCharge,$shipType,$totalWeight);
            $items= $order->items;
            //echo json_encode($items);

            //create order for each item
            $sqlQuery = "INSERT INTO productorders(user_id,order_refno,product_id,quantity,price) VALUES (?,?,?,?,?)";
            $stmt=$connect->prepare($sqlQuery);
            for($i = 0; $i < count($items); $i ++){
                $stmt->bind_param("sssss",$userpubkey,$orderRefno,$items[$i]->productid,$items[$i]->quantity,$items[$i]->price);
                $createOrder =$stmt->execute();
                if(!$createOrder){
                    //DB error ? invalid input
                    $errordesc="Bad request";
                    $linktosolve="htps://";
                    $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="Failled to create order(s), fill all require data input";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondInternalError($data);
                }
            }
            $maindata=[];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Order created";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
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

    //echo json_encode($order->items[0])."\n";
    //echo $order->logisticid;
    

?>