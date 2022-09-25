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
        $min_photo_number = $row['min_apart_photo'];

        $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        $user_pubkey = $decodedToken->usertoken;

        // get if the user is a shop
        $user_id = getUserWithPubKey($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if (!$user_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "Admin only have access to add Shop";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        

        if ( !isset($_FILES['images']) ){

            $errordesc="Apartment Images required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Apartment images must be sent";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartmentImages = $_FILES['images'];
        }

        if ( !isset($_POST['apartment_id']) ){

            $errordesc="Apartment id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Apartment id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_POST['apartment_id']);
        }

        if ( empty($apartment_id) ){
            
            $errordesc = "Insert Apartment id value";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $num_row = checkifFieldExist($connect, "apartment_images", "apartment_id", $apartment_id);

        $total_files_sent = count($productImages['name']);

        if (!$num_row){
            if ( $total_files_sent < $min_photo_number ){
            
                $errordesc = "Minimum Number of images to upload is $min_photo_number";
                $linktosolve = 'https://';
                $hint = "Kindly pass value to all the fields in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
        }

        

        $error = true;
        
        for ($index = 0; $index < $total_files_sent; $index++){
             $file = [
                'name' => $productImages['name'][$index],
                'size' => $productImages['size'][$index],
                'tmp_name' => $productImages['tmp_name'][$index],
                'error' => $productImages['error'][$index]
            ];

            $path = "apartments";

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
                    $apartment_img_id = generateUniqueShortKey($connect, "apartment_images", "apartment_id");

                    if ($index < 1){
                        $cover = "1";
                    }else{
                        $cover = "0";
                    }

                    $query = 'INSERT INTO `apartment_images`(`apartment_img_id`, `apartment_id`, `image_url`, `cover_photo`) VALUES (?,?,?,?)';
                    $slider_stmt = $connect->prepare($query);
                    $slider_stmt->bind_param("ss", $apartment_img_id ,$apartment_id, $image_url, $cover);

                    if ($slider_stmt->execute()){
                        $error = false;
                    }

                    if ($slider_stmt->error){
                        $errordesc =  $slider_stmt->error;
                        $linktosolve = 'https://';
                        $hint = "500 code internal error, check ur database connections";
                        $errorData = returnError7003($errordesc, $linktosolve, $hint);
                        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                        respondInternalError($data);
                    }
                }
            }

        }

        if ( !$error ) {
            $slider_stmt->close();

            $steps = "8";

            // Make user and agent
            $query = "UPDATE `apartments` SET `steps`= ? WHERE `apartment_id` = ? AND agent_id = ?";
            $updateStatus = $connect->prepare($query);
            $updateStatus->bind_param("sss", $steps ,$apartment_id ,$user_id);
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