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

         // Check if status is passed;
         if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort result by status if > 0
        } else {
            $sort = "";
        }
    
        if (isset($_GET['sortstatus'])) {
            $status = cleanme($_GET['sortstatus']); //sort result by status if > 0
        } else {
            $status = "";
        }

        if (isset($_GET['sorttype'])) {
            $type = cleanme($_GET['sorttype']); //sort result by status if > 0
        } else {
            $type = "";
        }
        if (!isset($_GET['per_page'])){
            $no_per_page = 8;
        }else{
            $no_per_page = cleanme($_GET['per_page']);
        }
        
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";

            if ($sort > 0){
                if ( is_numeric($status) && is_numeric($type) ){
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
                    products.status = ? AND products.type = ? AND (
                            products.name LIKE ? OR productcategories.name LIKE ? OR productsub_cat.name LIKE ? OR products.madein LIKE ? OR productbrand.name LIKE ? OR sellingprice LIKE ?
                        ) ";
                    $getSearchPages = $connect->prepare($query);
                    $getSearchPages->bind_param("ssssssss", $status, $type ,$searching, $searching, $searching, $searching, $searching, $searching);
                    $getSearchPages->execute();
                    $result = $getSearchPages->get_result();
                    $total_num_row = $result->num_rows;
                    $totalPage = ceil($total_num_row / $no_per_page);  

                    // Output page
                    $limit_query = $query. "LIMIT ?, ?";
                    $getAll = $connect->prepare($limit_query);
                    $getAll->bind_param("ssssssssss", $status, $type , $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                }
                if ( is_numeric($status) && !is_numeric($type) ){
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
                         ) ";
                     $getSearchPages = $connect->prepare($query);
                     $getSearchPages->bind_param("sssssss", $status ,$searching, $searching, $searching, $searching, $searching, $searching);
                     $getSearchPages->execute();
                     $result = $getSearchPages->get_result();
                     $total_num_row = $result->num_rows;
                     $totalPage = ceil($total_num_row / $no_per_page);  
 
                     // Output page
                     $limit_query = $query. "LIMIT ?, ?";
                     $getAll = $connect->prepare($limit_query);
                     $getAll->bind_param("sssssssss", $status, $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                     $getAll->execute();
                     $result = $getAll->get_result();
                     $num_row = $result->num_rows;
                }
                if ( !is_numeric($status) && is_numeric($type) ){
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
                     products.type = ? AND (
                             products.name LIKE ? OR productcategories.name LIKE ? OR productsub_cat.name LIKE ? OR products.madein LIKE ? OR productbrand.name LIKE ? OR sellingprice LIKE ?
                         ) ";
                     $getSearchPages = $connect->prepare($query);
                     $getSearchPages->bind_param("sssssss", $type ,$searching, $searching, $searching, $searching, $searching, $searching);
                     $getSearchPages->execute();
                     $result = $getSearchPages->get_result();
                     $total_num_row = $result->num_rows;
                     $totalPage = ceil($total_num_row / $no_per_page);  
 
                     // Output page
                     $limit_query = $query. "LIMIT ?, ?";
                     $getAll = $connect->prepare($limit_query);
                     $getAll->bind_param("sssssssss", $type , $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                     $getAll->execute();
                     $result = $getAll->get_result();
                     $num_row = $result->num_rows;
                }
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
                        (
                            products.name LIKE ? OR productcategories.name LIKE ? OR productsub_cat.name LIKE ? OR products.madein LIKE ? OR productbrand.name LIKE ? OR sellingprice LIKE ?
                        )";
                    $getSearchPages = $connect->prepare($query);
                    $getSearchPages->bind_param("ssssss", $searching, $searching, $searching, $searching, $searching, $searching);
                    $getSearchPages->execute();
                    $result = $getSearchPages->get_result();
                    $total_num_row = $result->num_rows;
                    $totalPage = ceil($total_num_row / $no_per_page);  

                    // Output page
                    $limit_query = $query. "LIMIT ?, ?";
                    $getAll = $connect->prepare($limit_query);
                    $getAll->bind_param("ssssssss", $searching, $searching, $searching, $searching, $searching, $searching, $offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
            }

        }else{
            if ($sort > 0){
                if (is_numeric($status) && is_numeric($type)){
                    $query = "SELECT * FROM `products` WHERE status = ? AND type = ?";
                    $getSearchPages = $connect->prepare($query);
                    $getSearchPages->bind_param("ss", $status, $type);
                    $getSearchPages->execute();
                    $result = $getSearchPages->get_result();
                    $total_num_row = $result->num_rows;
                    $totalPage = ceil($total_num_row / $no_per_page); 

                    // Output page
                    $query = "SELECT * FROM `products` WHERE status = ? AND type = ? LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("ssss",  $status, $type ,$offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                }
                if (is_numeric($status) && !is_numeric($type)){
                    $query = "SELECT * FROM `products` WHERE status = ?";
                    $getSearchPages = $connect->prepare($query);
                    $getSearchPages->bind_param("s", $status);
                    $getSearchPages->execute();
                    $result = $getSearchPages->get_result();
                    $total_num_row = $result->num_rows;
                    $totalPage = ceil($total_num_row / $no_per_page); 

                    // Output page
                    $query = "SELECT * FROM `products` WHERE status = ? LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("sss",  $status ,$offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                }
                if (!is_numeric($status) && is_numeric($type)){
                    $query = "SELECT * FROM `products` WHERE type = ?";
                    $getSearchPages = $connect->prepare($query);
                    $getSearchPages->bind_param("s", $type);
                    $getSearchPages->execute();
                    $result = $getSearchPages->get_result();
                    $total_num_row = $result->num_rows;
                    $totalPage = ceil($total_num_row / $no_per_page); 

                    // Output page
                    $query = "SELECT * FROM `products` WHERE type = ? LIMIT ?, ?";
                    $getAll = $connect->prepare($query);
                    $getAll->bind_param("sss", $type ,$offset, $no_per_page);
                    $getAll->execute();
                    $result = $getAll->get_result();
                    $num_row = $result->num_rows;
                }

            }else{
                $query = "SELECT * FROM `products`";
                $getSearchPages = $connect->prepare($query);
                $getSearchPages->execute();
                $result = $getSearchPages->get_result();
                $total_num_row = $result->num_rows;
                $totalPage = ceil($total_num_row / $no_per_page); 

                // Output page
                $query = "SELECT * FROM `products` LIMIT ?, ?";
                $getAll = $connect->prepare($query);
                $getAll->bind_param("ss", $offset, $no_per_page);
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
                $featured = $row['featured'];
                $brand=  getNameFromField($connect, "productbrand" , "id" , $row['brand_id']);
                $images = ( getProductImage($connect, "product_images", "product_id", $id) )? getProductImage($connect, "product_images", "product_id", $id): false;

                array_push($allProduct, array("id"=>$id, "name"=>$name, "cost"=>$cost, "type_code" => $row['type'] ,"type"=>$type, "status"=>$status,"status_code" => $row['status'] ,"price"=>$selling_price, 
                "qty_available"=>$qty, "category"=>$category, "sub_category"=>$sub_category, "description"=>$description, 
                "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice, "made"=>$madein, "shop"=>$shop, "weight"=>$weight, "brand" => $brand, 'images' => $images, 'featured' => $featured));
            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $totalPage,
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


