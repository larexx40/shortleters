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
        if (!checkIfShopOwner($connect, $user_pubkey) ||  !getUserWithPubKey($connect, $user_pubkey) || !checkIfShopOwner($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        
        if ( !isset($_POST['product_type'])) {

            $errordesc="Product Type required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product Type must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productType = cleanme($_POST['product_type']);
        }

        // get Type code

        if ($productType == "normal" || $productType == 1){
            $type = 1;
        }

        if ($productType == "special" || $productType == 2){
            $type = 2;
        }

        if ($productType == "discount" || $productType == 3){
            $type = 3;
        }


        // pagination and search parameters
        if (isset($_POST['search'])) {
            $search = cleanme($_POST['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        $no_per_page = 5;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            // get the total number of pages
            $query = "SELECT products.id, products.name, products.type, products.status, products.purchaseprice, products.sellingprice, products.quantityavailable, products.category_id, products.subcat_id, products.ddesc, products.special_price, products.discountquantity, products.discountprice, products.madein, products.shop_id, products.weight, products.brand_id FROM `products` LEFT JOIN productcategories ON products.category_id = productcategories.id LEFT JOIN productsub_cat ON products.subcat_id = productsub_cat.id LEFT JOIN shops ON products.shop_id = shops.id LEFT JOIN productbrand ON products.brand_id = productbrand.id WHERE products.name LIKE ? OR productcategories.name LIKE  ? OR productsub_cat.name LIKE  ? OR shops.name LIKE ? OR  productbrand.name LIKE ? OR sellingprice LIKE ? AND products.type = ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("sssssss", $searching, $searching, $searching, $searching, $searching ,$searching, $type);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT products.id, products.name, products.type, products.status, products.purchaseprice, products.sellingprice, products.quantityavailable, products.category_id, products.subcat_id, products.ddesc, products.special_price, products.discountquantity, products.discountprice, products.madein, products.shop_id, products.weight, products.brand_id FROM `products` LEFT JOIN productcategories ON products.category_id = productcategories.id LEFT JOIN productsub_cat ON products.subcat_id = productsub_cat.id LEFT JOIN shops ON products.shop_id = shops.id LEFT JOIN productbrand ON products.brand_id = productbrand.id WHERE products.name LIKE ? OR productcategories.name LIKE  ? OR productsub_cat.name LIKE  ? OR  productbrand.name LIKE ? OR shops.name LIKE ? OR  sellingprice LIKE ? AND products.type = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sssssssss", $searching, $searching, $searching, $searching, $searching ,$searching, $type, $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allProduct = [];

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

                    array_push($allProduct, array("id"=>$id, "name"=>$name, "cost"=>$cost, "type"=>$type, "status"=>$status, "price"=>$selling_price, 
                    "qty_available"=>$qty, "category"=>$category, "sub_category"=>$sub_category, "description"=>$description, 
                    "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice, "made"=>$madein, "shop"=>$shop, "weight"=>$weight, "brand" => $brand));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'products' => $allShop
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "Record not found";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

            }
        }else{
            $query = "SELECT * FROM `products` WHERE type = ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("s", $type);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT * FROM `products` WHERE type = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sss", $type, $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allProduct = [];

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

                    array_push($allProduct, array("id"=>$id, "name"=>$name, "cost"=>$cost, "type"=>$type, "status"=>$status, "price"=>$selling_price, 
                    "qty_available"=>$qty, "category"=>$category, "sub_category"=>$sub_category, "description"=>$description, 
                    "special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice, "made"=>$madein, "shop"=>$shop, "weight"=>$weight, "brand" => $brand));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'products' => $allShop
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


