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
        if (!checkIfIsAdmin($connect, $user_pubkey) ){
            // send user not found response to the user
            $errordesc =  "User not Admin";
            $linktosolve = 'https://';
            $hint = "Admin only have access to add Shop";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        if ( !isset($_POST['sub_cat_id']) ){

            $errordesc="Sub Category id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Sub Category id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $subCatId = cleanme($_POST['sub_cat_id']);
        }

        if ( !isset($_POST['category_id']) ){

            $errordesc="Category id is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Category must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $Category = cleanme($_POST['category_id']);
        }

        if ( !isset($_POST['sub_cat_name'])) {

            $errordesc="Sub Category Name required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Sub Category Name must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $subCatName = cleanme($_POST['sub_cat_name']);
        }

        if ( !isset($_FILES['image']) ){

            if ( !isset($_POST['image']) ){

                $errordesc="Product Images required";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Product images must be sent";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);

            }else{
                $sub_category_image = $_FILES['image'];
            }

        }else{
            $sub_category_image = $_FILES['image'];
        }

        

        if ( empty($subCatName) )  {

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if (!is_numeric($Category) || !is_numeric($subCatId) ){
            // Insert all fields
            $errordesc = "Invalid field values";
            $linktosolve = 'https://';
            $hint = "Kindly pass correct value to the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

         // Check if product sub_cat_id exist in the db
         if ( !checkIfExist($connect, "productsub_cat", "id", $subCatId) ){
            $errordesc = "Sub Category not found";
            $linktosolve = 'https://';
            $hint = "Kindly procide Sub Category that is valid";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if category passed exist
        if (!checkifFieldExist($connect, "productcategories" , "id" , $Category)){
            $errordesc = "Category does not exist";
            $linktosolve = 'https://';
            $hint = "Kindly Category of the product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if name is unique

        $query = "SELECT * FROM productsub_cat WHERE name = ? AND id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $subCatName, $subCatId );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row < 1){
            $error = checkifFieldisUnique($connect, "productsub_cat" , "name"  , $subCatName);

            if ( $error){
                $errordesc = "Sub Category". $error;
                $linktosolve = 'https://';
                $hint = "Product name is unique";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
        }

        if (is_array($sub_category_image)){
            $image = uploadImage($sub_category_image, "sub_categories", $endpoint, $method);
        }else{
            $image = $sub_category_image;
        }
    

        // update  
        $query = "UPDATE `productsub_cat` SET `cat_id`= ?,`name`= ?, `image` = ? WHERE `id` = ?";
        $updateSubCat = $connect->prepare($query);
        $updateSubCat->bind_param("ssss", $Category, $subCatName, $image ,$subCatId);

        if ( $updateSubCat->execute() ){
            $data = [];
            $text= "Sub category successfully updated";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $updateSubCat->error;
        $linktosolve = 'https://';
        $hint = "500 code internal error, check ur database connections";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondInternalError($data);

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