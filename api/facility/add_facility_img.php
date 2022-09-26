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

        $user =  getUserWithPubKey($connect, $user_pubkey);

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

        // Check if the recipient name field is passed
        if (!isset($_POST['facility_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required facility id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $facility_id = cleanme($_POST['facility_id']);
        }

        if (!isset($_POST['apartment_facility_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required apartment id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apartment_facility_id = cleanme($_POST['apartment_facility_id']);
        }

        if (!isset($_FILES['image'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required number field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $image = $_FILES['image'];
        }
        
         // check if none of the field is empty
        if ( empty($facility_id) || empty($apartment_facility_id) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( count($image) < 1 ){

            $errordesc = "Insert an image to Upload ";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!checkifFieldExist($connect, "facilities", "facility_id", $facility_id)){
            $errordesc = "Amenity id not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ( !checkifFieldExist($connect, "apartment_facilities", "apart_facility_id", $apartment_facility_id) ){
            $errordesc = "Apartment not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $path = "facilities";

        $image_uploaded = uploadImage($file, $path , $endpoint, $method);

        if ( $image_uploaded ){
            $split = explode(".", $image_uploaded);
            $length = count($split);
            $type = $split[$length - 1];
            $imagePath = "../../assets/images/" ."$path/". $image_uploaded;

            $watermark_image = "../../assets/images/watermarks/rahman.png";
            $watermarkedImage = waterMarkImage($imagePath, $type, $watermark_image, $endpoint, $method);

            if ($watermarkedImage){
                $image_url = $imageurl. "$path/". $image_uploaded;

                $apart_facility_img_id = generateUniqueShortKey($connect, "apartment_facilities_img", "apart_fac_img_id ");


                $query = 'INSERT INTO `apartment_facilities_img`(`apart_fac_img_id`, `apartment_fac_id`, `facility_id`, `images`) VALUES (?, ?, ?, ?)';
                $slider_stmt = $connect->prepare($query);
                $slider_stmt->bind_param("ssss", $apart_facility_img_id ,$apart_facility_id, $facility_id, $image_url);

                if ( $slider_stmt->execute() ) {
                    $text= "Apartment Facility Image successfully uploaded";
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