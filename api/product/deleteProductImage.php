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
        
        // send error if ur is not in the database
        if (!checkIfIsAdmin($connect, $user_pubkey) && !checkIfShopOwner($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Only admin nd shop have acess to delete shop";
            $linktosolve = 'https://';
            $hint = "Ensure user is admin or shop so the api can work";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }

        if ( !isset($_POST['image_name']) ){

            $errordesc="Product Image id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product Image id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $imageName = cleanme($_POST['image_name']);
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

        if ( empty($productId) || empty($imageName) ){
            
            $errordesc = "Insert product id value";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $getProduct = "SELECT * FROM `product_images` WHERE `product_id` = ? AND name = ?";
        $getProductImage = $connect->prepare($getProduct);
        $getProductImage->bind_param("ss", $productId, $imageName);
        $getProductImage->execute();
        $result = $getProductImage->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();

            $imageName = $row['name'];

            if ( unlink("../../assets/products/$imageName") ){

                $query = "DELETE FROM `product_images` WHERE `product_id` = ? AND name = ?";
                $deleteProduct = $connect->prepare($query);
                $deleteProduct->bind_param("ss", $productId, $imageName);
                $deleteProduct->execute();
                $rows_affected = $deleteProduct->affected_rows;
        
                if ( $rows_affected > 0 ){
                    $text= "Product Image Successfully Deleted";
                    $status = true;
                    $data = [];
                    $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                    respondOK($successData);
                }
        
                $errordesc =  $deleteProduct->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondInternalError($data);

            }else{
                $errordesc = "Error Deleting Image";
                $linktosolve = 'https://';
                $hint = "Kindly pass value to all the fields in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

        }else{
            $errordesc = "Product Image not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data); 
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