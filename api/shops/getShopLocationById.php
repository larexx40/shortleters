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

        // get if the user is a shop
        $shop_id = getShopWithPubKey($connect, $user_pubkey);
        $admin_id = checkIfIsAdmin($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if (!$shop_id && !$admin_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ( !isset($_GET['loc_id']) ){

            $errordesc="Shop Location id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Shop Location id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $shopLocationId = cleanme($_GET['loc_id']);
        }

        $query = "SELECT `shop_id`, `name`, `created_at`, `updated_at`, `longitude`, `latitude`, `status` FROM `shop_locations` WHERE id = ?";
        $gtTotalLoc = $connect->prepare($query);
        $gtTotalLoc->bind_param("s", $shopLocationId);
        $gtTotalLoc->execute();
        $result = $gtTotalLoc->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){

            while($row = $result->fetch_assoc()){
                $shopname = getShopname($connect, $row['shop_id']);
                $location = $row['name'];
                $status = ($row['status'] == 0) ? "inactive" : "active";
                $geoLat = $row['latitude'];
                $geoLong = $row['longitude'];

                
                $location = array(
                    'shopname' => $shopname,
                    'location' => $location,
                    'status' => $status,
                    'geo_location' => $geoLat. ", ". $geoLat
                );
            }

            $data = $location;
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc = "No Records";
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