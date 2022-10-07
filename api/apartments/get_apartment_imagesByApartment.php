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
        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            
            // get the total number of pages
            $query = "SELECT apartment_images.* FROM `apartment_images` LEFT JOIN apartments ON apartments.apartment_id = apartment_images.apartment_id WHERE apartment_id = ? AND ( apartments.name LIKE ? OR apartment_images.image_url LIKE ? )";
            $queryStmt = $connect->prepare($query);
            $queryStmt->bind_param("sss", $searching ,$searching, $searching);
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

        }else{
                
            // Get total number of complains in the system
            $query = "SELECT * FROM `apartment_images` WHERE apartment_id = ?";
            $gtTotalPgs = $connect->prepare($query);
            $gtTotalPgs->bind_param("s", $apartment_id);
            $gtTotalPgs->execute();
            $result = $gtTotalPgs->get_result();
            $total_num_row = $result->num_rows;
            $total_pg_found =  ceil($total_num_row / $no_per_page); 

            $query = "$query LIMIT ?, ?";
            $gtTotalcomplains = $connect->prepare($query);
            $gtTotalcomplains->bind_param("sss", $apartment_id ,$offset, $no_per_page);
            $gtTotalcomplains->execute();
            $result = $gtTotalcomplains->get_result();
            $num_row = $result->num_rows;
            

        }

        if ($num_row > 0){
            $allImages = [];

            while($row = $result->fetch_assoc()){
                $aprtment_id = $row['apartment_id'];
                $aprtment_name =  getNameFromField($connect, "apartments", "apartment_id", $apartment_id);
                $status_code = $row['cover_photo'];
                $status = ($row['cover_photo'] == 1) ? "Cover Photo" : "Not Cover Photo";
                $img_url = $row['image_url'];
                $created = gettheTimeAndDate(strtotime($row['created_at']));
                $updated = gettheTimeAndDate(strtotime($row['updated_at']));
                
                array_push($allImages, array(
                    'id' => $row['apartment_img_id'],
                    'aprtment_id' => $aprtment_id,
                    'aprtment_name' => ( $aprtment_name )? $aprtment_name: null,
                    'cover_code' => $status_code,
                    'cover' => $status,
                    'img' => $img_url,
                    'created' => $created,
                    'updated' => $updated
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'images' => $allImages
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