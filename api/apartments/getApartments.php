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

        
        // Get total number of complains in the system
        $listed = "1";
        $query = "SELECT `apartment_id`, `name`, `description`, `check_in_day`, `price`, `min_stay`, `max_stay`  FROM `apartments` WHERE`apartment_status` = ? AND `availability` = ?";
        $gt_apartments = $connect->prepare($query);
        $gt_apartments->bind_param("ss", $listed, $listed);
        $gt_apartments->execute();
        $result = $gt_apartments->get_result();
        $num_row = $result->num_rows;   

        if ($num_row > 0){
            $allApartments = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];  
                $price = $row["price"];
                $description = $row['description'];
                $check_in_day = $row["check_in_day"];
                $min_stay = $row['min_stay'];
                $min_stay_value = explode(" ", $min_stay)[0];
                $max_stay = $row['max_stay'];
                $max_stay_value = explode(" ", $max_stay)[0];
                
                array_push($allApartments, array(
                    'id' => $row['apartment_id'],
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'check_in_day' => $check_in_day,
                    'min_stay' => $min_stay,
                    'min_stay_value' => $min_stay_value,
                    'max_stay' => $max_stay,
                    'max_stay_value' => $max_stay_value
                ));
            }
            $data = array(
                'apartments' => $allApartments
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