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

        $admin =  checkIfIsAdmin($connect, $user_pubkey);
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

        if (!isset($_GET['sub_type_id'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required sub type id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $sub_building_type_id = cleanme($_GET['sub_type_id']);
        }

        if ( empty($sub_building_type_id)){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

                

        $query = "SELECT * FROM `sub_building_types` WHERE `sub_build_id` = ?";
        $gtTotalcomplains = $connect->prepare($query);
        $gtTotalcomplains->bind_param("s", $sub_building_type_id);
        $gtTotalcomplains->execute();
        $result = $gtTotalcomplains->get_result();
        $num_row = $result->num_rows;
                

        if ($num_row > 0){

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $status_code = $row['status'];
                $build_type_id = $row['build_type_id'];
                $build_type_name = getNameFromField($connect, "building_types", "build_id", $build_type_id);
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $description = $row['description'];
                $created = gettheTimeAndDate($row['created_at']);
                $updated = gettheTimeAndDate($row['updated_at']);
                
                $building_sub_type = array(
                    'id' => $row['sub_build_id'],
                    'name' => $name,
                    'status_code' => $status_code,
                    'build_type' => $build_type_id,
                    'build_type_name' => $build_type_name,
                    'status' => $status,
                    'created' => $created,
                    'updated' => $updated,
                    'description' => str_replace(array('\n','\r\n','\r'),array("\n","\r\n","\r"), $description)
                );
            }
            $data = array(
                'build_subtype' => $building_sub_type
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