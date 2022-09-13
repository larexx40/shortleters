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

        $active = "1";

        // Output page
        $query = "SELECT * FROM `products` WHERE status = ? AND `featured` = ? ORDER BY id DESC";
        $getAll = $connect->prepare($query);
        $getAll->bind_param("ss", $active , $active);
        $getAll->execute();
        $result = $getAll->get_result();
        $num_row = $result->num_rows;      

        if ($num_row > 0){
            $allProduct = [];

            while($row = $result->fetch_assoc()){
                $status = ($row['status'] == 1)? "Active" : "Inactive";
                if ($row['type'] == 1) {
                    $type = "Normal";
                }
        
                if ($row['type'] == 2) {
                    $type = "Special";
                }
        
                if ($row['type'] == 3) {
                    $type = "Discount";
                }
                $id = $row['productid'];
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
                $images = ( getProductImage($connect, "product_images", "product_id", $id) )? getProductImage($connect, "product_images", "product_id", $id): false;
                $image = ( $images ) ? $images[0]['image'] : null;

                array_push($allProduct, array(
                    "id"=>$id, "name"=>$name, "type_code" => $row['type'] ,"type"=>$type, 
                    "price"=>$selling_price, "qty_available"=>$qty, "category"=>$category, "sub_category"=>$sub_category, 
                    "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice, 
                    "shop"=>$shop, "brand" => $brand, 'image' => $image));
            }

            $data = array(
                'products' => $allProduct
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


