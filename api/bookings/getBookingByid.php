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

        $admin =  checkIfIsAdmin($connect, $pubkey);
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
        if ( !isset($_GET['booking_id']) ){
            $errordesc="booking id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="booking id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $booking_id = cleanme($_GET['booking_id']);
        }

        if ( empty($booking_id) ){

            $errordesc = "Enter booking id";
            $linktosolve = 'https://';
            $hint = "Kindly ensure that a valid id is passed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        // Get total number of complains in the system
        $query = "SELECT * FROM `bookings` WHERE booking_id = ?";
        $gtTotalPgs = $connect->prepare($query);
        $gtTotalPgs->bind_param("s", $booking_id);
        $gtTotalPgs->execute();
        $result = $gtTotalPgs->get_result(); 
        $numRow = $result->num_rows;
        
        if($numRow > 0){
            $row = $result->fetch_assoc();
            $paid_code = $row['paid'];
            $paid_status = ($row['paid'] == 1) ? "Paid" : "Not Paid";
            // $admin_id =  $row['admin_id'];
            // $admin_name =  ( $admin_id )? getNameFromField($connect, "admin ", "id", $admin_id) : null;
            $first_name =  $row['first_name'];
            $f_initials = ($first_name)? strtoupper(substr("$first_name",0,1)) : null;
            $last_name =  $row['last_name'];
            $l_initials = ($last_name)? strtoupper(substr("$last_name", 0, 1)): null;
            $initials = $f_initials.$l_initials;
            $gender = $row['gender'];
            $phone = $row['phone'];
            $email = $row["email"];
            $apartment_id = $row["apartment_id"];
            $apartment_name = getNameFromField($connect, "apartments", "apartment_id", $apartment_id);
            $address = $row["address"];
            $occupation_or_workplace = $row["occupation_or_workplace"];
            $preferred_check_in = $row["preferred_check_in"];
            $prefferred_check_out = $row["prefferred_check_out"];
            // $min_people = $row["min_people"];
            // $max_people = $row["max_people"];
            $identification_type = $row["identification_type"];
            $identification_img = $row["identification_img"];
            $created = gettheTimeAndDate(strtotime($row['created_at']));
            $updated = gettheTimeAndDate(strtotime($row['updated_at']));
            $numRow = $result->num_rows;
            $maindata = [
                'id' => $row['booking_id'],
                // 'admin_id' => $admin_id,
                // 'admin_name' => ($admin_name) ? $admin_name : null,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'initials'=>$initials,
                'gender' => $gender,
                'phone' => $phone,
                'email' => $email,
                'apartment_id' => $apartment_id,
                'apartment_name' => ($apartment_name) ? $apartment_name : null,
                'address' => $address,
                'occupation_or_workplace' => $occupation_or_workplace,
                'preferred_check_in' => $preferred_check_in,
                'prefferred_check_out' => $prefferred_check_out,
                // 'min_people' => $min_people,
                // 'max_people' => $max_people,
                'identification_type' => $identification_type,
                'identification_img' => $identification_img,
                'paid_code' => $paid_code,
                'paid_status' => $paid_status,
                'created' => $created,
                'updated' => $updated,
            ];
            $errordata = [];
            $text = "Data found";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
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