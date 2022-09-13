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

        // send error if ur is not in the database
        if (!checkIfIsAdmin($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only admin is authorized is to get all users";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        
        // Check if the user id field is passed
        if (!isset($_GET['user_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $user_id = cleanme($_GET['user_id']);
        }

        
        
        // Get total number of complains in the system
        $query = "SELECT * FROM `users` WHERE id = ?";
        $gtTotalcomplains = $connect->prepare($query);
        $gtTotalcomplains->bind_param("s", $user_id);
        $gtTotalcomplains->execute();
        $result = $gtTotalcomplains->get_result();
        $num_row = $result->num_rows;
        

        if ($num_row > 0){

            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $email = $row['email'];
                $firstname = $row['fname'];
                $lastname = $row['lname'];
                $phoneno = $row['phoneno'];
                $location = $row['location'];
                $balance = $row['bal'];
                $refcode = $row['refcode'];
                $state = $row['state'];
                $country = $row['country'];
                $username = $row['username'];
                $dob = $row['dob'];
                $sex = $row['sex'];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                $referredBy = ( getUserFullname($connect, $row['referby']) ) ? getUserFullname($connect, $row['referby']) : "";
                $statusCode = $row['status'];
                if ($row['status'] == 0){
                    $userStatus = "Banned";
                }
                if ($row['status'] == 1){
                    $userStatus = "Active";
                }
                if ($row['status'] == 2){
                    $userStatus = "Suspended";
                }
                if ($row['status'] == 3){
                    $userStatus = "Frozen";
                }
                $adminSeen = $row['adminseen'];
                $adminCheck = ($row['adminseen'] == 0) ? "Not seen" : "Seen";

                
                $user = array(
                    'id' => $id,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phoneno' => $phoneno,
                    'location' => $location,
                    'balance' => $balance,
                    'refcode' => $refcode,
                    'state' => $state,
                    'country' => $country,
                    'status_code' => $statusCode,
                    'status' => $userStatus,
                    'status' => $userStatus,
                    'admin_seen_code' => $adminSeen,
                    'admin_seen' => $adminCheck,
                    'username' => $username,
                    'referredBy' => $referredBy,
                    'dob' => $dob,
                    "sex" => $sex,
                    'created' => $created,
                    'updated' => $updated
                );
            }
            $data = array(
                'user' => $user
            );
            $text= "Search completed";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc = "No Records";
        $linktosolve = 'https://';
        $hint = "Kindly make sure the table has been populated";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondBadRequest($data);
       

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