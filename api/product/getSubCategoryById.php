<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    // check if the right request was sent
    if ($method == 'GET') {
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

        // check if user is admin
        if (!checkIfIsAdmin($connect, $user_pubkey) && !getUserWithPubKey($connect, $user_pubkey) && !checkIfShopOwner($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // pass id and validate
        if ( !isset($_GET['sub_cat_id']) ){
            $errordesc="id of sub category must be passed";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $method;
            $data=returnErrorArray($errordesc,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $subCatID = cleanme($_GET['sub_cat_id']);
        }

        if ( !is_numeric( $subCatID ) ){
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Kindly pass a valid shop id";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
            // Output page
            $query = "SELECT * FROM `productsub_cat` where id = ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("s", $subCatID);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
               
                while($row = $result->fetch_assoc()){
                    
                    $id = $row['id'];
                    $name = $row['name'];
                    $category = getNameFromField($connect, "productcategories" , "id" , $row['cat_id'] );
                    $created = ( $row['created_at'] ) ? date("H:i:s", strtotime($row['created_at'])) : "" ; 
                    $updated = ( $row['updated_at'] ) ? date("H:i:s", strtotime($row['updated_at'])) : "";

                    $sub_cat = array("id"=>$id, "name"=>$name,  
                    "category"=>$category, "created_at"=>$created, 
                    "updated_at"=>$updated );
                }

                $data = array(
                    'sub_cat' => $sub_cat
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "No records";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

            }
    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
    }

?>