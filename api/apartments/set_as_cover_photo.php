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

    // check if the right request was sent
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

        // get if the user is a shop
        $user = checkIfUser($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if ( !$user ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }


        if ( !isset($_POST['apartment_img_id']) ){

            $errordesc="product id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="amenity id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_img_id = cleanme($_POST['apartment_img_id']);
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

        if ( empty($apartment_id) || empty($apartment_img_id) ){

            $errordesc = "Enter apartments id";
            $linktosolve = 'https://';
            $hint = "Kindly ensure that a valid id is passed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }
        

        

        // check if product is valid
        if ( !checkifFieldExist($connect, "apartments", "apartment_id", $apartment_id) ) {

            $errordesc = "Amenity does not Exist ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the product id passed is for an existing product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !checkifFieldExist($connect, "apartment_images", "apartment_img_id", $apartment_img_id) ) {

            $errordesc = "apartment images does not Exist ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the product id passed is for an existing product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $active = "1";
        $inactive = "0";


        // set current cover photo to zero
        $query = "UPDATE `apartment_images` SET `cover_photo`= ? WHERE cover_photo = ? AND apartment_img_id = ? AND apartment_id = ?";
        $updateStatus = $connect->prepare($query);
        $updateStatus->bind_param("ssss", $inactive, $active, $apartment_img_id, $apartment_id);
        $updateStatus->execute();

        if ($updateStatus->error){
            $errordesc =  $updateStatus->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }

        if ( $updateStatus->execute()){
            
            $set_cover_query = "UPDATE `apartment_images` SET `cover_photo`= ? WHERE apartment_img_id = ? AND apartment_id = ?";
            $update_cover = $connect->prepare($set_cover_query);
            $update_cover->bind_param("sss", $active, $apartment_img_id, $apartment_id);
            $update_cover->execute();

            if ($update_cover->error){
                $errordesc =  $update_cover->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondInternalError($data);
            }

            if ( $update_cover->execute()){
                
                $data = [];
                $text= "Photo Successfully Set as Cover Photo";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }
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