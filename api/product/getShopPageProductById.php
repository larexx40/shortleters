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

        // $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        // $user_pubkey = $decodedToken->usertoken;

        // // check if user is admin
        // if (!checkIfIsAdmin($connect, $user_pubkey) && !getUserWithPubKey($connect, $user_pubkey) && !checkIfShopOwner($connect, $user_pubkey)){
        //     // send user not found response to the user
        //     $errordesc =  "Not Authorized";
        //     $linktosolve = 'https://';
        //     $hint = "Only authorized users can access this endpoint";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        //     respondBadRequest($data);
        // }

        // pass id and validate
        if ( !isset($_GET['product_id']) ){
            $errordesc="id of product is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="id of product must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $productID = cleanme($_GET['product_id']);
        }

            // Output page
            $query = "SELECT * FROM `products` where productid = ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("s", $productID);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){

                while($row = $result->fetch_assoc()){
                    $status = ($row['status'] == 1)? "active" : "inactive";
                    if ($row['type'] == 1) {
                        $type = "normal";
                    }
            
                    if ($row['type'] == 2) {
                        $type = "special";
                    }
            
                    if ($row['type'] == 3) {
                        $type = "discount";
                    }
                    $id = $row['id'];
                    $product_id = $row['productid'];
                    $name = $row['name'];
                    $cost = $row['purchaseprice'];
                    $selling_price = $row['sellingprice'];
                    $qty = $row['quantityavailable'];
                    $category = getNameFromField($connect, "productcategories" , "id" , $row['category_id']);
                    $sub_category = getNameFromField($connect, "productsub_cat" , "id" , $row['subcat_id']);
                    $description = $row['ddesc']; 
                    $specialPrice = $row['special_price'];
                    $discountQty = $row['discountquantity'];
                    $discountPrice = $row['discountprice'];
                    $madein = $row['madein'];
                    $shop = getNameFromField($connect, "shops" , "id" , $row['shop_id']);
                    $weight = $row['weight'];
                    $brand=  getNameFromField($connect, "productbrand" , "id" , $row['brand_id']);
                    $related_products = (getRelatedProducts($connect, "brand_id", $row['brand_id']))? getRelatedProducts($connect, "brand_id", $row['brand_id']): null;
                    $images = ( getProductImage($connect, "product_images", "product_id", $product_id) )? getProductImage($connect, "product_images", "product_id", $product_id): false;
                    $review = (getAverageProductReview($connect, $product_id)) ? getAverageProductReview($connect, $product_id) : false;
                    $reviews = ($review) ? getreviews($connect, $product_id) : null;
                    $brand_image = ( getBrandImage($connect, $row['brand_id'] ) )? getBrandImage($connect, $row['brand_id']) : false;

                    if ($related_products){
                       for ($i=0; $i < count($related_products); $i++){
                            if ($related_products[$i]['product_id'] == $product_id){
                                array_splice($related_products, $i, 1);
                            }
                       }
                    }

                    $product = array("id"=>$id, "product_id" => $product_id ,"name"=>$name, "cost"=>$cost, 'type_code' => $row['type'] ,"type"=>$type, "status"=>$status, "price"=>$selling_price, 
                    "qty_available"=>$qty, "category"=>$category, "sub_category"=>$sub_category, "description"=>$description, 
                    "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice, "made"=>$madein, "shop"=>$shop, "weight"=>$weight, "brand" => $brand,
                    'brand_image' => $brand_image, 'brand_id' => $row['brand_id'] ,'images' => $images, 'related' => $related_products ,'review' => $review, "reviewDetails"=>$reviews);
                }

                $data = array(
                    'product' => $product
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