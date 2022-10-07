<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']);


    if($method =='GET'){
        
        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }

        //sort with status
        if (isset($_GET['sortStatus']) && is_numeric($_GET['sortStatus'])) {
            $status = cleanme($_GET['sortStatus']); //status =0-6
        } else {
            $status = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        if (!isset ($_GET['noPerPage']) ) {  
            $noPerPage = 4;
        } else {  
            $noPerPage = $_GET['noPerPage'];  
        }  
        $offset = ($page_no - 1) * $noPerPage;

        if($sort > 0){
            if (!empty($search) && $search!="" && $search!=' '){
                //search productCategory from database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT * FROM `apartment_category` WHERE `name` like ? AND status = ?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ss", $searchParam, $status);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "SELECT * FROM `apartment_category` WHERE `name` like ? AND status = ? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("ssss", $searchParam, $status, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT * FROM `apartment_category` WHERE status = ? ORDER BY id DESC";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("s", $status);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                $sqlQuery = "SELECT * FROM `apartment_category` WHERE status = ? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("sss",$status, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
            }
        }else{//no need tot sort
            if (!empty($search) && $search!="" && $search!=' '){
                //search productCategory from database 
                $searchParam = "%{$search}%";
                $searchQuery = "SELECT * FROM `apartment_category` WHERE `name` like ?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("s", $searchParam);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                //paginate the fetch data
                $searchQuery = "SELECT * FROM `apartment_category` WHERE `name` like ? ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($searchQuery);
                $stmt->bind_param("sss", $searchParam, $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;  
            }else {
                //get all data
                $sqlQuery = "SELECT * FROM `apartment_category` ORDER BY id DESC";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->execute();
                $result= $stmt->get_result();
                $total_numRow = $result->num_rows;
                $pages = ceil($total_numRow / $noPerPage);
    
                $sqlQuery = "SELECT * FROM `apartment_category` ORDER BY id DESC LIMIT ?,?";
                $stmt= $connect->prepare($sqlQuery);
                $stmt->bind_param("ss", $offset, $noPerPage);
                $stmt->execute();
                $result= $stmt->get_result();
                $numRow = $result->num_rows;
            }

        }
    
        
        //check for database connection 
        if(!$stmt->execute()){
            //DB error || invalid input
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Database comection error";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }
        $stmt->close();
        //return fetched data as array
        if($numRow > 0){
            //`sendfrom`, `username`, `status`, `name`, `password`
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $category_id = $row['category_id'];
                $name = $row['name'];
                $icon = $row['icon'];
                $statusCode =$row['status'];
                $status =($statusCode >= 1)? "Active": "Inactive";
                $noOfApartment = checkifFieldExist($connect, "apartments", "category_id", $category_id);
                $noOfApartment = ($noOfApartment)? $noOfApartment: 0;
                array_push($allResponse, array(
                    "id"=>$id, 'category_id'=>$category_id, 'name'=>$name, 'icon'=>$icon, 'noOfApartment'=>$noOfApartment, 'status'=>$status, 'statusCode'=>$statusCode
                ));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'apartmentCategories'=> $allResponse
            ];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $method = getenv('REQUEST_METHOD');
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //not found
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "No Record Found";
            $method = getenv('REQUEST_METHOD');
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, null, $status);
            respondOK($data);
        }


    }else {
        // method not allowed
        $errordesc="Method not allowed";
        $linktosolve="htps://";
        $hint=["Ensure to use the method stated in the documentation."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Method used not allowed";
        $method=getenv('REQUEST_METHOD');
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondMethodNotAlowed($data);
    }
?>