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
        if (!checkIfIsAdmin($connect, $user_pubkey) ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
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

        //`apartments` WHERE `apartment_id` = 
        $query = "SELECT user_wishlist.*, apartments.name AS apartment_name, apartments.title, apartments.status, apartments.price, apartments.availability, apartments.no_of_pets, apartments.no_of_kids, apartments.no_of_adults, apartments.apartment_address, apartments.apartment_country, apartments.apartment_city, apartments.apartment_state, apartments.apartment_lga, apartments.longtitude, apartments.latitude, apartments.max_stay from user_wishlist 
                LEFT JOIN apartments ON  user_wishlist.apartment_id = apartments.apartment_id";
        $queryStmt = $connect->prepare($query);
        $queryStmt->execute();
        $result = $queryStmt->get_result();
        $total_num_row = $result->num_rows;
        $totalPage =  ceil($total_num_row / $no_per_page);

        $query = "$query ORDER BY user_wishlist.id DESC LIMIT ?, ?";
        $queryStmt = $connect->prepare($query);
        $queryStmt->bind_param("ss", $offset, $no_per_page);
        $queryStmt->execute();
        $result = $queryStmt->get_result();
        $num_row = $result->num_rows; 
                

        if ($num_row > 0){
            $allResponse = []; 

            while($row = $result->fetch_assoc()){
                $id =  $row['id'];
                $wishlist_id = $row['wishlist_id'];
                $apartment_id = $row['apartment_id'];
                $images = getApartmentImage($connect, "apartment_images", "apartment_id", $apartment_id);
                $wishlist_name =  $row['name'];
                $apartment_name =  $row['apartment_name'];
                $preferred_chek_in = $row['preferred_chek_in'];
                $preferred_chek_out = $row['preferred_chek_out'];
                $no_of_guest = $row['no_of_guest'];
                $statusCode = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $title = $row['title'];
                $price = $row["price"];
                $availabilityCode = $row['availability'];
                $availability = ($row["availability"] > 0)? "Available" : "Booked";
                $no_of_adults = $row["no_of_adults"];
                $no_of_kids = $row["no_of_kids"];
                $no_of_pets = $row["no_of_pets"];
                $apartment_address = $row["apartment_address"];
                $apartment_country = $row["apartment_country"];
                $apartment_city = $row["apartment_city"];
                $apartment_state = $row["apartment_state"];
                $longtitude = $row["longtitude"];
                $latitude = $row["latitude"];
                $apartment_lga = $row["apartment_lga"];

                array_push($allResponse, array(
                    "id"=>$id,
                    'wishlist_id'=>$wishlist_id,
                    'wishlist_name'=>$wishlist_name,
                    "apartment_id"=>$apartment_id,
                    'apartment_name'=>$apartment_name,
                    "images"=>$images,
                    "preferred_chek_in"=>$preferred_chek_in,
                    'preferred_chek_out'=>$preferred_chek_out,
                    "availability"=>$availability,
                    "availabilityCode"=>$availabilityCode,
                    "price"=>$price,
                    "status"=>$status,
                    "statusCode"=>$statusCode,
                    'title'=>$title,
                    "no_of_guest"=>$no_of_guest,
                    "no_of_pets"=>$no_of_pets,
                    "no_of_kids"=>$no_of_kids,
                    "no_of_adults"=>$no_of_adults,
                    "apartment_lga"=>$apartment_lga,
                    "latitude"=>$latitude,
                    'longtitude'=>$longtitude,
                    "apartment_state"=>$apartment_state,
                    "apartment_city"=>$apartment_city,
                    "apartment_country"=>$apartment_country,
                    "apartment_address"=>$apartment_address,
                ));
            }

            $data=[
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $totalPage,
                'allrespo$allResponse' =>$allResponse
            ];
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