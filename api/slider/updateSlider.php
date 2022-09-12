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
        if (!checkIfIsAdmin($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not found";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // Check if the email field is passed
        if (!isset($_POST['slider_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required slider id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $slider_id = cleanme($_POST['slider_id']);
        }
        
        // Check if the email field is passed
        if (!isset($_POST['name'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required name field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $name = cleanme($_POST['name']);
        }

        // Check if the recipient name field is passed
        if (!isset($_POST['type'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $type = cleanme($_POST['type']);
        }

        // Check if the recipient phone field is passed
        if (!isset($_FILES['image'])){
            $imglink = $_POST['image'];
        }else{
            $imglink = $_FILES['image'];
        }

        // Check if the local government field is passed
        if (!isset($_POST['shortdesc'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required shortdesc field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $shortdesc = cleanme($_POST['shortdesc']);
        }

        if (!isset($_POST['product_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $product_id = cleanme($_POST['product_id']);
        }

        if (!isset($_POST['product_image'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required type field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $product_image = cleanme($_POST['product_image']);
        }

        list($width, $height, $type, $attr) = getimagesize("../../assets/products/$product_image");

        if ($width < 468 || $height < 417){
            $errordesc = "Product Image too small";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required image and the correct specification";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ($width > 500 || $height > 420){
            $image_file = "../../assets/products/$product_image";
            $image_slider = "../../assets/products/$product_image";

            $new_width = 468;
            $new_height = 417;

            resizeImage($image_file,$new_width, $new_height ,$image_slider);
            resizeImage($image_file,$new_width, $new_height ,$image_slider);
            $bgcolor = array("red" => "255", "green" => "255", "blue" => "255");
            $fuzz = 9;
            $image_removed = remove_image_background($image_file, $bgcolor, $fuzz);
        }else{
            $image_file = "../../assets/products/$product_image";
            $bgcolor = array("red" => "255", "green" => "255", "blue" => "255");
            $fuzz = 9;
            $image_removed = remove_image_background($image_file, $bgcolor, $fuzz);
        }

        echo $image_removed;

        // if (!checkifFieldExist($connect, "slider", "slider_product", $product_id) ){
        //     $error = checkifFieldisUnique($connect, "slider", "slider_product",  $product_id);

        //     if ($error){
        //         $errordesc = "$error slider already exist";
        //         $linktosolve = 'https://';
        //         $hint = "Kindly pass the required shortdesc field in this endpoint";
        //         $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //         $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //         respondBadRequest($data);
        //     }
        // }

        

        // if ( !checkifFieldExist($connect, "slider" , "id" , $slider_id) ){
        //     $errordesc = "Invalid Slider Passed";
        //     $linktosolve = 'https://';
        //     $hint = "Kindly pass a valid slider id this endpoint";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondBadRequest($data);
        // }

        
        //  // check if none of the field is empty
        // if ( empty($name) || empty($shortdesc) ){

        //     $errordesc = "Insert all fields";
        //     $linktosolve = 'https://';
        //     $hint = "Kindly pass value to all the fields";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondBadRequest($data);
        // }

        // if (is_array($imglink)){
        //     $slider_image = uploadImage($imglink, "sliders", $endpoint, $method);
        // }else{
        //     $slider_image = $imglink;
        // }

        // if ($type == 1 || $type == "web") $slider_type = 1;
        // if ($type == 2 || $type == "app") $slider_type = 2;


        // $query = 'UPDATE `slider` SET `name`= ?,`type`= ?,`imglink`= ?,`shortdesc`= ?, `slider_product` = ? WHERE `id` = ?';
        // $slider_stmt = $connect->prepare($query);
        // $slider_stmt->bind_param("ssssss", $name, $slider_type, $slider_image, $shortdesc, $product_id ,$slider_id );

        // if ( $slider_stmt->execute() ) {
        //     $slider_stmt->close();
        //     $updateImage = "";
        //     $value = "1";
        //     $update_product_image = "UPDATE `product_images` SET `slider_image`= ? WHERE `product_id` = ? AND `name` = ?";
        //     $update = $connect->prepare($update_product_image);
        //     $update->bind_param("sss", $value, $product_id, $product_image);

        //     if ($update->execute()){
        //         $text= "Slider successfully updated";
        //         $status = true;
        //         $data = [];
        //         $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
        //         respondOK($successData);
        //     }

        // }else{
        //     $errordesc =  $slider_stmt->error;
        //     $linktosolve = 'https://';
        //     $hint = "500 code internal error, check ur database connections";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondInternalError($data);
        // }

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