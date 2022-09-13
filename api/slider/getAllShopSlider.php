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
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            if ($sort > 0){
               
                // get the total number of pages
                $query = "SELECT * FROM `slider` WHERE type = ? AND ( name LIKE ? OR imglink LIKE ? OR shortdesc LIKE ? ) ";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssss", $status, $searching, $searching, $searching );
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;
                $total_pg_found =  ceil($num_row / $no_per_page);

                $query = "SELECT * FROM `slider` WHERE type = ? AND( name LIKE ? OR imglink LIKE ? OR shortdesc LIKE ? ) LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("ssssss", $status, $searching, $searching, $searching , $offset, $no_per_page);
                $queryStmt->execute();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 
            }else{
                // get the total number of pages
                $query = "SELECT * FROM `slider` WHERE name LIKE ? OR imglink LIKE ? OR shortdesc LIKE ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $searching, $searching, $searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "SELECT * FROM `slider` WHERE name LIKE ? OR imglink LIKE ? OR shortdesc LIKE ? LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssss", $searching, $searching, $searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }            

        }else{

            if ($sort > 0){
                // Get total number of complains in the system
                $query = "SELECT * FROM `slider` WHERE `type` = ?";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->bind_param("s", $status);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "SELECT * FROM `slider` WHERE `type` = ? LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("sss", $status ,$offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
            }else{
                // Get total number of complains in the system
                $query = "SELECT * FROM `slider`";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "SELECT * FROM `slider` LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("ss", $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
                
            }
            

        }

        if ($num_row > 0){
            $allSlider = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $type_code = $row['type'];
                $type = ($row['type'] == 1) ? "Web" : "Mobile App";
                $img_link = $row['imglink'];
                $product_id = ($row['slider_product']) ? $row['slider_product'] : null ;
                $product_name = ($row['slider_product']) ? getNameFromField($connect, "products", "productid", $product_id) : null;
                $slider_image = ($product_id)? getSliderImage($connect, $product_id) : null;
                $description = $row['shortdesc'];
                
                array_push($allSlider, array(
                    'id' => $row['id'],
                    'name' => $name,
                    'type_code' => $type_code,
                    'type' => $type,
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'image' => $slider_image,
                    'img_link' => $img_link,
                    'description' => str_replace(array('\n','\r\n','\r'),array("\n","\r\n","\r"), $description)
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'sliders' => $allSlider
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $errordesc = "No Records found";
        $linktosolve = 'https://';
        $hint = "Kindly make sure the table has been populated";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondOK($data);

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