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
        $pubkey = $decodedToken->usertoken;

        $admin =  checkIfIsAdmin($connect, $pubkey);
        // $agent = getShopWithPubKey($connect, $user_pubkey);
        // $user = getUserWithPubKey($connect, $user_pubkey);

        if  (!$admin){

            // send user not found response to the user
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }

        
        // Get total number of complains in the system
        $listed = "1";
        $query = "SELECT `apartment_id`, `name`, `description`, `check_in_day`, `price`  FROM `apartments` WHERE`apartment_status` = ? AND `availability` = ?";
        $gt_apartments = $connect->prepare($query);
        $gt_apartments->bind_param("ss", $listed, $listed);
        $gt_apartments->execute();
        $result = $gt_apartments->get_result();
        $num_row = $result->num_rows;   

        if ($num_row > 0){
            $allApartments = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];  
                $price = $row["price"];
                $description = $row['description'];
                $check_in_day = $row["check_in_day"];
                
                array_push($allApartments, array(
                    'id' => $row['apartment_id'],
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'check_in_day' => $check_in_day,
                    // 'status_code' => $status_code,
                    // 'status' => $status,
                    // 'title' => $title,
                    // 'space_description' => $space_description,
                    // 'guest_access' => $guest_access,
                    // 'other_details' => $other_details,
                    // 'host_type_id' => $host_type_id,
                    // 'host_type_name' => ($host_type_name) ? $host_type_name : null,
                    // 'no_of_adults' => $no_of_adults,
                    // 'no_of_kids' => $no_of_kids,
                    // 'no_of_pets' => $no_of_pets,
                    // 'no_of_floor' => $no_of_floor,
                    // 'listing_currency_id' => $listing_currency_id,
                    // 'listing_currency_name' => ($listing_currency_name) ? $listing_currency_name : null,
                    // 'available_floor' => $available_floor,
                    // 'safety_ids' => $safety_id_name,
                    // 'custom_link' => $custom_link,
                    // 'availability' => $availability,
                    // 'availability' => $availability,
                    // 'neighbourhood_description' => $neighbourhood_description,
                    // 'getting_around_details' => $getting_around_details,
                    // 'highlights_ids' => $highlights_id_name,
                    // 'building_type_id' => $building_type_id,
                    // 'building_type_name' => ($building_type_name) ?  $building_type_name : null,
                    // 'sub_building_type_id' => $sub_building_type_id,
                    // 'sub_building_type_name' => ($sub_building_type_name) ?  $sub_building_type_name : null,
                    // 'amenities_ids' => $amenities_id_name,
                    // 'space_type_id' => $space_type_id,
                    // 'space_type_name' => ($space_type_name) ?  $space_type_name : null,
                    // 'apartment_status_code' => $apartment_status_code,
                    // 'apartment_status' => $apartment_status,
                    // 'agent_id' => $agent_id,
                    // 'apartment_address' => $apartment_address,
                    // 'apartment_country' => $apartment_country,
                    // 'apartment_city' => $apartment_city,
                    // 'apartment_state' => $apartment_state,
                    // 'longtitude' => $longtitude,
                    // 'latitude' => $latitude,
                    // 'apartment_lga' => $apartment_lga,
                    // 'location_sharing' => $location_sharing,
                    // 'location_sharing_code' => $row["location_sharing"],
                    // 'scenic_ids' => $scenic_id_name,
                    // 'min_stay' => $min_stay,
                    // 'max_stay' => $max_stay,
                    // 'duration' => $duration,
                    // 'created' => $created,
                    // 'updated' => $updated,
                ));
            }
            $data = array(
                'apartments' => $allApartments
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