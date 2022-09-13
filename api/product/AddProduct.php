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
        $shop_id = checkIfShopOwner($connect, $user_pubkey);
        
        // send error if ur is not in the database
        if (!$shop_id){
            // send user not found response to the user
            $errordesc =  "User not Admin";
            $linktosolve = 'https://';
            $hint = "Admin only have access to add Shop";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        

        if ( !isset($_POST['productname']) ){

            $errordesc="Product name required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product name must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productName = cleanme($_POST['productname']);
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

        if ( !isset($_POST['cost_price'])) {

            $errordesc="Cost Price required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Cost Price must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $costPrice = cleanme($_POST['cost_price']);
        }

        if ( !isset($_POST['selling_price'])) {

            $errordesc="Selling Price required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Selling Price must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $sellingPrice = cleanme($_POST['selling_price']);
        }

        if ( !isset($_POST['qty_available'])) {

            $errordesc="Product Quantity required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product Quantity must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productQty = cleanme($_POST['qty_available']);
        }

        if ( !isset($_POST['category_id'])) {

            $errordesc="Product Category required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Product Category must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productCategory = cleanme($_POST['category_id']);
        }

        if ( !isset($_POST['sub_category_id'])) {

            $errordesc="product Sub Category Phone required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product sub category must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productSubCategory = cleanme($_POST['sub_category_id']);
        }

        if ( !isset($_POST['brand_id'])) {

            $errordesc="product Brand required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product Brand must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productBrand = cleanme($_POST['brand_id']);
        }

        if ( !isset($_POST['special_price'])) {
            $specialPrice = "";
        }else{
            $specialPrice = cleanme($_POST['special_price']);
        }

        if ( !isset($_POST['discount_qty'])) {
            $discountQty = "";
        }else{
            $discountQty = cleanme($_POST['discount_qty']);
        }

        if ( !isset($_POST['discount_price'])) {
            $discountPrice = "";
        }else{
            $discountPrice = cleanme($_POST['discount_price']);
        }

        if ( !isset($_POST['made_in'])) {

            $errordesc="product maanufacturing country required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product maanufacturing country must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productMadeIn = cleanme($_POST['made_in']);
        }
        
        if ( !isset($_POST['weight'])) {

            $errordesc="product weight required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product weight must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $productWeight = cleanme($_POST['weight']);
        }

        if ( !isset($_POST['description'])) {

            $errordesc="product description required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product description must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $description = cleanme($_POST['description']);
        }

        if (!isset($_FILES['image'])){
            $errordesc = "Upload the image";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required imglink field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $img= $_FILES['image'];
        }

        if (empty($productName) || empty($productType) || empty($productMadeIn) || empty($productWeight))  {

            // Insert all fields
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        if (!is_numeric($productCategory) || !is_numeric($productQty) || !is_numeric($costPrice) || !is_numeric($sellingPrice) || !is_numeric($productSubCategory) || !is_numeric($productBrand)){
            // Insert all fields
            $errordesc = "Invalid field values";
            $linktosolve = 'https://';
            $hint = "Kindly pass correct value to the fields in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if name is unique

        $error = checkifFieldisUnique($connect, "products" , "name"  , $productName);

        if ( $error){
            $errordesc = "Product ". $error;
            $linktosolve = 'https://';
            $hint = "Product name is unique";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if category passed exist
        if (!checkifFieldExist($connect, "productcategories" , "id" , $productCategory)){
            $errordesc = "Category does not exist";
            $linktosolve = 'https://';
            $hint = "Kindly Category of the product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if sub category exist
        if (!checkifFieldExist($connect, "productsub_cat" , "id" , $productSubCategory)){
            $errordesc = "Sub Category does not exist";
            $linktosolve = 'https://';
            $hint = "Kindly Category of the product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if brand exist
        if (!checkifFieldExist($connect, "productbrand" , "id" , $productBrand)){
            $errordesc = "Brand does not exist";
            $linktosolve = 'https://';
            $hint = "Kindly Category of the product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }


        $type = "";

        if ($productType == "normal" || $productType == 1){
            if (is_numeric($discountQty) || is_numeric($discountPrice)){
                $errordesc = "Normal Product can't have discount values, kindly switch to a discount type";
                $linktosolve = 'https://';
                $hint = "Kindly pass a valid product type or type code";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
            if (is_numeric($specialPrice) || !empty($specialPrice)){
                $errordesc = "Normal Product can't have special Price, kindly switch to a special type";
                $linktosolve = 'https://';
                $hint = "Kindly pass a valid product type or type code";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
            $type = 1;
        }

        if ($productType == "special" || $productType == 2){
            if (is_numeric($discountQty) || is_numeric($discountPrice)){
                $errordesc = "Normal Product can't have discount values, kindly switch to a discount type";
                $linktosolve = 'https://';
                $hint = "Kindly pass a valid product type or type code";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
            if ( !is_numeric($specialPrice) ){
                $errordesc = "Special Product must have special Price";
                $linktosolve = 'https://';
                $hint = "Kindly pass a valid product type or type code";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }
            $type = 2;
        }

        if ($productType == "discount" || $productType == 3){
            if (!is_numeric($discountPrice) || !is_numeric($discountQty) ){
                $errordesc = "Discount Product must have discount price and discount qty";
                $linktosolve = 'https://';
                $hint = "Kindly pass a valid product type or type code";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }else{
                $type = 3;
            } 
        }

        if ($type !== 1 && $type !== 2 && $type !== 3){
            $errordesc = "Invalid Product Type";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid product type or type code";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $status = 1;
        $productid = generateUniqueKey($connect, "products", 5, "productid");

        $product_image = uploadImage($img, "products", $endpoint, $method);

        // insert the values to the shop location table 
        $query = "INSERT INTO `products`(`name`, `productid`,`type`, `status`, `purchaseprice`, `sellingprice`, `quantityavailable`, `category_id`, `subcat_id`, `ddesc`, `special_price`, `discountquantity`, `discountprice`, `madein`, `shop_id`, `weight`, `brand_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $addProduct = $connect->prepare($query);
        $addProduct->bind_param("sssssssssssssssss", $productName, $productid ,$type, $status, $costPrice, $sellingPrice, $productQty, $productCategory, $productSubCategory, $description, $specialPrice, $discountQty, $discountPrice, $productMadeIn, $shop_id, $productWeight, $productBrand);

        if ( $addProduct->execute() ){

            $img_query = "INSERT INTO `product_images`(`product_id`, `name`) VALUES (?,?)";
            $img_upload = $connect->prepare($img_query);
            $img_upload->bind_param("ss", $productid, $product_image);

            if ( $img_upload->execute() ) {
                $data = [];
                $text= "Product successfully added";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }
        }
        // send db error
        $errordesc =  $addProduct->error;
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