<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    //header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";
    //include "../connectdb.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);

    if ($method == 'GET') {
        //Collect userpubkey from header
        //use pubkey to fetch details
        //send details as response to be passed to updateprofile text field
        //get companydetalis and servername for auth token
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];
        $getCompanyDetails->close();

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userpubkey = $decodeToken->usertoken;


        // if(!isset($_GET['userpubkey'])){
        //     $errordesc="User Public Key required";
        //     $linktosolve="htps://";
        //     $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
        //     $errordata=returnError7003($errordesc,$linktosolve,$hint);
        //     $text="Pass in userpubkey";
        //     $method=getenv('REQUEST_METHOD');
        //     $data=returnErrorArray($text,$method,$endpoint,$errordata);
        //     respondBadRequest($data);
            
        // }else {
        //     $userpubkey = cleanme($_GET['userpubkey']);
        // }
        $sqlQuery = "SELECT fname, lname, phoneno, state, country, dob, sex FROM users WHERE userpubkey = ?";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $userpubkey);
        $stmt->execute();
        $result= $stmt->get_result();
        $stmt->close();
        
        if($result->num_rows > 0){
            $row=$result->fetch_assoc();
            //user exist
            $firstName = $row['fname'];
            $lastName = $row['lname'];
            $phoneno = $row['phoneno'];
            $state = $row['state'];
            $country = $row['country'];
            $dob = $row['dob'];
            $sex = $row['sex'];

            $maindata = [
                    "Firstname"=>$firstName,
                    "Lastname"=>$lastName,
                    "phoneno" => $phoneno,
                    "State"=>$state,
                    "Country"=>$country,
                    "sex"=>$sex,
                    "dob"=>$dob
            ];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "User Details Fetched";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else {
            //pubkey does not exist
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid Userpubkey", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="User Public Key does not exist";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
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