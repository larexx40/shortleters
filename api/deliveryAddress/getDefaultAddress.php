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
        
        $userid = checkIfUser($connect, $userpubkey);
        $adminid =checkIfIsAdmin($connect, $userpubkey);

        if(!$userid && !$adminid){
            //return respond user not authorized
            $errordesc =  "User not allowed";
            $linktosolve = 'https://';
            $hint = "Only Admin and User can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data); 
        }

        if($adminid){
            if(!isset($_GET['userid'])){
                $errordesc="pass in user id";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Pass in userid";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
                
            }else {
                $userid = cleanme($_GET['userid']);    
            }
        }

        if(empty($userid)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require address information";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $status = "1";
            $query = "SELECT * FROM `deliveryaddress` WHERE `defultaddress` = ? AND `userid` = ?";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ss", $status, $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            
            //check for db error || connection lost
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

            if($result->num_rows > 0){
                //pass fetched data as array maindata[]
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $userid = $row['userid'];
                $lga = $row['lga'];
                $phoneno = $row['phoneno'];
                $fullname = $row['fullname'];
                $state = $row['state'];
                $country = $row['country'];
                $zipcode = $row['zipcode'];
                $address = $row['address'];
                $addressno = $row['address_no'];
                $defultaddress = $row['defultaddress'];
                $maindata =[
                    "id"=>$id, "userid"=>$userid, "lga"=>$lga, 
                    "phoneno"=>$phoneno, "fullname"=>$fullname,
                    "state"=>$state, 
                    "country"=>$country, "zipcode"=>$zipcode, 
                    "address"=>$address, "addressno"=>$addressno, 
                    "defultaddress"=>$defultaddress
                ];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint =[];
                $errordata =[];
                $text = "Data found";
                $method = getenv('REQUEST_METHOD');
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);

            }else{
                // incorrect email
                $errordesc="Record not found";
                $linktosolve="htps://";
                $hint=["pass in valid id"];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="logistics with id not found";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
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