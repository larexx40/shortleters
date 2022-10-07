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
        $build_type_name = getNameFromField($connect, "building_types", "build_id", $buildingTypeid);

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        if (isset($_GET['sortStatus']) && is_numeric($_GET['sortStatus'])) {
            $status = cleanme($_GET['sortStatus']); //status =0-6
        } else {
            $status = "";
        }

        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }
    
        if (isset ($_GET['page']) ) { 
            if(!empty($_GET['page']) && is_numeric($_GET['page']) ){
                $page_no = $_GET['page']; 
            }else{
                $page_no = 1;
            }
        } else {  
            $page_no = 1;  
        }

        if (isset ($_GET['noPerPage']) ) {  
            if(!empty($_GET['noPerPage']) && is_numeric($_GET['noPerPage']) ){
                $noPerPage = $_GET['noPerPage']; 
            }else{
                $noPerPage =4;
            }
        } else {  
            $noPerPage =4;  
        } 
        $offset = ($page_no - 1) * $noPerPage;
        
        if($sort > 0){
            if (!empty($search) && $search!="" && $search!=' '){
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT * FROM `sub_building_types` WHERE `build_type_id` = ? AND `status` = ?
                                AND (`name` like ? OR description like ?)";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ss", $searchParam, $status);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss",  $searchParam, $status, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  

            }else{//no search
                $query = "SELECT * FROM `sub_building_types` WHERE `build_type_id` = ? AND `status` = ?";
                $stmt = $connect->prepare($query);
                $stmt->bind_param("ss", $buildingTypeid , $status);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $query = "$query ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($query);
                $stmt->bind_param("ssss",$status, $buildingTypeid, $status, $offset);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  

            }
            

        }else{//no need to sort
            if (!empty($search) && $search!="" && $search!=' '){
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT * FROM `sub_building_types` WHERE `build_type_id` = ? 
                                AND (`name` like ? OR 'description' like ? )";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sss",$buildingTypeid, $searchParam, $searchParam,);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $searchQuery = "$searchQuery ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sssss", $buildingTypeid, $searchParam, $searchParam, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else{// no search
                $query = "SELECT * FROM `sub_building_types` WHERE `build_type_id` = ?";
                $stmt = $connect->prepare($query);
                $stmt->bind_param("s", $buildingTypeid);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);

                $query = "$query ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($query);
                $stmt->bind_param("sss", $buildingTypeid, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows; 
                
            }
             
            
        }

        if ($numRow > 0){
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $statusCode = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $description = $row['description'];
                
                array_push($allResponse,
                    array('sub_type_id' => $row['sub_build_id'],
                    'name' => $name,
                    'statusCode' => $statusCode,
                    'status' => $status,
                    'description' => str_replace(array('\n','\r\n','\r'),array("\n","\r\n","\r"), $description))
                );
            }
            
            $data = array(
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                "buildingTypeid"=>$buildingTypeid,
                "build_type_name"=>$build_type_name,
                'buildingSubtypes' => $allResponse
            );
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }

        $data = array(
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                "buildingTypeid"=>$buildingTypeid,
                "build_type_name"=>$build_type_name,
            );
        $text = "No Sub type found";;
        $status = true;
        $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
        respondOK($successData);

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