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
        if (!isset($_GET['buildingTypeid'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required building type id field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $buildingTypeid = cleanme($_GET['buildingTypeid']);
        }

        if ( empty($buildingTypeid)){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

                

        $query = "SELECT * FROM `sub_building_types` WHERE `build_type_id` = ?";
        $gtTotalcomplains = $connect->prepare($query);
        $gtTotalcomplains->bind_param("s", $buildingTypeid);
        $gtTotalcomplains->execute();
        $result = $gtTotalcomplains->get_result();
        $num_row = $result->num_rows;
                

        if ($num_row > 0){
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $buildingTypeid = $row['build_type_id'];
                $build_type_name = getNameFromField($connect, "building_types", "build_id", $buildingTypeid);
                $statusCode = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $description = $row['description'];
                
                array_push($allResponse,
                    array('id' => $row['sub_build_id'],
                    'name' => $name,
                    'statusCode' => $statusCode,
                    'build_type_name' => $build_type_name,
                    'status' => $status,
                    'description' => str_replace(array('\n','\r\n','\r'),array("\n","\r\n","\r"), $description))
                );
            }
            $build_type_name = getNameFromField($connect, "building_types", "build_id", $buildingTypeid);
            $data = array(
                "build_type_name"=>$build_type_name,
                'build_subtype' => $allResponse
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