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

    if ($method == 'GET') {
        // if (isset($_GET['sort'])) {
        //     $sort = cleanme($_GET['sort']); //sort if > 0
        // } else {
        //     $sort = "";
        // }
        // //sort with days
        // if (isset($_GET['sortDays'] ) && is_numeric($_GET['sortDays']) ) {//draft =1 or 0
        //     $days =$_GET['sortDays'] ;
        // } else {
        //     $days = '';
        // }
        // //AND DATE(blog.created_at) >= (DATE(NOW()) - INTERVAL ? DAY)
        // if($sort > 0){
            //sort with date
            //SELECT productorders.product_id, COUNT(productorders.product_id) AS `noOfOccurrence` FROM `productorders` LEFT JOIN productcart ON productorders.order_refno = productcart.orderref_number WHERE FROM_UNIXTIME(productcart.ordertime) >=(DATE(NOW()) - INTERVAL 30 DAY) GROUP BY `product_id` ORDER BY noOfOccurrence DESC LIMIT 5;
        // }else{

        // }
        
        $sqlQuery = "SELECT
                        productorders.product_id,
                        COUNT(productorders.product_id) AS `noOfOccurrence`,
                        products.productid,
                        products.name,
                        products.type,
                        products.status,
                        products.purchaseprice,
                        products.sellingprice,
                        products.quantityavailable,
                        products.category_id,
                        products.subcat_id,
                        products.ddesc,
                        products.special_price,
                        products.discountquantity,
                        products.discountprice,
                        products.madein,
                        products.shop_id,
                        products.weight,
                        products.brand_id,
                        products.subcat_id
                    FROM   `productorders`
                    LEFT JOIN products ON productorders.product_id = products.id                                                                       GROUP BY 
                        `product_id`
                    ORDER BY
                        noOfOccurrence                                                                                                                 DESC                      
                        LIMIT 5";
        $stmt = $connect->prepare($sqlQuery);
        $stmt->execute();  
        $result = $stmt->get_result();
        $numRow = $result->num_rows;

         //check for db error || connection lost
         if(!$stmt->execute()){
            //DB error || invalid input
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Database comection error";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }

        if($numRow > 0){
            $stmt->close();
            $allProduct = [];
            while($row = $result->fetch_assoc()){
                $id = $row['productid'];
                $noOfOcurrence= $row['noOfOccurrence'];
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

                array_push($allProduct, array("id"=>$id, "noOfOcurrence"=>$noOfOcurrence, "name"=>$name, "cost"=>$cost,"price"=>$selling_price, 
                "qty_available"=>$qty, "category"=>$category, "sub_category"=>$sub_category, "description"=>$description, 
                "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice, "made"=>$madein, "shop"=>$shop, "weight"=>$weight, "brand" => $brand, 'images' => $images));
            }
            $maindata = [
                'topOrders'=> $allProduct
            ];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $method = getenv('REQUEST_METHOD');
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //not found
            $errordesc="Record not found";
            $linktosolve="htps://";
            $hint=["pass in valid id"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="data with id not found";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
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