<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']);

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

        if(!checkIfIsAdmin($connect,$userpubkey)){
            // send user not found response to the user
            $errordesc =  "User not a shop owner";
            $linktosolve = 'https://';
            $hint = "Only shop owner can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        $adminid = checkIfIsAdmin($connect,$userpubkey);

        //confirm how to pass in the id
        if(!isset($_GET['id'])){
            $errordesc="id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in  id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $id = cleanme($_GET['id']); 
        }

        
        if (empty($id)){
            // send error if draft is empty
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Blog id cannot be empty";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            //check if blog exist
            $query = 'SELECT * FROM blog WHERE id = ?';
            $stmt = $connect->prepare($query);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_row = $result->num_rows;
    
            if($stmt->error){
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
            if ($num_row > 0){
                $hide = 0;
                $show = 1;

                //check the draft
                $row = $result->fetch_assoc();
                $draft = $row['draft'];

                if($draft == 1){
                    //.....change draft to 0 (hide)
                    $sql = "UPDATE `blog` SET `draft`= ? WHERE id = ?";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ss', $hide, $id);
                    $stmt->execute();

                    if ( $stmt->affected_rows > 0 ){
                        $maindata=[];
                        $errordesc = " ";
                        $linktosolve = "htps://";
                        $hint = "Blog draft set to 0 ";
                        $errordata = [];
                        $text = "Blog hidden from user";
                        $status = true;
                        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                        respondOK($data);
                    
                    }
                }else{
                    //.....change draft to 1 (show)
                    $sql = "UPDATE `blog` SET `draft`= ? WHERE id = ?";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ss', $show, $id);
                    $stmt->execute();

                    if ( $stmt->affected_rows > 0 ){
                        $maindata=[];
                        $errordesc = " ";
                        $linktosolve = "htps://";
                        $hint = "Blog draft set to  ";
                        $errordata = [];
                        $text = "User can view blog";
                        $status = true;
                        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                        respondOK($data);
                    
                    }
                }

            

            }else{
                //blog not found
                $errordesc = "Blog with id not found";
                $linktosolve = 'https://';
                $hint = "Kindly pass valid blog id";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
                respondBadRequest($data); 
            }

        }

    }else{
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