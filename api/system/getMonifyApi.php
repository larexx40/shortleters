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
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);


    if($method =='POST'){
        //confirm to generate key
        if (isset($_GET['search'])) {
            $search = cleanme($_POST['search']);
        } else {
            $search = "";
        }
    
        if (!isset ($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        }
        $noPerPage = 4;  
        $offset = ($page_no - 1) * $noPerPage;
    
        if (!empty($search) && $search!="" && $search!=' '){
            //search for data in database 
            $searchParam = "%{$search}%";
            $searchQuery = "SELECT * FROM `monifyapidetails` WHERE `name` like ? OR `apimerchant`, like ? OR `apiwallet` like ?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;
            $pages = ceil($numRow / $noPerPage);

            //paginate the fetch data
            $searchQuery = "SELECT * FROM `monifyapidetails` WHERE `name` like ? OR `apimerchant`, like ? OR `apiwallet` like ? LIMIT ?,?";
            $stmt= $connect->prepare($searchQuery);
            $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam, $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;

        }else {
            //get all data in database
            $sqlQuery = "SELECT * FROM `monifyapidetails`";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;
            $pages = ceil($numRow / $noPerPage);
            //echo $numRow;

            $sqlQuery = "SELECT * FROM `monifyapidetails` LIMIT ?,?";
            $stmt= $connect->prepare($sqlQuery);
            $stmt->bind_param("ss", $offset, $noPerPage);
            $stmt->execute();
            $result= $stmt->get_result();
            $numRow = $result->num_rows;
        } 
        //retuurn fetched data as array
        if($numRow > 0){
            $allResponse = [];
            while($data = $result->fetch_assoc()){
                $secretekey = $data['secretekey'];
                $apikey = $data['apikey'];
                $status = $data['status'];
                $name = $data['name'];
                $apimerchant = $data['apimerchant'];
                $apiwallet = $data['apiwallet'];
                $apiaccno = $data['apiaccno'];
                array_push($allResponse,array("secretekey"=>$secretekey, "apikey"=>$apikey, "status"=>$status, "name"=>$name, "apimerchant"=>$apimerchant, "apiwallet"=>$apiwallet, "apiaccno"=>$apiaccno));
            }
            $maindata['userdata']=$allResponse;
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
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Record Not Found";
            $method = getenv('REQUEST_METHOD');
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
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