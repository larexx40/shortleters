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
        $pubkey = $decodedToken->usertoken;

        $admin =  checkIfIsAdmin($connect, $user_pubkey);
        // $agent = getShopWithPubKey($connect, $user_pubkey);
        // $user = getUserWithPubKey($connect, $user_pubkey);

        if  (!$admin){

            // send user not found response to the user
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        if (!isset($_GET['apart_add_char_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required sub type id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apart_add_char_id = cleanme($_GET['apart_add_char_id']);
        }

        if ( empty($apart_add_char_id)){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

                

        $query = "SELECT * FROM `apartment_additional_charge` WHERE `apart_chrg_id` = ?";
        $gtTotalcomplains = $connect->prepare($query);
        $gtTotalcomplains->bind_param("s", $apart_add_char_id);
        $gtTotalcomplains->execute();
        $result = $gtTotalcomplains->get_result();
        $num_row = $result->num_rows;
                

        if ($num_row > 0){

            while($row = $result->fetch_assoc()){
                $price =  $row['price'];
                $status_code = $row['status'];
                $add_charg_id = $row['add_charg_id'];
                $add_charg_id_name = getNameFromField($connect, "additional_charge", "add_chrg_id", $add_charg_id);
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $apartment_id = $row['apartment_id'];
                $apartment_id_name = getNameFromField($connect, "apartments", "apartment_id", $apartment_id);
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                $building_sub_type = array(
                    'id' => $row['apart_chrg_id'],
                    'price' => $name,
                    'status_code' => $status_code,
                    'add_charge' => $add_charg_id,
                    'add_charge_name' => $add_charg_id_name,
                    'apartment_id' => $apartment_id,
                    'apartment_name' => $apartment_id_name,
                    'status' => $status,
                    'created' => $created,
                    'updated' => $updated,
                );
            }
            $data = array(
                'apart_add_charges' => $building_sub_type
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc = "No Records found";
        $linktosolve = 'https://';
        $hint = "Kindly make sure the table has been populated";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondOK($data);

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