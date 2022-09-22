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
        $userid = getUserWithPubKey($connect, $pubkey);
        $adminid = checkIfIsAdmin($connect, $pubkey);
        // send error if ur is not in the database
        
        if (!$userid && !$adminid){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        if ( $adminid ){
            if ( !isset($_GET['user_id']) ){
                $errordesc = "All fields must be passed";
                $linktosolve = 'https://';
                $hint = "Kindly pass the required user id field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $userid = cleanme($_GET['user_id']);
            }
        }
        
        // Get total number of complains in the system
        $query = "SELECT * FROM `bookings` WHERE `user_id` = ?";
        $gt_booking = $connect->prepare($query);
        $gt_booking->bind_param("s", $userid);
        $gt_booking->execute();
        $result = $gt_booking->get_result();
        $num_row = $result->num_rows;   
        if ($num_row > 0){
            $allBookings = [];
            while($row = $result->fetch_assoc()){
                $paid_code = $row['paid'];
                $paid_status = ($row['paid'] == 1) ? "Paid" : "Not Paid";
                $admin_id =  $row['admin_id'];
                if($admin_id){
                    $booked_by =  ( $admin_id )? getNameFromField($connect, "admin ", "id", $admin_id) : null;
                }
                $userid =$row['user_id'];
                if($userid){
                    $booked_by =($userid)? getUserFullname($connect, $userid): null;
                }
                $admin_name =  ( $admin_id )? getNameFromField($connect, "admin ", "id", $admin_id) : null;
                $first_name =  $row['first_name'];
                $last_name =  $row['last_name'];
                $gender = $row['gender'];
                $phone = $row['phone'];
                $email = $row["email"];
                $apartment_id = $row["apartment_id"];
                $apartment_price = $row["apartment_price"];
                $apartment_name = getNameFromField($connect, "apartments", "apartment_id", $apartment_id);
                $address = $row["address"];
                $occupation_or_workplace = $row["occupation_or_workplace"];
                $preferred_check_in = $row["preferred_check_in"];
                $prefferred_check_out = $row["prefferred_check_out"];
                $total_amount_paid = $row['total_amount_paid'];
                $no_of_people = $row["no_of_people"];
                // $max_people = $row["max_people"];
                $identification_type = $row["identification_type"];
                $identification_img = $row["identification_img"];
                $customer_note = $row["customer_note"];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));

                array_push($allBookings, array(
                    'id' => $row['booking_id'],
                    'booked_by'=>$booked_by,
                    'admin_id' => $admin_id,
                    'userid'=>$userid,
                    'admin_name' => ($admin_name) ? $admin_name : null,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'gender' => $gender,
                    'phone' => $phone,
                    'email' => $email,
                    'apartment_id' => $apartment_id,
                    'apartment_price' => $apartment_price,
                    'apartment_name' => ($apartment_name) ? $apartment_name : null,
                    'address' => $address,
                    'occupation_or_workplace' => $occupation_or_workplace,
                    'preferred_check_in' => $preferred_check_in,
                    'prefferred_check_out' => $prefferred_check_out,
                    'total_amount_paid' => $total_amount_paid,
                    'no_of_people' => $no_of_people,
                    // 'max_people' => $max_people,
                    'identification_type' => $identification_type,
                    'identification_img' => $identification_img,
                    'paid_code' => $paid_code,
                    'paid_status' => $paid_status,
                    'customer_note' => $customer_note,
                    'created' => $created,
                    'updated' => $updated,
                ));
            }


            $data = [
                "bookings" => $allBookings
            ];
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