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
            $sub_category_image = $_FILES['images'];
        }

        $image_uploaded = uploadImage($sub_category_image, "sub_categories", $endpoint, $method); 

        

        if ( empty($subCatName) )  {

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if (!is_numeric($Category) ){
            // Insert all fields
            $errordesc = "Invalid Category id";
            $linktosolve = 'https://';
            $hint = "Kindly pass correct value to the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if name is unique

       // check if name is unique

       $error = checkifFieldisUnique($connect, "productsub_cat" , "name"  , $subCatName);

       if ( $error ){
           $errordesc = "Sub Category ". $error;
           $linktosolve = 'https://';
           $hint = "Product name is unique";
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



        // insert the values to the shop location table 
        $query = "INSERT INTO `productsub_cat`(`cat_id`, `name`, `image`) VALUES (?, ?, ?)";
        $addSubCat = $connect->prepare($query);
        $addSubCat->bind_param("s ss", $Category, $subCatName, $image_uploaded);

        if ( $addSubCat->execute() ){
            $data = [];
            $text= "Sub category successfully added";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        // send db error
        $errordesc =  $addSubCat->error;
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