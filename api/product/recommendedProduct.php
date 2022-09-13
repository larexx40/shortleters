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
        // get last 100 product ordered for a particular category
        $limit = 100;
        $query = "SELECT productorders.product_id  FROM productorders LEFT JOIN products ON productorders.product_id = products.productid WHERE products.category_id = ?  ORDER BY productorders.id DESC LIMIT ?";
        $getCategories = $connect->prepare($query);
        $getCategories->bind_param("ss",$categoryid, $limit);
        $getCategories->execute();
        $result = $getCategories->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $getCategories->close();

            $productids=[];
            while($row = $result->fetch_assoc()){   
                $productid = $row['product_id'];
                array_push( $productids, ($productid ));
            }
            //count and sort the categoryid and pick the first 4 with highest noOfOccurrence
            $countProductids = array_count_values($productids);
            arsort($countProductids);
            //get keys(category id) from array count category
            $productids = array_keys($countProductids);

            //loop through the categoryids to get datails of the top 4 category
            $products =[];
            for($i = 0; $i < 2; $i ++){
                //get category details
                $productDetails = getActiveProduct($connect,$productids[$i] );
                array_push($products, $productDetails);  
            }

            $data = [
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