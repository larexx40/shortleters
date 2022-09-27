<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../../cartsfunction.php";
    
  

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
        $user_pubkey = $decodedToken->usertoken;

        $user_id = getUserWithPubKey($connect, $user_pubkey);
        $admin = checkIfIsAdmin($connect, $user_pubkey);


        // check if user is admin
        if ( !$user_id && !$admin ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $admin ){
            if ( !isset($_GET['userid'])) {

                $errordesc="user id is required";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="user id must be passed";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
    
            }else{
                $user_id = cleanme($_GET['userid']);
            }
        }
        
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }

        
        if (isset ($_GET['per_page']) ) {  
            $no_per_page = cleanme($_GET['per_page']);
        } else {  
            $no_per_page = 8;  
        }


        $offset = ($page_no - 1) * $no_per_page;

        $query = "SELECT user_wishlist.* from user_wishlist WHERE user_id = ?";
        $queryStmt = $connect->prepare($query);
        $queryStmt->bind_param("s", $user_id);
        $queryStmt->execute();
        $result = $queryStmt->get_result();
        $total_num_row = $result->num_rows;
        $total_pg_found =  ceil($total_num_row / $no_per_page);

        $query = "$query LIMIT ?, ?";
        $queryStmt = $connect->prepare($query);
        $queryStmt->bind_param("sss", $user_id, $offset, $no_per_page);
        $queryStmt->execute();
        $result = $queryStmt->get_result();
        $num_row = $result->num_rows; 

        

        if ($num_row > 0){
            $allwishlist = [];

            //`wishlist_id`, `apartment_id`, `name`, `preferred_chek_in`, `preferred_chek_out`, `no_of_guest`, `user_id`,
            while($row = $result->fetch_assoc()){
                $id =  $row['id'];
                $wishlist_id = $row['wishlist_id'];
                $apartment_id = $row['apartment_id'];
                $images = getApartmentImage($connect, "apartment_images", "apartment_id", $apartment_id);
                $name =  $row['name'];
                $preferred_chek_in = $row['preferred_chek_in'];
                $preferred_chek_out = $row['preferred_chek_out'];
                $no_of_guest = $row['no_of_guest'];
                
                array_push($allwishlist, array(
                    'id'=>$id,
                    'wishlist_id' => $wishlist_id,
                    'name' => $name,
                    'apartment_id' => $apartment_id,
                    'preferred_chek_in' => $preferred_chek_in,
                    'preferred_chek_out' => $preferred_chek_out,
                    'no_of_guest' => $no_of_guest,
                    'images' => $images
                ));
            }
            $data = array(
                'page' => $page_no,
                'per_page' => $no_per_page,
                'total_data' => $total_num_row,
                'totalPage' => $total_pg_found,
                'facilities' => $allwishlist
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