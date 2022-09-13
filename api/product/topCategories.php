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
        //no of top category to return
        if (isset($_GET['noOfCategory']) && $_GET['noOfCategory']) {
            $noOfCategory = cleanme($_GET['noOfCategory']);
        } else {
            $noOfCategory = 4;
        }
        // get last 100 product ordered
        $limit = 100;
        $query = "SELECT productorders.product_id, products.category_id FROM  `productorders` LEFT JOIN products ON products.productid = productorders.product_id ORDER BY productorders.id DESC LIMIT ? ";
        $getCategories = $connect->prepare($query);
        $getCategories->bind_param("s", $limit);
        $getCategories->execute();
        $result = $getCategories->get_result();
        $num_row = $result->num_rows;
        
        

        if ($num_row > 0){
            $getCategories->close();

            $orders=[];
            while($row = $result->fetch_assoc()){   
                $categoryid = $row['category_id'];
                array_push( $orders, ($categoryid));
            }
            //count and sort the categoryid and pick the first 4 with highest noOfOccurrence
            $countCategory = array_count_values($orders);
            arsort($countCategory);
            //get keys(category id) from array count category
            $categoryids = array_keys($countCategory);

            //loop through the categoryids to get datails of the top 4 category
            $categories =[];
            for($i = 0; $i < $noOfCategory; $i ++){
                //get category details
                if($i<count($categoryids)){
                    $result= getCategory($connect, $categoryids[$i]);
                    array_push($categories, $result);
                }
            }

            $products = [];
            for($i = 0; $i < count($categories); $i ++){
                //get category details
                $cat_products = getAllProductDetails($connect, "products", "category_id", $categories[$i]->id);
                for($j = 0; $j < count($cat_products); $j++){
                    array_push($products, $cat_products[$j]);
                }

                
            }

            $firstCategoryName= getNameFromField($connect, 'productcategories', 'id', $categoryids[0]);

            $data = [
                'firstCategoryid'=>$categoryids[0],
                'firstCategoryName'=>$firstCategoryName,
                'noOfCategory'=>$noOfCategory,
                'topCategory' => $categories,
                'products' => $products
            ];
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