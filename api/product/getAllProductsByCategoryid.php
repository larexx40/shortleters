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
        //no need to register  
        
        //pass in categoryid
        if ( !isset($_GET['categoryid']) ){
            $errordesc="Category id is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Category id must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $categoryid = cleanme($_GET['categoryid']);
        }

        // pagination and search parameters
        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }
    
        if (isset($_GET['sortstatus'])) {
            $status = cleanme($_GET['sortstatus']); //sort result by status if > 0
        } else {
            $status = 1;
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 6;  
        }

        $offset = ($page_no - 1) * $no_per_page;

        //get active product by categoryid
        $query = "SELECT
                products.productid,
                products.name,
                products.type,
                products.status,
                products.purchaseprice,
                products.sellingprice,
                products.quantityavailable,
                products.special_price,
                products.discountquantity,
                products.discountprice,
                products.brand_id, products.subcat_id, products.category_id
            FROM
                `products`
            WHERE products.category_id = ? AND products.status = ? ";
        $getSearchPages = $connect->prepare($query);
        $getSearchPages->bind_param("ss", $categoryid, $status);
        $getSearchPages->execute();
        $result = $getSearchPages->get_result();
        $total_num_row = $result->num_rows;
        $total_pg_found =  ceil($total_num_row / $no_per_page);  

        // Output page
        $query = "$query LIMIT ?, ?";
        $getAll = $connect->prepare($query);
        $getAll->bind_param("ssss",$categoryid, $status, $offset, $no_per_page);
        $getAll->execute();
        $result = $getAll->get_result();
        $num_row = $result->num_rows;  

        if ($num_row > 0){
            $allProduct = [];
            $categoryName = getNameFromField($connect, "productcategories" , "id" , $categoryid);
            $categoryImage = getCategoryImage($connect, "id", $categoryid);

            while($row = $result->fetch_assoc()){
                $status = ($row['status'] == 1)? "Active" : "Inactive";
                if ($row['type'] == 1) {
                    $type = "normal";

                }
        
                if ($row['type'] == 2) {
                    $type = "special";
                }
        
                if ($row['type'] == 3) {
                    $type = "discount";
                }
                $id = $row['productid'];
                $name = $row['name'];
                $cost = $row['purchaseprice'];
                $selling_price = $row['sellingprice'];
                $qty = $row['quantityavailable'];               
                $discountPrice = ($row['discountprice'] == 0 )? "" : $row['discountprice'];
                $images = getProductImage($connect, "product_images", "product_id", $id);
                $productImage = ($images)? $images[0]['image'] : null;
                $brand=  getNameFromField($connect, "productbrand" , "id" , $row['brand_id']);
                $getSubCategoryName = getNameFromField($connect, "productsub_cat" , "id" , $row['subcat_id']);  
                $subCategoryName = ($getSubCategoryName)? $getSubCategoryName: $categoryName;

                array_push($allProduct, array("id"=>$id, "name"=>$name, "cost"=>$cost, "type_code" => $row['type'] ,"type"=>$type, "status"=>$status, "status_code" => $row['status'] ,"price"=>$selling_price, 
                "qty_available"=>$qty, "brand" => $brand, "subcategoryName"=>$subCategoryName,
               'brand_code' => $row['brand_id'],'productImage' => $productImage));
                //"special_price"=>$specialPrice , "discount_qty"=>$discountQty , "discount_price"=>$discountPrice,
            }

            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'products' => [
                    'category_name' => $categoryName,
                    'image' => $categoryImage,
                    'items' => $allProduct
                ]
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
            respondOk($data);

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


