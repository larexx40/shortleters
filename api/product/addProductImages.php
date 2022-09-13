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
        $shop_id = checkIfShopOwner($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if (!$shop_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "Admin only have access to add Shop";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        

        if ( !isset($_FILES['images']) ){

            $errordesc="Product Images required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product images must be sent";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productImages = $_FILES['images'];
        }

        if ( !isset($_POST['product_id']) ){

            $errordesc="Product id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productId = cleanme($_POST['product_id']);
        }

        if ( empty($productId) ){
            
            $errordesc = "Insert product id value";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $total_files_sent = count($productImages['name']);

        $error = true;
        
        for ($index = 0; $index < $total_files_sent; $index++){
             $file = [
                'name' => $productImages['name'][$index],
                'size' => $productImages['size'][$index],
                'tmp_name' => $productImages['tmp_name'][$index],
                'error' => $productImages['error'][$index]
            ];

            $image_uploaded = uploadImage($file, "products", $endpoint, $method);

            $query = 'INSERT INTO `product_images`(`product_id`, `name`) VALUES (?,?)';
            $slider_stmt = $connect->prepare($query);
            $slider_stmt->bind_param("ss", $productId ,$image_uploaded);

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

        if ( !$error ) {
            $slider_stmt->close();

            $text= "Product Images added";
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