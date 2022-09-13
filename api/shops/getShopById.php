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

    // check if the right request was sent
    if ($method == 'GET') {
        // Get company private key
        $query = 'SELECT * FROM apidatatable';
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row =  mysqli_fetch_assoc($result);
        $companykey = $row['privatekey'];
        $servername = $row['servername'];
        $expiresIn = $row['tokenexpiremin'];

        $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        $user_pubkey = $decodedToken->usertoken;

        $shopID = getShopWithPubKey($connect, $user_pubkey);
        $admin = checkIfIsAdmin($connect, $user_pubkey);

        // check if user is admin
        if ( !$admin && !$shopID ){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "Only Admin and Shop are Authorized to get details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // pass id and validate
        if ( $admin ){
            if ( !isset($_GET['shop_id']) ){
                $errordesc="id of shop is required";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="id of shop must be passed";
                $method;
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }else{
                $shopID = cleanme($_GET['shop_id']);
            }
    
            if ( !is_numeric($shopID) ){
                $errordesc="Bad request";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Kindly pass a valid shop id";
                $method;
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
        }
        
            // Output page
            $query = "SELECT * FROM `shops` where id = ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("s", $shopID);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
            
                while($row = $result->fetch_assoc()){
                    $id = $row['id'];
                    $name = $row['name'];
                    $country = $row['country'];
                    $address = $row['address'];
                    $city = $row['city'];
                    $accept_order = ( $row['accept_order'] == 1) ? "accepting Orders" : "not accepting orders";
                    $minCost = $row['min_cost'];
                    $open_time = ($row['open_time']) ? date("h:iA", $row['open_time']) : ""; 
                    $close_time = ($row['close_time'])? date("h:iA", $row['close_time']) : "";
                    $office_phone = $row['office_phone'];
                    $office_whatapp = $row['office_whatapp'];
                    $shop_email = $row['shop_email'];
                    $image = $row['image'];
                    $openstatus = ($row['openstatus'] == 1) ? "Open" : "Closed";
                    $description= $row['description'];
                    $balance= $row['bal'];
                    $username = $row['username'];
                    $type_code = $row['shoptype'];
                    
                    if ( $type_code == 1 ){
                        $shop_type = "Gadget";
                    }
                    
                    if ( $row['status'] == 0 ){
                        $shop_status = "Banned";
                    }
                    if ( $row['status'] == 1 ){
                        $shop_status = "Active";
                    }
                    if ( $row['status'] == 2 ){
                        $shop_status = "Suspended";
                    }
                    if ( $row['status'] == 3 ){
                        $shop_status = "Frozen";
                    }

                    $shop = array("id"=>$id, "name"=>$name, "country"=>$country, "address"=>$address, "city"=>$city, "accept_order"=>$accept_order, 
                    "mincost"=>$minCost, "open_time"=>$open_time, "close_time"=>$close_time, "office_phone"=>$office_phone, 
                    "office_whatapp"=>$office_whatapp , "shop_email"=>$shop_email , "openstatus"=>$openstatus, "image"=>$image, "description"=>$description, "balance"=>$balance, 
                    "status" => $shop_status , 'type_code' => $type_code, 'shop_type' => $shop_type ,"username" => $username);
                }

                $data = array(
                    'shop' => $shop
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "No records";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

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