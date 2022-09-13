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
        //get company details to decode usertoken
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;

        if(!checkIfShopOwner($connect,$userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not a shop owner";
            $linktosolve = 'https://';
            $hint = "Only shop owner can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $shopid = checkIfShopOwner($connect,$userpubkey);
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
         if (!isset ($_GET['noPerPage']) ) {  
            $noPerPage = 4;
        } else {  
            $noPerPage = $_GET['noPerPage'];  
        }  
        $offset = ($page_no - 1) * $noPerPage;
        //get productbrand where id =?

        if (!empty($search) && $search!="" && $search!=' '){
            //search for data in database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT * FROM `productbrand` WHERE `name` like ? AND `shop_id`= ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ss", $searchParam, $shopid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "SELECT * FROM `productbrand` WHERE `name` like ? AND `shop_id`= ? LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("ssss", $searchParam,$shopid, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;

        }else {
            //get all data in database
            $sqlQuery = "SELECT * FROM `productbrand` WHERE `shop_id`= ?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("s", $shopid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            $sqlQuery = "SELECT * FROM `productbrand` WHERE `shop_id`= ? LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("sss", $shopid, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;
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
        //retuurn fetched data as array
        if($numRow > 0){
            $stmt->close();
            $allResponse = [];
            while($data = $result->fetch_assoc()){
                $id = $data['id'];                
                $name = $data['name'];
                $shop_id = $data['shop_id'];
                $brand_image = $data['brand_image'] ? $data['brand_image'] : null;
                $shop_name = ($shop_id)? getNameFromField($connect, "shops" , "id" , $shop_id) : "";
                $number_of_products = ( checkifFieldExist($connect, 'products' , 'brand_id', $data['id']) ) ? checkifFieldExist($connect, 'products' , 'brand_id', $data['id']) : "0";
                array_push($allResponse,array("id"=>$id,"name"=>$name, 'shop_id' => $shop_id , 'shop_name' => $shop_name ,'number_of_products' => $number_of_products, 'image' => $brand_image));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'productBrand'=> $allResponse
            ];
            //$maindata=[$maindata];
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
            $text = "Record Not Found";
            $method = getenv('REQUEST_METHOD');
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, null, $status);
            respondOK($data);
        }


           
        

    }else{
        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts GET request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondMethodNotAlowed($data);

    }
?>