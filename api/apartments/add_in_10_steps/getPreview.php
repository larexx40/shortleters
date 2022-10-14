<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../../cartsfunction.php";

    // This step occurs if the user Selects a sub Building Type According to Building Type Selected
    
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');
    $maindata = [];

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

        $user_id =  getUserWithPubKey($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$user_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }


        if ( !isset($_GET['apartment_id']) ){

            $errordesc="product id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="host type id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_GET['apartment_id']);
        }

        if ( empty($apartment_id) ){

            $errordesc = "Enter all Fields";
            $linktosolve = 'https://';
            $hint = "Kindly ensure that a valid id is passed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $query = "SELECT * FROM `apartments` WHERE `apartment_id` = ?";
        $gtTotalPgs = $connect->prepare($query);
        $gtTotalPgs->bind_param("s", $apartment_id);
        $gtTotalPgs->execute();
        $result = $gtTotalPgs->get_result();
        $num_row = $result->num_rows; 

        if ($num_row > 0){
            $row= $result->fetch_assoc();
            $title = $row['title'];
            $agent_id = $row['agent_id'];
            $agent_name = getUserFullname($connect, $agent_id);
            $image = getApartmentCoverImage($connect, "apartment_images", "apartment_id", $row['apartment_id']);
            $description = $row['description'];
            $host_type_id = $row["host_type_id"];
            $host_type_name = getNameFromField($connect, "host_type", "host_type_id", $host_type_id);
            $price = $row["price"];
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
            $amenities_ids = ($row["amenities_id"])? explode(",", $row["amenities_id"]) : null;
            $amenities_id_name = [];
            if ($amenities_ids){
                for ($i = 0; $i < count($amenities_ids); $i++){
                    $id_details = getFieldsDetails($connect, "sub_amenities", "sub_amen_id", $amenities_ids[$i]);
                    array_push($amenities_id_name, array(
                        'amenities_id' => $amenities_ids[$i],
                        'name' => ($id_details)? $id_details['details']['name'] : null,
                        'icon' => ($id_details)? $id_details['details']['icon'] : null
                    ));
                }
            }
            $space_type_id = $row["space_type_id"];
            $space_type_name = getNameFromField($connect, "space_type", "space_id", $space_type_id);
            $apartment_address = $row["apartment_address"];
            $apartment_country = $row["apartment_country"];
            $apartment_city = $row["apartment_city"];
            $apartment_state = $row["apartment_state"];
            $apartment_lga = $row["apartment_lga"];
            $longtitude = $row["longtitude"];
            $latitude = $row["latitude"];
            $max_stay = $row["max_stay"];
            $building_type_id = $row["building_type_id"];
            $building_type_name = getNameFromField($connect, "building_types", "build_id", $building_type_id);
            
            $max_guest = $row['max_guest'];
            $apartment_facilities = getAllApartmentFacilities($connect, $row['apartment_id']);
            $maindata = [
                'id' => $row['apartment_id'],
                'title' => $title,
                'agent_name'=>$agent_name,
                'description' => $description,
                'host_type_id' => $host_type_id,
                'host_type_name' => ($host_type_name) ? $host_type_name : null,
                'price' => $price,
                'image'=>$image,
                'safety_ids' => $safety_id_name,
                'highlights_ids' => $highlights_id_name,
                'building_type_id' => $building_type_id,
                'building_type_name' => ($building_type_name) ?  $building_type_name : null,
                'amenities_ids' => $amenities_id_name,
                'space_type_id' => $space_type_id,
                'space_type_name' => ($space_type_name) ?  $space_type_name : null,
                'agent_id' => $agent_id,
                'apartment_address' => $apartment_address,
                'apartment_country' => $apartment_country,
                'apartment_city' => $apartment_city,
                'apartment_state' => $apartment_state,
                'longtitude' => $longtitude,
                'latitude' => $latitude,
                'apartment_lga' => $apartment_lga,

                'max_guest' => $max_guest,
                'apartment_facilities'=>$apartment_facilities,
            ];
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $maindata, $status);
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
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
        
    }


?>