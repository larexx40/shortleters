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

        // Output page
        $query = "SELECT productid, ratestar FROM `productreview` WHERE ratestar >= 3 ORDER BY ratestar DESC LIMIT 5";
        $getAll = $connect->prepare($query);
       
        $getAll->execute();
        $result = $getAll->get_result();
        $num_row = $result->num_rows;     

        if ($num_row > 0){
            $reviews = [];
            while($row = $result->fetch_assoc()){
                $product_id = $row['productid'];
                $rate_star = $row['ratestar'];
                $details = ($product_id)? getProductDetails($connect, "products", "productid", $product_id) : null;
                $images = ( getProductImage($connect, "product_images", "product_id", $product_id) )? getProductImage($connect, "product_images", "product_id", $product_id): false;
                
                array_push($reviews, array(
                    'product_id' => $product_id,
                    'star' => $rate_star,
                    'details' => $details,
                    'image' => ($images)? $images[0]['image'] : null
                ));
            }
            $final_obje = unique_multi_array($reviews, "product_id");


            $data = array(
                'products' => $final_obje
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
            respondOK($data);

        }

        
            

            
    }else{

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);
    }


    

?>


