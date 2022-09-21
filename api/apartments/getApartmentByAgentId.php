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

        if ( !isset($_GET['agent_id']) ){

            $errordesc="Agent id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="host type id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $agent_id = cleanme($_GET['agent_id']);
        }


            
        // Get total number of complains in the system
        $query = "SELECT * FROM `apartments` WHERE `agent_id` = ?";
        $gtTotalPgs = $connect->prepare($query);
        $gtTotalPgs->bind_param("s", $agent_id);
        $gtTotalPgs->execute();
        $result = $gtTotalPgs->get_result();
        $num_row = $result->num_rows; 

                 


        if ($num_row > 0){
            $apartment = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $title = $row['title'];
                $description = $row['description'];
                $space_description = $row["space_description"];
                $guest_access = $row["guest_access"];
                $other_details = $row["other_details"];
                $host_type_id = $row["host_type_id"];
                $host_type_name = getNameFromField($connect, "host_type", "host_type_id", $host_type_id);
                $price = $row["price"];
                $no_of_adults = $row["no_of_adults"];
                $no_of_kids = $row["no_of_kids"];
                $no_of_pets = $row["no_of_pets"];
                $no_of_floor = $row["no_of_floor"];
                $listing_currency_id = $row["listing_currency_id"];
                $listing_currency_name = getNameFromField($connect, "listing_currency", "currency_id", $listing_currency_id);
                $available_floor = $row["available_floor"];
                $safety_ids = ($row["safety_ids"])? explode(",", $row["safety_ids"]) : null;
                $safety_id_name = [];
                if ($safety_ids){
                    for ($i = 0; $i < count($safety_ids); $i++){
                        $id_name = getFieldsDetails($connect, "guest_safety", "guest_safetyid", $safety_ids[$i]);
                        array_push($safety_id_name, array(
                            'safety_id' => $safety_ids[$i],
                            'details' => ($id_name)? $id_name['details'] : null
                        ));
                    }
                }
                
                $custom_link = $row["custom_link"];
                $availability = $row['availability'];
                $availability = ($row["availability"] > 0)? "Booked" : "Available";
                $getting_around_details = $row["getting_around_details"];
                $neighbourhood_description = $row["neighbourhood_description"];
                $highlights_ids = ($row["highlights_ids"])? explode(",", $row["highlights_ids"]) : null;
                $highlights_id_name = [];
                if ($highlights_ids){
                    for ($i = 0; $i < count($highlights_ids); $i++){
                        $id_name = getNameFromField($connect, "highlights", "highlightid", $highlights_ids[$i]);
                        array_push($highlights_id_name, array(
                            'highlight_id' => $highlights_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $building_type_id = $row["building_type_id"];
                $building_type_name = getNameFromField($connect, "building_types", "build_id", $building_type_id);
                $sub_building_type_id = $row["sub_building_type_id"];
                $sub_building_type_name = getNameFromField($connect, "sub_building_types", "sub_build_id", $sub_building_type_id);
                $amenities_ids = ($row["amenities_id"])? explode(",", $row["amenities_id"]) : null;
                $amenities_id_name = [];
                if ($amenities_ids){
                    for ($i = 0; $i < count($amenities_ids); $i++){
                        $id_name = getNameFromField($connect, "sub_amenities", "sub_amen_id", $amenities_ids[$i]);
                        array_push($amenities_id_name, array(
                            'amenities_id' => $amenities_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $space_type_id = $row["space_type_id"];
                $space_type_name = getNameFromField($connect, "space_type", "space_id", $space_type_id);
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
                $agent_id = $row['agent_id'];
                // $space_type_name = getNameFromField($connect, "space_type", "space_id", $space_type_id);
                $apartment_address = $row["apartment_address"];
                $apartment_country = $row["apartment_country"];
                $apartment_city = $row["apartment_city"];
                $apartment_state = $row["apartment_state"];
                $longtitude = $row["longtitude"];
                $latitude = $row["latitude"];
                $apartment_lga = $row["apartment_lga"];
                $location_sharing = ($row["location_sharing"] > 0)? "Sharing" : "Not Sharing";
                $scenic_ids = ($row["scenic_ids"])? explode(",", $row["scenic_ids"]): null;
                $scenic_id_name = [];
                if ($scenic_ids){
                    for ($i = 0; $i < count($scenic_ids); $i++){
                        $id_name = getNameFromField($connect, "scenic_view", "scenicid", $scenic_ids[$i]);
                        array_push($scenic_id_name, array(
                            'scenic_id' => $scenic_ids[$i],
                            'name' => ($id_name)? $id_name : null
                        ));
                    }
                }
                
                $min_stay = $row["min_stay"];
                $max_stay = $row["max_stay"];
                $duration = $row["duration"];
                $check_in_day = $row["check_in_day"];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($apartment, array(
                    'id' => $row['apartment_id'],
                    'name' => $name,
                    'status_code' => $status_code,
                    'status' => $status,
                    'title' => $title,
                    'description' => $description,
                    'space_description' => $space_description,
                    'guest_access' => $guest_access,
                    'other_details' => $other_details,
                    'host_type_id' => $host_type_id,
                    'host_type_name' => ($host_type_name) ? $host_type_name : null,
                    'price' => $price,
                    'no_of_adults' => $no_of_adults,
                    'no_of_kids' => $no_of_kids,
                    'no_of_pets' => $no_of_pets,
                    'no_of_floor' => $no_of_floor,
                    'listing_currency_id' => $listing_currency_id,
                    'listing_currency_name' => ($listing_currency_name) ? $listing_currency_name : null,
                    'available_floor' => $available_floor,
                    'safety_ids' => $safety_id_name,
                    'custom_link' => $custom_link,
                    'availability' => $availability,
                    'availability' => $availability,
                    'neighbourhood_description' => $neighbourhood_description,
                    'getting_around_details' => $getting_around_details,
                    'highlights_ids' => $highlights_id_name,
                    'building_type_id' => $building_type_id,
                    'building_type_name' => ($building_type_name) ?  $building_type_name : null,
                    'sub_building_type_id' => $sub_building_type_id,
                    'sub_building_type_name' => ($sub_building_type_name) ?  $sub_building_type_name : null,
                    'amenities_ids' => $amenities_id_name,
                    'space_type_id' => $space_type_id,
                    'space_type_name' => ($space_type_name) ?  $space_type_name : null,
                    'apartment_status_code' => $apartment_status_code,
                    'apartment_status' => $apartment_status,
                    'agent_id' => $agent_id,
                    'apartment_address' => $apartment_address,
                    'apartment_country' => $apartment_country,
                    'apartment_city' => $apartment_city,
                    'apartment_state' => $apartment_state,
                    'longtitude' => $longtitude,
                    'latitude' => $latitude,
                    'apartment_lga' => $apartment_lga,
                    'location_sharing' => $location_sharing,
                    'location_sharing_code' => $row["location_sharing"],
                    'scenic_ids' => $scenic_id_name,
                    'min_stay' => $min_stay,
                    'max_stay' => $max_stay,
                    'duration' => $duration,
                    'check_in_day' => $check_in_day,
                    'created' => $created,
                    'updated' => $updated,
                ));
            }
            $data = array(
                'apartment' => $apartment,
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