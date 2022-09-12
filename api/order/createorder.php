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
    $endpoint =  basename($_SERVER['PHP_SELF']);

    $order = json_decode(file_get_contents("php://input"));

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

        //collect input and check if its empty
        if(!isset($order->logisticid)){
            $errordesc="logisticid required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your logisticid";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $logisticid = cleanme($order->logisticid);   
        }

        if(!isset($order->deliveryAddressid)){
            $errordesc="Delivery Address id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in the user's defsult address";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $deliveryAddressid = cleanme($order->deliveryAddressid);  
        }

        if(!isset($order->shipType)){
            $errordesc="shiptype required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your shiptype";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $shipType = cleanme($order->shipType);    
        }

        if(!isset($order->items)){
            $errordesc="items required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in your totalweight";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {
            $items= $order->items;
        }
        //research on how to check if there is productid and quantity in items=>[{productid,quantity}]

        $noOfItem = count($items);
        if(empty($userid)||empty($logisticid)||empty($deliveryAddressid)||empty($shipType)|| empty($items)){
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

            //loop through items, check if the order can proceed(check item id, availableQuantity, Userbalance and logistic weight and price) 
            $totalItem = 0;
            $totalOrderAmount = 0;
            $totalWeight = 0;
            $itemPrices = [];
            $remainingQuantitys = [];

            //check if items are valid and quantity is available
            for($i = 0; $i < count($items); $i ++){
                $item = getActiveProduct($connect, $items[$i]->productid);
                if(!$item){
                    //return response item not found
                    $errordesc="item not found";
                    $linktosolve="htps://";
                    $hint=['Ensure to pass in valid itemid',"Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="item not found";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }
                $productid= $item['productid'];
                $productWeight =$item['weight'];
                $sellingPrice =$item['sellingprice'];
                $availableQuantity =$item['quantityavailable'];

                //check if valid item quantity passed
                if(!is_numeric($items[$i]->quantity)){
                    $errordesc="Invalid quantity passed";
                    $linktosolve="htps://";
                    $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="Pass in valid item quantity";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }

                //validate if quantity is in stock
                if($items[$i]->quantity > $availableQuantity){
                    //out of stock
                    $errordesc="out of stock, only $availableQuantity available";
                    $linktosolve="htps://";
                    $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="out of stock";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }
                //get total weight, quantity and price
                $totalItem = $totalItem + $items[$i]->quantity;
                $orderPrice = $items[$i]->quantity * $sellingPrice;
                $totalOrderAmount = $totalOrderAmount + $orderPrice;
                $totalWeight =$totalWeight + ($productWeight * $items[$i]->quantity);
                $remainingQuantity = $availableQuantity - $items[$i]->quantity;
                array_push($itemPrices, $sellingPrice);
                array_push($remainingQuantitys, $remainingQuantity);
            }

            //update cart with orderrefno
            $result=[
                "totalItem"=>$totalItem,
                "totalOrderAmount"=>$totalOrderAmount,
                "totalWeight"=>$totalWeight,
            ];

            //.......check total weight against the logistic min and max...
            //get logistic price details from db
            $logisticPrice = getLogisticPrice($connect, $logisticid);
            if(!$logisticPrice){
                $errordesc="Invalid Logistic selected";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="select valid logistic";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
            $minWeight = $logisticPrice['lbsweightmin'];
            $maxWeight = $logisticPrice['lbsweightmax'];
            $price = $logisticPrice['price'];
            
            //echo "minweight=".$minWeight.'maxweight='.$maxWeight.'locationprice='.$price;

            //check cart weight is within max and min weight
            if($totalWeight < $minWeight && $totalWeight > $maxWeight){
                $errordesc="invalid weight";
                $linktosolve="htps://";
                $hint=['weight not within logistic min and max weight',"Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="weight not within logistic acceptable weight range";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
            $deliveryCharge = $price;

            //......deduct userbalance.......
            //total amount to be paid by the user for the order
            $totalPaid =$totalOrderAmount + $deliveryCharge;
            //check user wallet
            $userbalance = getUserBalance($connect, $userid);
            if($totalPaid > $userbalance){
                $errordesc="Insuffient balance";
                $linktosolve="htps://";
                $hint=["user balance is less than the amount for the order",'weight not within logistic min and max weight',"Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Insufficient balance";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
            
            //deduct user balance/ wallet
            $newBalance = $userbalance - $totalPaid;
            echo $newBalance;
            $SqlQuery = "UPDATE users SET bal = ? WHERE id = ?";
            $deductStmt = $connect->prepare($SqlQuery);
            $deductStmt->bind_param('ss',$newBalance, $userid);
            $deductStmt->execute();

            if (!$deductStmt->execute()){
                //invalid input/ server error
                $errordesc="Bad request";
                $linktosolve="htps://";
                $hint=["Ensure to send valid data, data already registered in the database."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="invalid user id passed or DB issue";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }

            //generate cart with trackid and orderRefno
            //generate trackid
            $trackid = generateUniqueShortKey($connect,'productcart', 'track_id');
            //generate order time
            $orderTime = time();
            $orderRefno = generateCart($connect,$userid,$logisticid,$deliveryAddressid,$deliveryCharge, $shipType,$totalWeight, $trackid,$noOfItem, $orderTime, $totalOrderAmount);
            //create order for each item and also deduct product available quantity
            $orderQuery = "INSERT INTO productorders(user_id,order_refno,product_id,quantity,price) VALUES (?,?,?,?,?)";
            $productQuery = "UPDATE products SET quantityavailable =? WHERE id =? OR productid  =?";
            
            $productStmt=$connect->prepare($productQuery);
            $orderStmt= $connect->prepare($orderQuery);
            for($i = 0; $i < count($items); $i ++){
                //insert into DB
                $orderStmt->bind_param("sssss",$userid,$orderRefno,$items[$i]->productid,$items[$i]->quantity,$itemPrices[$i]);

                $productStmt->bind_param('sss', $remainingQuantitys[$i], $items[$i]->productid, $items[$i]->productid );
                
                $updateProduct = $productStmt->execute();
                $createOrder =$orderStmt->execute();
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
                }else{echo "order created";}

                if(!$updateProduct){
                    //DB error ? invalid input
                    $errordesc="Bad request";
                    $linktosolve="htps://";
                    $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="fail to update product table, fill all require data input";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondInternalError($data);
                }else{echo "Product updated";}
            }
            $maindata=["orderRefno"=> $orderRefno, "trackid"=>$trackid];
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