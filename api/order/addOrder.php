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
    //include "../connectdb.php";
    //include ("../apifunctions.php");

    $method = getenv('REQUEST_METHOD');
    $endpoint =  'api/product/'.basename($_SERVER['PHP_SELF']);
    $order = json_decode(file_get_contents("php://input"));

    if ($method == 'POST') {
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
        if(isset($order->customerPref)){
            $customerPref = cleanme($order->customerPref); 
        }else {
            $customerPref = ""; 
        }
        if(!isset($order->orderRefno)){
            $errordesc="orderRefno required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your orderRefno";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $orderRefno = cleanme($order->orderRefno);   
        }


        //array of items in cart
        $items= $order->items;

        //confirm how orderref will be passed
        
        if(empty($items)){
            //all input required / bad request
            $errordesc="Items cannot be empty";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please pass in item(s) details";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $sqlQuery = "INSERT INTO productorders(`user_id`, `order_refno`, `product_id`, `quantity`, `price`, `customerpref`) VALUES (?,?,?,?,?,?)";
            $stmt=$connect->prepare($sqlQuery);
            for($i = 0; $i < count($items); $i ++){
                $stmt->bind_param("ssssss",$userid,$order->orderRefno,$items[$i]->productid,$items[$i]->quantity,$items[$i]->price, $customerPref);
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
                //(`id`, `user_id`, `order_refno`, `product_id`, `quantity`, `price`, `customerpref`)
                if($createOrder){
                    $maindata=[
                        "id"=>$id,
                        "userid"=>$userid,
                        "orderRefno"=>$orderRefno,
                        "items"=>$items,
                    ];
                    $errordesc = " ";
                    $linktosolve = "htps://";
                    $hint = [];
                    $errordata = [];
                    $text = "Order Placed.";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondInternalError($data);
                }
            }
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