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
        if (isset($_GET['noOfProduct']) && is_numeric($_GET['noOfProduct'])) {
            $noOfProduct = cleanme($_GET['noOfProduct']);
        } else {
            $noOfProduct = 4;
        }
        //(by month) SELECT productcart.created_at, productorders.product_id FROM `productorders` LEFT JOIN productcart on productcart.orderref_number = productorders.order_refno WHERE MONTH(created_at) = MONTH(now()) AND YEAR(created_at) = YEAR (now())
        // get last 100 product ordered
        $limit = 100;
        $query = "SELECT productorders.product_id FROM  `productorders` ORDER BY productorders.id DESC LIMIT ? ";
        $getProductid = $connect->prepare($query);
        $getProductid->bind_param("s", $limit);
        $getProductid->execute();
        $result = $getProductid->get_result();
        $num_row = $result->num_rows;        

        if ($num_row > 0){
            $getProductid->close();

            $orders=[];
            while($row = $result->fetch_assoc()){   
                $productid = $row['product_id'];
                array_push( $orders, ($productid ));
            }
            //count and sort the productid and pick the first 4 with highest noOfOccurrence
            $countProduct = array_count_values($orders);
            arsort($countProduct);
            
            //get keys(category id) from array count category
            $productids = array_keys($countProduct);

            //loop through the categoryids to get datails of the top 4 category
            $products =[];
            for($i = 0; $i < $noOfProduct; $i ++){
                //get category details
                if($i < count($productids)){
                    $result= getproduct($connect, $productids[$i]);
                    array_push($products, $result);
                }
            }

            $noOfProduct = count($productids);
            $data = [
                'noOfProduct'=>$noOfProduct,
                'topProduct' => $products
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