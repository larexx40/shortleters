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
        if (!checkIfShopOwner($connect, $user_pubkey) && !getUserWithPubKey($connect, $user_pubkey) && !checkIfIsAdmin($connect, $user_pubkey)){
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
        
        if (!isset ($_GET['noPerPage']) ) {  
            $no_per_page = 4;
        } else {  
            $no_per_page = $_GET['noPerPage'];  
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            // get the total number of pages
            $query = "SELECT productsub_cat.id, productsub_cat.cat_id, productsub_cat.name, productsub_cat.created_at, productsub_cat.updated_at FROM `productsub_cat`LEFT JOIN productcategories ON productsub_cat.cat_id = productcategories.id WHERE productcategories.name LIKE ? OR productsub_cat.name LIKE ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("ss", $searching, $searching);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow /  $no_per_page);  

            // Output page
            $query = "SELECT productsub_cat.id, productsub_cat.cat_id, productsub_cat.name, productsub_cat.created_at, productsub_cat.updated_at FROM `productsub_cat`LEFT JOIN productcategories ON productsub_cat.cat_id = productcategories.id WHERE productcategories.name LIKE ? OR productsub_cat.name LIKE ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("ssss", $searching, $searching, $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            
        }else{
            $query = "SELECT * FROM `productsub_cat`";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow /  $no_per_page); 

            // Output page
            $query = "SELECT * FROM `productsub_cat` LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("ss", $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            
        }
        
        if ($num_row > 0){
            $allSubCat = [];

            while($row = $result->fetch_assoc()){
                
                $id = $row['id'];
                $name = $row['name'];
                $category = getNameFromField($connect, "productcategories" , "id" , $row['cat_id']);
                $num_of_products = checkifFieldExist($connect, "products", "subcat_id", $id);
                $created = ($row['created_at'])?  gettheTimeAndDate(strtotime($row['created_at'])): ""; 
                $updated = ($row['updated_at'])?  gettheTimeAndDate(strtotime($row['updated_at'])) : "";

                array_push($allSubCat, array("id"=>$id, "name"=>$name, 'image' => $row['image'] ,'num_of_products' => $num_of_products, 'cat_id' => $row['cat_id'],  
                "category"=>$category, "created_at"=>$created, 
                "updated_at"=>$updated ));
            }

            $data = array(
                'page' => $page_no,
                'per_page' =>  $no_per_page,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'sub_categories' => $allSubCat
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

        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
    }


?>


