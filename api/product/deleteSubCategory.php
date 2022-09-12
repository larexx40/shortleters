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
            $errordesc =  "Only admin have acess to delete shop";
            $linktosolve = 'https://';
            $hint = "Ensure user is admin so the api can work";
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

        // Check if No product has the sub category
        if ( checkifFieldExist($connect, "products" , "subcat_id", $subCatId) ){
            $errordesc="Can Delete Sub Category, a product is under the sub category";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($errordesc,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        $query = "DELETE FROM `productsub_cat` WHERE `id` = ?";
        $deleteSubCat = $connect->prepare($query);
        $deleteSubCat->bind_param("s", $subCatId);
        $deleteSubCat->execute();
        $row_affected = $deleteSubCat->affected_rows;

        if ( $row_affected > 0 ){
            $text= "Sub Category Successfully Deleted";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }else{
            $errordesc="Sub Category not Found";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($errordesc,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        $errordesc =  $deleteSubCat->error;
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