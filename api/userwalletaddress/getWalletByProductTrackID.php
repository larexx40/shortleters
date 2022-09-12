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

    // check if the right request was sent
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

        // check if user is admin
        if (!checkIfIsAdmin($connect, $user_pubkey) ){
            // send user not found response to the user
            $errordesc =  "Not Authorized";
            $linktosolve = 'https://';
            $hint = "Only authorized users can access this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !isset($_POST['producttrackid'])) {

            $errordesc="producttrack id is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="product track id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $producttrackid = cleanme($_POST['producttrackid']);
        }

        // pagination and search parameters
        if (isset($_POST['search'])) {
            $search = cleanme($_POST['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        
        $no_per_page = 10;
        $offset = ($page_no - 1) * $no_per_page;

        if (!empty($search) && $search != "" && $search != " "){
            $searching = "%{$search}%";
            // get the total number of pages
            $query = "SELECT
            userwalletaddresses.id,
            userwalletaddresses.userid,
            userwalletaddresses.cointype,
            userwalletaddresses.useraddress,
            userwalletaddresses.producttrackid,
            coinproducts.name AS coin_name,
            memo,
            systemlivewallet,
            liveaddressid,
            redeemscript,
            wallettrackid,
            walletbal,
            userwalletaddresses.created_at
        FROM
            `userwalletaddresses`
        LEFT JOIN users ON userwalletaddresses.userid = users.id
        LEFT JOIN coinproducts ON userwalletaddresses.producttrackid = coinproducts.producttrackid
        WHERE
            users.lname LIKE ? OR users.fname LIKE ? OR coinproducts.name LIKE ? OR memo LIKE ? AND userwalletaddresses.producttrackid = ? ";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("sssss", $searching, $searching, $searching, $searching, $producttrackid);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT
            userwalletaddresses.id,
            userwalletaddresses.userid,
            userwalletaddresses.cointype,
            userwalletaddresses.useraddress,
            userwalletaddresses.producttrackid,
            coinproducts.name AS coin_name,
            memo,
            systemlivewallet,
            liveaddressid,
            redeemscript,
            wallettrackid,
            walletbal,
            userwalletaddresses.created_at
        FROM
            `userwalletaddresses`
        LEFT JOIN users ON userwalletaddresses.userid = users.id
        LEFT JOIN coinproducts ON userwalletaddresses.producttrackid = coinproducts.producttrackid
        WHERE
            users.lname LIKE ? OR users.fname LIKE ? OR coinproducts.name LIKE ? OR memo LIKE ? AND userwalletaddresses.producttrackid = ? LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sssssss", $searching,  $searching, $searching, $searching, $producttrackid ,$offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allWallet = [];

                while($row = $result->fetch_assoc()){
                
                    $id = $row['id'];
                    $user_id = $row['userid'];
                    $userFulname = getUserFullname($connect, $row['userid']);
                    $cointype = $row['cointype'];
                    $useraddress = $row['useraddress'];
                    $producttrackid = $row['producttrackid'];
                    $coin_name = $row['coin_name'];
                    $memo = $row['memo'];
                    $systemlivewallet = $row['systemlivewallet'];
                    $liveaddressid = $row['liveaddressid'];
                    $redeemscript = $row['redeemscript'];
                    $wallettrackid = $row['wallettrackid'];
                    $walletbal = $row['walletbal'];
                    $created = $row['created_at'];
                    
                    array_push($allWallet, array("id"=>$id, 
                    "user_id"=>$user_id, "userFullName"=>$userFulname, "cointype"=>$cointype, "useraddress"=>$useraddress, "producttrackid"=>$producttrackid, 
                    "coin_name"=>$coin_name, "memo"=>$memo , "systemlivewallet"=>$systemlivewallet,  "liveaddressid"=>$liveaddressid, "redeemscript"=>$redeemscript,
                    "wallettrackid"=>$wallettrackid, "walletbal"=>$walletbal, "created_at"=>$created));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'wallets' => $allWallet
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "Record not found";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

            }
        }else{
            $query = "SELECT
            userwalletaddresses.id,
            userwalletaddresses.userid,
            userwalletaddresses.cointype,
            userwalletaddresses.useraddress,
            userwalletaddresses.producttrackid,
            coinproducts.name AS coin_name,
            memo,
            systemlivewallet,
            liveaddressid,
            redeemscript,
            wallettrackid,
            walletbal,
            userwalletaddresses.created_at
        FROM
            `userwalletaddresses`
        LEFT JOIN coinproducts ON userwalletaddresses.producttrackid = coinproducts.producttrackid
        WHERE
        userwalletaddresses.producttrackid = ?";
            $getSearchPages = $connect->prepare($query);
            $getSearchPages->bind_param("s", $producttrackid);
            $getSearchPages->execute();
            $result = $getSearchPages->get_result();
            $num_row = $result->num_rows;
            $totalPage = ceil($num_row / $no_per_page);  

            // Output page
            $query = "SELECT
            userwalletaddresses.id,
            userwalletaddresses.userid,
            userwalletaddresses.cointype,
            userwalletaddresses.useraddress,
            userwalletaddresses.producttrackid,
            coinproducts.name AS coin_name,
            memo,
            systemlivewallet,
            liveaddressid,
            redeemscript,
            wallettrackid,
            walletbal,
            userwalletaddresses.created_at
        FROM
            `userwalletaddresses`
        LEFT JOIN coinproducts ON userwalletaddresses.producttrackid = coinproducts.producttrackid
        WHERE
            userwalletaddresses.producttrackid = ? 
        LIMIT ?, ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("sss", $producttrackid, $offset, $no_per_page);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){
                $allWallet = [];

                while($row = $result->fetch_assoc()){
                
                    $id = $row['id'];
                    $user_id = $row['userid'];
                    $userFulname = getUserFullname($connect, $row['userid']);
                    $cointype = $row['cointype'];
                    $useraddress = $row['useraddress'];
                    $producttrackid = $row['producttrackid'];
                    $coin_name = $row['coin_name'];
                    $memo = $row['memo'];
                    $systemlivewallet = $row['systemlivewallet'];
                    $liveaddressid = $row['liveaddressid'];
                    $redeemscript = $row['redeemscript'];
                    $wallettrackid = $row['wallettrackid'];
                    $walletbal = $row['walletbal'];
                    $created = $row['created_at'];
                    
                    array_push($allWallet, array("id"=>$id, 
                    "user_id"=>$user_id, "userFullName"=>$userFulname, "cointype"=>$cointype, "useraddress"=>$useraddress, "producttrackid"=>$producttrackid, 
                    "coin_name"=>$coin_name, "memo"=>$memo , "systemlivewallet"=>$systemlivewallet,  "liveaddressid"=>$liveaddressid, "redeemscript"=>$redeemscript,
                    "wallettrackid"=>$wallettrackid, "walletbal"=>$walletbal, "created_at"=>$created));
                }

                $data = array(
                    'totalPage' => $totalPage,
                    'wallets' => $allWallet
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "No records";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);

            }
        }

        
            

            
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


