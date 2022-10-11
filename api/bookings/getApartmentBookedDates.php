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

        // $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        // $pubkey = $decodedToken->usertoken;

        // $admin =  checkIfIsAdmin($connect, $pubkey);
        // // $agent = getShopWithPubKey($connect, $user_pubkey);
        // $user = getUserWithPubKey($connect, $pubkey);

        // if  (!$admin && !$user){

        //     // send user not found response to the user
        //     $errordesc =  "User not an Admin";
        //     $linktosolve = 'https://';
        //     $hint = "Only Admin has the ability to add send grid api details";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondUnAuthorized($data);
        // }

        if ( !isset($_GET['apartment_id']) ){

            $errordesc="apartment id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="apartment id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_GET['apartment_id']);
        }

        if ( empty($apartment_id) ){
            $errordesc = "Kindly Input the Apartment id";
            $linktosolve = 'https://';
            $hint = "Kindly make sure the table has been populated";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondOK($data);
        }

        
        // Get total number of complains in the system
        $query = "SELECT `booking_id`, `preferred_check_in`, `prefferred_check_out`, `paid` FROM `bookings` WHERE `apartment_id` = ?";
        $gt_booking = $connect->prepare($query);
        $gt_booking->bind_param("s", $apartment_id);
        $gt_booking->execute();
        $result = $gt_booking->get_result();
        $num_row = $result->num_rows; 
          
        if ($num_row > 0){

            $all_bookings = [];
            
            while( $row = $result->fetch_assoc() ){
                $paid_code = $row['paid'];
                $paid_status = ($row['paid'] == 1) ? "Paid" : "Not Paid";
                $preferred_check_in = $row["preferred_check_in"];
                $prefferred_check_out = $row["prefferred_check_out"];

                array_push($all_bookings, [
                    'id' => $row['booking_id'],
                    'preferred_check_in' => $preferred_check_in,
                    'prefferred_check_out' => $prefferred_check_out,
                    'paid_code' => $paid_code,
                    'paid_status' => $paid_status,
                ]);
            }
            
                
            $data = $all_bookings;
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }else{
            $errordesc = "No Records found";
            $linktosolve = 'https://';
            $hint = "Kindly make sure the table has been populated";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondOK($data);
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