<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";
    //include "../connectdb.php";
    
    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']); 
    $maindata = []; 

    if (getenv('REQUEST_METHOD')== 'GET') {
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

        $adminid = checkIfIsAdmin($connect, $userpubkey);

        if( !$adminid ){
            // send Admin not found response
            $errordesc =  "Admin  not found";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }
        
        
        //get Admin details
        $getAdmin = $connect->prepare("SELECT id, email, `name`, username, `status`, superadmin FROM admin WHERE id = ?");
        $getAdmin->bind_param("s",$adminid);
        $getAdmin->execute();
        $result = $getAdmin->get_result();

        if($result->num_rows > 0){
            //user exist
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $email =$row['email'];
            $name = $row['name'];
            $username = $row['username'];
            $status = $row['status'];
            if($status == 1){
                $status = 'Active';
            }else{
                $status = 'Inactive';
            }
            $superAdmin = $row['superadmin'];
            if($superAdmin == 0){
                $superAdmin = 'No';
            }
            if($superAdmin == 1){
                $superAdmin = 'Yes';
            }
            $getAdmin->close();

            $maindata = [
                "id"=>$id,
                "Email"=>$email,
                "name"=>$name,
                "status"=>$status,
                "Username"=>$username,
                "superadmin"=>$superAdmin,
            ];
            $errordesc = "";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Admin Details Fetched";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);

        }else {
            //pubkey does not exist
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure to send valid Userpubkey", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="User does not exist";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
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