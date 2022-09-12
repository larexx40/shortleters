<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    //include ("../apifunctions.php");
    include "../connectdb.php";
    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']);


    if($method =='GET'){
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


        $admin = checkIfIsAdmin($connect, $userpubkey);
        $userid = checkIfUser($connect, $userpubkey);

        if(!$admin && !$userid ){
            // send user not found response to the user
            $errordesc =  "User not registered";
            $linktosolve = 'https://';
            $hint = "Create account ";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        
        if ($admin){
            if (isset($_GET['user_id'])) {
                $userid = cleanme($_GET['user_id']);

                if (!is_numeric($userid)){
                    $errordesc =  "Invalid User id Passed";
                    $linktosolve = 'https://';
                    $hint = "Pass a valid user id";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                    respondBadRequest($data);
                }
            } else {
                $errordesc =  "User id not passed";
                $linktosolve = 'https://';
                $hint = "Pass a valid user id";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                respondBadRequest($data);
            }
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
    
        if (!empty($search) && $search!="" && $search!=' '){
            //search productCategory from database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT productorders.id, productorders.user_id, users.fname AS firstname, users.lname AS lastname, productorders.order_refno, productorders.product_id, products.name AS product_name, products.weight, productorders.price, productorders.quantity
                            FROM `productorders` LEFT JOIN users ON productorders.user_id = users.id LEFT JOIN products ON productorders.product_id = products.id
                            WHERE ( productorders.order_refno LIKE ? OR products.name like ? OR users.fname LIKE ? OR users.lname LIKE ?) AND productorders.user_id = ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sssss",  $searchParam, $searchParam, $searchParam, $searchParam, $userid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "SELECT productorders.id, productorders.user_id, users.fname AS firstname, users.lname AS lastname, productorders.order_refno, productorders.product_id, products.name AS product_name, products.weight, productorders.price, productorders.quantity
                            FROM `productorders` LEFT JOIN users ON productorders.user_id = users.id LEFT JOIN products ON productorders.product_id = products.id
                            WHERE ( productorders.order_refno LIKE ? OR products.name like ? OR users.fname LIKE ? OR users.lname LIKE ?) AND productorders.user_id= ? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sssssss",  $searchParam,$searchParam, $searchParam, $searchParam, $userid,$offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;  
        }else {
            //get all data
            $sqlQuery = "SELECT productorders.id, productorders.user_id, users.fname AS firstname, users.lname AS lastname, productorders.order_refno, productorders.product_id, products.name AS product_name, products.weight, productorders.price, productorders.quantity
                        FROM `productorders` LEFT JOIN users ON productorders.user_id = users.id LEFT JOIN products ON productorders.product_id = products.id  
                        WHERE productorders.user_id = ? ORDER BY id DESC";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("s", $userid);
            $stmt->execute();
            $result= $stmt->get_result();
            $total_numRow = $result->num_rows;
            $pages = ceil($total_numRow / $noPerPage);
            //echo $numRow;

            $sqlQuery = "SELECT productorders.id, productorders.user_id, users.fname AS firstname, users.lname AS lastname, productorders.order_refno, productorders.product_id, products.name AS product_name, products.weight, productorders.price, productorders.quantity
                        FROM `productorders` LEFT JOIN users ON productorders.user_id = users.id LEFT JOIN products ON productorders.product_id = products.id  
                        WHERE productorders.user_id = ? ORDER BY id DESC LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("sss", $userid, $offset, $noPerPage);
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
        //return fetched data as array
        if($numRow > 0){
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $orderRefno = $row['order_refno'];
                $userid = $row['user_id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $productid = $row['product_id'];
                $productName = $row['product_name'];
                $weight = $row['weight'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $amount = $price * $quantity;
                array_push($allResponse,array("id"=>$id,"orderRefno"=>$orderRefno, "weight"=>$weight, "userid"=>$userid,"firstname"=>$firstname,"lastname"=>$lastname,"productid"=>$productid,"productName"=>$productName, "price"=>$price, "quantity"=>$quantity, "amount"=>$amount));
            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'orders'=> $allResponse
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
            $text = "Record Not Found";
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