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
        // pass id and validate
        if ( !isset($_GET['cat_id']) ){
            $errordesc="id of sub category must be passed";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $method;
            $data=returnErrorArray($errordesc,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $CatID = cleanme($_GET['cat_id']);
        }

        if ( !is_numeric( $CatID ) ){
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
            $query = "SELECT * FROM `productsub_cat` where cat_id = ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("s", $CatID);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){

                $all_sub_cat = [];
                while($row = $result->fetch_assoc()){
                    
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = ($row['image']) ? $row['image']: null;
                    
                    $category = getNameFromField($connect, "productcategories" , "id" , $row['cat_id'] );

                    array_push( $all_sub_cat ,array("id"=>$id, "name"=>$name, "image"=>$image,  "category"=>$category));
                }

                $data = array(
                    "categoryName"=>$category,
                    'subCategory' => $all_sub_cat
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