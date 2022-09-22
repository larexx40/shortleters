<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
    
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    if ($method == 'POST') {

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

        $userid =  checkIfUser($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$user){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        if ( !isset($_GET['apartment_id']) ){
            $errordesc="product id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="host type id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_GET['apartment_id']);
        } 

        //`name`, `preferred_chek_in`, `preferred_chek_out`, `no_of_guest`
        if ( isset($_GET['name']) ){
            $name = cleanme($_GET['name']);
        }else{
            $name = '';
        }
        
        if ( isset($_GET['preferred_chek_in']) ){
            $preferred_chek_in = cleanme($_GET['preferred_chek_in']);
        }else{
            $preferred_chek_in = '';
        }
        if ( isset($_GET['preferred_chek_out']) ){
            $preferred_chek_out = cleanme($_GET['preferred_chek_out']);
        }else{
            $preferred_chek_out = '';
        }
        if ( isset($_GET['no_of_guest']) ){
            $no_of_guest = cleanme($_GET['no_of_guest']);
        }else{
            $no_of_guest = '';
        }

       

        $wishlistid=generateUniqueShortKey($connect, "user_wishlist", "wishlist_id");
         // check if none of the field is empty
        if ( empty($apartment_id) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        //`name`, `preferred_chek_in`, `preferred_chek_out`, `no_of_guest`
        $query = 'INSERT INTO `user_wishlist`(`wishlist_id`, `apartment_id`, `user_id`, `name`, `preferred_chek_in`, `preferred_chek_out`, `no_of_guest`) VALUES (?,?,?,?,?,?,?)';
        $slider_stmt = $connect->prepare($query);
        $slider_stmt->bind_param("sssssss", $wishlistid, $apartment_id, $userid, $name, $preferred_chek_in, $preferred_chek_out, $no_of_guest);

        if ( $slider_stmt->execute() ) {
            $text= "Wishlist successfully added";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc =  $slider_stmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
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