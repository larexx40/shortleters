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

        if (isset($_GET['sortessential'])) {
            $essential = cleanme($_GET['sortessential']); //sort result by status if > 0
        } else {
            $essential = "";
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
               
                if ( $status != ""  && $essential != "" ){
                    $query = "SELECT  sub_amenities.* FROM `sub_amenities` LEFT JOIN amenities ON amenities.amen_id = sub_amenities.amen_id WHERE sub_amenities.status = ? AND sub_amenities.essential = ? AND ( amenities.name LIKE ? OR amenities.name LIKE ? OR icon LIKE ?) ";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssss", $status, $essential ,$searching ,$searching, $searching );
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    $total_pg_found =  ceil($num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("sssssss", $status, $essential ,$searching ,$searching, $searching , $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                }

                if ( $status != "" && $essential == ""){
                    // get the total number of pages
                    $query = "SELECT  sub_amenities.* FROM `sub_amenities` LEFT JOIN amenities ON amenities.amen_id = sub_amenities.amen_id WHERE sub_amenities.status = ? AND ( amenities.name LIKE ? OR amenities.name LIKE ? OR icon LIKE ?) ";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $status, $searching ,$searching, $searching );
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    $total_pg_found =  ceil($num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $status, $searching ,$searching, $searching , $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                }

                if ( $essential != "" && $status == "" ){
                    $query = "SELECT  sub_amenities.* FROM `sub_amenities` LEFT JOIN amenities ON amenities.amen_id = sub_amenities.amen_id WHERE sub_amenities.essential = ? AND ( amenities.name LIKE ? OR amenities.name LIKE ? OR icon LIKE ?) ";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssss", $essential, $searching ,$searching, $searching );
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;
                    $total_pg_found =  ceil($num_row / $no_per_page);

                    $query = "$query LIMIT ?, ?";
                    $queryStmt = $connect->prepare($query);
                    $queryStmt->bind_param("ssssss", $essential, $searching ,$searching, $searching , $offset, $no_per_page);
                    $queryStmt->execute();
                    $result = $queryStmt->get_result();
                    $num_row = $result->num_rows;

                } 
            }else{
                // get the total number of pages
                $query = "SELECT  sub_amenities.* FROM `sub_amenities` LEFT JOIN amenities ON amenities.amen_id = sub_amenities.amen_id WHERE amenities.name LIKE ? OR amenities.name LIKE ? OR icon LIKE ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sss", $searching, $searching ,$searching);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $queryStmt = $connect->prepare($query);
                $queryStmt->bind_param("sssss", $searching, $searching ,$searching, $offset, $no_per_page);
                $queryStmt->execute();
                $result = $queryStmt->get_result();
                $num_row = $result->num_rows;

            }            

        }else{

            if ($sort > 0){
                // Get total number of complains in the system
                if ( $status != ""  && $essential != "" ){
                    $query = "SELECT * FROM `sub_amenities` WHERE `essential` = ? AND `status` = ?";
                    $gtTotalPgs = $connect->prepare($query);
                    $gtTotalPgs->bind_param("ss", $essential, $status);
                    $gtTotalPgs->execute();
                    $result = $gtTotalPgs->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page); 

                    $query = "$query LIMIT ?, ?";
                    $gtTotalcomplains = $connect->prepare($query);
                    $gtTotalcomplains->bind_param("ssss", $essential , $status ,$offset, $no_per_page);
                    $gtTotalcomplains->execute();
                    $result = $gtTotalcomplains->get_result();
                    $num_row = $result->num_rows;
                }

                if ( $status != "" && $essential == ""){
                    // get the total number of pages
                    $query = "SELECT * FROM `sub_amenities` WHERE `status` = ?";
                    $gtTotalPgs = $connect->prepare($query);
                    $gtTotalPgs->bind_param("s", $status);
                    $gtTotalPgs->execute();
                    $result = $gtTotalPgs->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page); 

                    $query = "$query LIMIT ?, ?";
                    $gtTotalcomplains = $connect->prepare($query);
                    $gtTotalcomplains->bind_param("sss", $status ,$offset, $no_per_page);
                    $gtTotalcomplains->execute();
                    $result = $gtTotalcomplains->get_result();
                    $num_row = $result->num_rows;
                }

                if ( $essential != "" && $status == "" ){
                    $query = "SELECT * FROM `sub_amenities` WHERE `essential` = ?";
                    $gtTotalPgs = $connect->prepare($query);
                    $gtTotalPgs->bind_param("s", $essential);
                    $gtTotalPgs->execute();
                    $result = $gtTotalPgs->get_result();
                    $total_num_row = $result->num_rows;
                    $total_pg_found =  ceil($total_num_row / $no_per_page); 

                    $query = "$query LIMIT ?, ?";
                    $gtTotalcomplains = $connect->prepare($query);
                    $gtTotalcomplains->bind_param("sss", $essential ,$offset, $no_per_page);
                    $gtTotalcomplains->execute();
                    $result = $gtTotalcomplains->get_result();
                    $num_row = $result->num_rows;

                }
                
            }else{
                // Get total number of complains in the system
                $query = "SELECT * FROM `sub_amenities`";
                $gtTotalPgs = $connect->prepare($query);
                $gtTotalPgs->execute();
                $result = $gtTotalPgs->get_result();
                $total_num_row = $result->num_rows;
                $total_pg_found =  ceil($total_num_row / $no_per_page); 

                $query = "$query LIMIT ?, ?";
                $gtTotalcomplains = $connect->prepare($query);
                $gtTotalcomplains->bind_param("ss", $offset, $no_per_page);
                $gtTotalcomplains->execute();
                $result = $gtTotalcomplains->get_result();
                $num_row = $result->num_rows;
                
            }
            

        }

        if ($num_row > 0){
            $allAmenities = [];

            while($row = $result->fetch_assoc()){
                $name =  $row['name'];
                $amen_id = $row['amen_id'];
                $amen_name = getNameFromField($connect, "amenities", "amen_id", $amen_id);
                $icon = $row['icon'];
                $status_code = $row['status'];
                $status = ($row['status'] == 1) ? "Active" : "Inactive";
                $essential_code = $row['essential'];
                $essential_name = ($row['essential'] == 1) ? "Essential" : "Non-essential";
                $icon = $row['icon'];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($allAmenities, array(
                    'id' => $row['sub_amen_id'],
                    'name' => $name,
                    'amen_id' => $amen_id,
                    'amenity_name' => ($amen_name)? $amen_name : false,
                    'icon'=>$icon,
                    'status_code' => $status_code,
                    'status' => $status,
                    'essential_code' => $essential_code,
                    'essential' => $essential_name,
                    'created' => $created,
                    'updated' => $updated,
                    'icon' => $icon
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'amenities' => $allAmenities
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