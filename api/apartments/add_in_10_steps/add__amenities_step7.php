<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";

    // This step occurs if the user Selects a sub Building Type According to Building Type Selected
    
  

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

        $user_id =  getUserWithPubKey($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$user_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }


        if ( !isset($_POST['amenities_ids']) ){

            $errordesc="Amenities id is required, Kindly seperate with a comma";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Amenities id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $amenities_ids = cleanme($_POST['amenities_ids']);
        }

        if ( !isset($_POST['apartment_id']) ){

            $errordesc="apartments id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="apartments id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_POST['apartment_id']);
        }

        if ( empty($amenities_ids) || empty($apartment_id) ){

            $errordesc = "Enter all Fields";
            $linktosolve = 'https://';
            $hint = "Kindly ensure that a valid id is passed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        
        $amenity_id_array = explode(",", $amenities_ids);
        $amenity_length = count($amenity_id_array);

        for ( $i = 0; $i < $amenity_length; $i++){
            // check if fields are valid
            if ( !checkifFieldExist($connect, "sub_amenities", "sub_amen_id", $amenity_id_array[$i] ) ) {

                $errordesc = "Amenity does not Exist ";
                $linktosolve = 'https://';
                $hint = "Kindly ensure the product id passed is for an existing product";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
        }

        

        if ( !checkifFieldExist($connect, "apartments", "apartment_id", $apartment_id) ) {

            $errordesc = "Apartment does not Exist ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the product id passed is for an existing product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $steps = "7";
        

        // Make user and agent
        $query = "UPDATE `apartments` SET `amenities_id`= ?, `steps`= ? WHERE `apartment_id` = ? AND agent_id = ?";
        $updateStatus = $connect->prepare($query);
        $updateStatus->bind_param("sssss", $guest_safety_ids, $amenities_ids, $steps ,$apartment_id ,$user_id);
        $execute = $updateStatus->execute();

        if ($updateStatus->error){
            $errordesc =  $updateStatus->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }

        if ( $execute ){
            
            $text= "Saved";
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