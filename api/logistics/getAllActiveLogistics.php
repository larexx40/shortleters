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


        $admin = checkIfIsAdmin($connect, $user_pubkey);
        $user = getUserWithPubKey($connect, $user_pubkey);
        $shop = checkIfShopOwner($connect, $user_pubkey);
        // send error if ur is not in the database
        if ( !$admin && !$user && !$shop ){
            // send user not found response to the user
            $errordesc =  "User not found";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $active = 1;
        $query = 'SELECT * FROM logistics WHERE accept_order = ? AND status = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ii", $active, $active);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $name = $row['name'];
                $country = $row['country'];
                $address = $row['address'];
                $city = $row['city'];
                $accept_order = $row['accept_order'];
                $rateperdistance = $row['rateperdistance'];
                $open_time = $row['open_time']; 
                $close_time = $row['close_time'];
                $office_phone = $row['office_phone'];
                $office_whatapp = $row['office_whatapp'];
                $shop_email = $row['shop_email'];
                $image = $row['image'];
                $description= $row['description'];
                $balance= $row['bal'];
                $status = $row['status'];
                $openstatus = $row['openstatus'];
                array_push($allResponse, array("id"=>$id, "name"=>$name, "country"=>$country, "address"=>$address, "city"=>$city, "accept_order"=>$accept_order, 
                "rateperdistance"=>$rateperdistance, "open_time"=>$open_time, "close_time"=>$close_time, "office_phone"=>$office_phone, 
                "office_whatapp"=>$office_whatapp , "shop_email"=>$shop_email , "status"=>$status, "openstatus"=>$openstatus, "image"=>$image, "description"=>$description, "balance"=>$balance));

            }
            
            $text= "Logistics Fetched";
            $status = true;
            $data = $allResponse;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $text= "No Current Logistics company in the DB";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
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