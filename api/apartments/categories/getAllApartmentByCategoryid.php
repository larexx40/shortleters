<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../../cartsfunction.php";
    
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');

    if ($method == 'GET') {

        if ( !isset($_GET['category_id']) ){

            $errordesc="category_id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Apartment category id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $category_id = cleanme($_GET['category_id']);
        }

        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }

        $offset = ($page_no - 1) * $no_per_page;
         
        // Get total number of complains in the system
        $query = "SELECT id, apartment_id, name, status, category_id, price, availability, apartment_status, apartment_country,
                `listing_currency_id`, apartment_city, apartment_state FROM apartments WHERE `category_id` = ?";
        $gtTotalPgs = $connect->prepare($query);
        $gtTotalPgs->bind_param("s", $category_id);
        $gtTotalPgs->execute();
        $result = $gtTotalPgs->get_result();
        $num_row = $result->num_rows; 
        $total_pg_found =  ceil($num_row / $no_per_page);

        $query = "$query ORDER BY id DESC LIMIT ?, ?";
        $gtTotalPgs = $connect->prepare($query);
        $gtTotalPgs->bind_param("sss", $category_id, $offset, $no_per_page);
        $gtTotalPgs->execute();
        $result = $gtTotalPgs->get_result();
        $num_row = $result->num_rows; 

        if ($num_row > 0){
            $apartment = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $apartment_id = $row['apartment_id'];
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $category_id = $row['category_id'];
                $category_name = getNameFromField($connect, "apartment_category", "category_id", $category_id);
                $price = $row["price"];           
                $listing_currency_id = $row['listing_currency_id'];
                // $listing_currency_name = getNameFromField($connect, "listing_currency", "currency_id", $listing_currency_id);
                
                $availabilityCode = $row['availability'];
                $availability = ($row["availability"] > 0)? "Booked" : "Available";
                
                if ( $row['apartment_status'] == 1 ){
                    $apartment_status = "Listed";
                }
                if ( $row['apartment_status'] == 2 ){
                    $apartment_status = "Snoozed";
                }
                if ( $row['apartment_status'] == 3 ){
                    $apartment_status = "Unlisted";
                }
                if ( $row['apartment_status'] == 4 ){
                    $apartment_status = "Deactivated";
                }
                $apartment_status_code = $row['apartment_status'];
                
                $apartment_country = $row["apartment_country"];
                $apartment_city = $row["apartment_city"];
                $apartment_state = $row["apartment_state"];
                $images = getApartmentImage($connect, "apartment_images", "apartment_id", $apartment_id);
                
                array_push($apartment, array(
                    'id' => $row['apartment_id'],
                    'name' => $name,
                    'status_code' => $status_code,
                    'status' => $status,
                    
                    'category_id'=>$category_id,
                    'category_name'=>$category_name,
                    
                    'price' => $price,
                    'listing_currency_id' => $listing_currency_id,
                    // 'listing_currency_name' => ($listing_currency_name) ? $listing_currency_name : null,
                    'availabilityCode' => $availabilityCode,
                    'availability' => $availability,
                    'apartment_status_code' => $apartment_status_code,
                    'apartment_status' => $apartment_status,
                    'apartment_country' => $apartment_country,
                    'apartment_city' => $apartment_city,
                    'apartment_state' => $apartment_state,
                    'images'=>$images,
                    
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $num_row,
                'totalPage' => $total_pg_found,
                'apartments' => $apartment,
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