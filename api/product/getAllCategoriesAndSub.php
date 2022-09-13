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
    
        if (isset ($_GET['page']) ) { 
            if(!empty($_GET['page']) && is_numeric($_GET['page']) ){
                $page_no = $_GET['page']; 
            }else{
                $page_no = 1;
            }
        } else {  
            $page_no = 1;  
        }

        if (isset ($_GET['noPerPage']) ) {  
            if(!empty($_GET['noPerPage']) && is_numeric($_GET['noPerPage']) ){
                $noPerPage = $_GET['noPerPage']; 
            }else{
                $noPerPage =4;
            }
        } else {  
            $noPerPage =7;  
        }
        
        $offset = ($page_no - 1) * $noPerPage;

        if (!empty($search) && $search!="" && $search!=' '){
            //search productCategory from database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT * FROM `productcategories` WHERE `name` like ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "SELECT * FROM `productcategories` WHERE `name` like ? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sss", $searchParam, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $num_row = $result->num_rows;  
        }else {
            //get all data
            $sqlQuery = "SELECT * FROM `productcategories` ORDER BY id DESC";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            $sqlQuery = "SELECT * FROM `productcategories` ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("ss", $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $num_row = $result->num_rows;
        }

        // $query = "SELECT * FROM `productcategories`";
        // $query_statement = $connect->prepare($query);
        // $query_statement->execute();
        // $result = $query_statement->get_result();
        // $num_row = $result->num_rows;

        
        if ($num_row > 0){
            $allCategory = [];

            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $category_name = $row['name'];
                $description = ($row['description'])? $row['description'] : null;
                $image = ($row['category_image'])? $row['category_image'] : null;
                $no_of_products = ( checkifFieldExist($connect, "products", "category_id", $id) ) ? checkifFieldExist($connect, "products", "category_id", $id) : 0;
                $sub_cats = (getSubcategory($connect, $id))? getSubcategory($connect, $id) : false;

                array_push($allCategory, [
                    'id' => $id,
                    'description' => $description,
                    'image' => $image,
                    'category' => $category_name,
                    'no_of_products' => $no_of_products,
                    'sub_categories' => $sub_cats
                ]);
            }

            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'categories'=> $allCategory
            ];
            $hint = [];
            $errordata = [];
            $text= "Fetch Successful";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            //$successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($data);
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


