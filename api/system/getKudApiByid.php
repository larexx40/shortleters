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
        // $detailsID =1;
        // $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        // $getCompanyDetails->bind_param('i', $detailsID);
        // $getCompanyDetails->execute();
        // $result = $getCompanyDetails->get_result();
        // $companyDetails = $result->fetch_assoc();
        // $companyprivateKey = $companyDetails['privatekey'];
        // $minutetoend = $companyDetails['tokenexpiremin'];
        // $serverName = $companyDetails['servername'];

        // $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        // $userpubkey = $decodeToken->usertoken;

        // if  (!checkIfIsAdmin($connect, $pubkey) ){

        //     // send user not found response to the user
        //     $errordesc =  "User not an Admin";
        //     $linktosolve = 'https://';
        //     $hint = "Only Admin has the ability to add send grid api details";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        //     respondBadRequest($data);
        // }

        if (!isset($_GET['id'])) {
            $errordesc =  "Api id not passed";
            $linktosolve = 'https://';
            $hint = "pass id of api you want to get";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        } else {
            $api_id = cleanme($_GET['id']);
        }

        if (!is_numeric($api_id) ){
            // send response if the id passed isn't numeric
            $errordesc = "Invalid id passed";
            $linktosolve = 'https://';
            $hint = "id is always numeric, Kindly pass valid id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        if(empty($id)){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require address information";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else {
            //get data where id =?
            $squlQuery = "SELECT * FROM `kudiapidetails` WHERE `id`= ?";
            $stmt = $connect->prepare($squlQuery);
            $stmt->bind_param("s",$id);
            $stmt->execute();  
            $result = $stmt->get_result();

            //check for db error // connection lost
            if($stmt->execute()){
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
                $response = [];
                $row = $result->fetch_assoc();
                $username = $row['username'];
                $sendfrom = $row['sendfrom'];
                $status = $row['status'];
                $name = $row['name'];
                array_push($response, array("username"=>$username, "name"=>$name, "status"=>$status, "sendfrom"=>$sendfrom));

                $maindata['apidata']= $response;
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
                // incorrect email
                $errordesc="Record not found";
                $linktosolve="htps://";
                $hint=["pass in valid id"];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="data with id not found";
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