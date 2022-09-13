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

        // pagination and search parameters
        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }

        if (!isset($_GET['per_page'])){
            $no_per_page = 8;
        }else{
            $no_per_page = cleanme($_GET['per_page']);
        }
        
        if ($no_per_page != "all"){
            $offset = ($page_no - 1) * $no_per_page;
        }

        $active = "1";

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";

            if ( $no_per_page == "all" ){
                // get the total number of pages
                $query = "SELECT
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
                    products.brand_id
                FROM
                    `products`
                LEFT JOIN productcategories ON products.category_id = productcategories.id
                LEFT JOIN productsub_cat ON products.subcat_id = productsub_cat.id
                LEFT JOIN shops ON products.shop_id = shops.id
                LEFT JOIN productbrand ON products.brand_id = productbrand.id
                WHERE
                    products.status = ? AND (
                        products.name LIKE ? OR productcategories.name LIKE ? OR productsub_cat.name LIKE ? OR products.madein LIKE ? OR productbrand.name LIKE ? OR sellingprice LIKE ?
                    )";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("sssssss", $active ,$searching, $searching, $searching, $searching, $searching, $searching);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $num_row = $result->num_rows;
            }else{
                // get the total number of pages
                $query = "SELECT
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
                    products.brand_id
                FROM
                    `products`
                LEFT JOIN productcategories ON products.category_id = productcategories.id
                LEFT JOIN productsub_cat ON products.subcat_id = productsub_cat.id
                LEFT JOIN shops ON products.shop_id = shops.id
                LEFT JOIN productbrand ON products.brand_id = productbrand.id
                WHERE
                    products.status = ? AND (
                        products.name LIKE ? OR productcategories.name LIKE ? OR productsub_cat.name LIKE ? OR products.madein LIKE ? OR productbrand.name LIKE ? OR sellingprice LIKE ?
                    )";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("sssssss", $active ,$searching, $searching, $searching, $searching, $searching, $searching);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page);  

                // Output page
                $limit_query = $query. " ORDER BY products.id DESC LIMIT ?, ?";
                $getAll = $connect->prepare($limit_query);
                $getAll->bind_param("sssssssss", $active ,$searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;

            }                

        }else{

            if ( $no_per_page == "all" ){
                $query = "SELECT * FROM `products` WHERE status = ?";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("s", $active);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $num_row = $result->num_rows;

            }else{
                $query = "SELECT * FROM `products` WHERE status = ?";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->bind_param("s", $active);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page); 

                // Output page
                $query = "SELECT * FROM `products` WHERE status = ? ORDER BY id DESC LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("sss", $active ,$offset, $no_per_page);
                $getAll->execute();
                $result = $getAll->get_result();
                $num_row = $result->num_rows;
            }      
        }

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
                $review = (getAverageProductReview($connect, $id)) ? getAverageProductReview($connect, $id) : false;
                $brand=  getNameFromField($connect, "productbrand" , "id" , $row['brand_id']);
                $images = ( getProductImage($connect, "product_images", "product_id", $id) )? getProductImage($connect, "product_images", "product_id", $id): false;

                array_push($allProduct, array("id"=>$id, "name"=>$name, "cost"=>$cost, "type_code" => $row['type'] ,"type"=>$type, "status"=>$status,"status_code" => $row['status'] ,"price"=>$selling_price, 
                "qty_available"=>$qty, "cat_id" => $row['category_id'],"category"=>$category, "sub_category"=>$sub_category, "description"=>$description, 
                "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice,'review' => $review, "made"=>$madein, "shop"=>$shop, "weight"=>$weight, "brand" => $brand, 'images' => $images));
            }

            if ($no_per_page == "all"){
                $data = array(
                    'products' => $allProduct
                );
            }else{
                $data = array(
                    'page' => $page_no, 
                    'per_page' => $no_per_page,
                    'total_data' => $total_num_row,
                    'totalPage' => $totalPage,
                    'products' => $allProduct
                );
            }
            
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


