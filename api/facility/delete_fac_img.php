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

        // send error if ur is not in the database
        if (!getUserWithPubKey($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // Check if the email field is passed
        if (!isset($_POST['apart_fac_img_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required apartment facility id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $apart_fac_img_id = cleanme($_POST['apart_fac_img_id']);
        }

        

        // fetch all apart_facility images and delete
        $imgs_query = "SELECT `images` FROM `apartment_facilities_img` WHERE `apart_fac_img_id` = ?";
        $imgs_stmt = $connect->prepare($imgs_query);
        $imgs_stmt->bind_param("s", $apart_fac_img_id );
        $imgs_stmt->execute();
        $result = $imgs_stmt->get_result();
        $num_row = $result->num_rows;
        $imgs_stmt->close();

        if ($num_row > 0){
            while( $row = $result->fetch_assoc() ){
                $img_link = ($row['images'])? $row['images'] : false;
                $img_name_array = ($img_link)? explode("/", $img_link) : null;
                $length = count($img_name_array);
                $image_name = $img_name_array[$length - 1];

                $img_path = "../../assets/images/facilities/$image_name";

                if (file_exists($img_path)){
                    if ( unlink($img_path) ){
                        $error = false;
                        
                    }else{
                        $errordesc = "Error Deleting Images";
                        $linktosolve = 'https://';
                        $hint = "Kindly pass a valid slider id field in this endpoint";
                        $errorData = returnError7003($errordesc, $linktosolve, $hint);
                        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                        respondBadRequest($data);
                    }
                }else{
                    $errordesc = "Facility Image not Found";
                    $linktosolve = 'https://';
                    $hint = "Kindly pass a valid slider id field in this endpoint";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }
            }

            if (!$error){
                // delete all facility images from DB
                $delte_imgs = "DELETE FROM `apartment_facilities_img` WHERE `apart_fac_img_id` = ?";
                $delte_imgs_stmt = $connect->prepare($delte_imgs);
                $delte_imgs_stmt->bind_param("s", $apart_fac_img_id);
                $delte_imgs_stmt->execute();
                $rows_affected = $delte_imgs_stmt->affected_rows;

                if ( $rows_affected > 0 ) {
                
                        $text= "Apartment Facility successfully deleted";
                        $status = true;
                        $data = [];
                        $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                        respondOK($successData);

                }else{
                    $errordesc = "Apartment Facility Image not Found";
                    $linktosolve = 'https://';
                    $hint = "Kindly pass a slider that exist in the database";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }

                $errordesc =  $delte_imgs_stmt->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondInternalError($data);
            }

        }else{
            $query = 'DELETE FROM `apartment_facilities` WHERE `apart_facility_id` = ? AND `facility_id` = ?';
            $slider_stmt = $connect->prepare($query);
            $slider_stmt->bind_param("ss", $apart_facility_id ,$facility_id);
            $slider_stmt->execute();
            $rows_affected = $slider_stmt->affected_rows;

            if ( $rows_affected > 0 ) {
                $slider_stmt->close();

                $text= "Apartment Facility successfully deleted";
                $status = true;
                $data = [];
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);

            }else{
                $errordesc = "Apartment Facility not Found";
                $linktosolve = 'https://';
                $hint = "Kindly pass a slider that exist in the database";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

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