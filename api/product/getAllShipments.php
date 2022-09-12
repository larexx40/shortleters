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

        // decode token to check if user is authorized
        $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        $user_pubkey = $decodedToken->usertoken;

        // send error if ur is not in the database
        if (!getUserWithPubKey($connect, $user_pubkey)){

            // send user not found response to the user
            $errordesc =  "User not found";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }

        $user_id = getUserWithPubKey($connect, $user_pubkey);

        // use user id to get all products ordered and their status
        $query = 'SELECT * FROM productcart WHERE userid = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = mysqli_fetch_assoc($result);

            $output = array();
            $i = 0;
            while ( $row = mysqli_fetch_assoc($result) ){
                $output[$i]['id'] = $row['id'];
                $output[$i]['order_ref_no'] = $row['orderref_number'];
                $output[$i]['track_id'] = $row['track_id'];
                $output[$i]['weight'] = $row['totalweightlbs'];
                $output[$i]['weight'] = $row['totalweightlbs'];
                $output[$i]['totalpaid'] = $row['totalpaid'];
                
                if ($row['orderstatus_id'] == 0){
                    $output[$i]['status'] = "Packing";
                }
                if ($row['orderstatus_id'] == 1){
                    $output[$i]['status'] = "Delivered";
                }
                if ($row['orderstatus_id'] == 2){
                    $output[$i]['status'] = "Processed";
                }
                if ($row['orderstatus_id'] == 3){
                    $output[$i]['status'] = "Shipped";
                }
                if ($row['orderstatus_id'] == 4){
                    $output[$i]['status'] = "Arrived";
                }
                if ($row['orderstatus_id'] == 5){
                    $output[$i]['status'] = "Arrived";
                }
                if ($row['orderstatus_id'] == 0){
                    $output[$i]['status'] = "Pending";
                }

                $i++;
            }
        }else{
            
            $text= "No shipment history was Founded, Kindly place an order";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }


    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
    }
?>