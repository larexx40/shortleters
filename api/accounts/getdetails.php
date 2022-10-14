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
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']); 
    $maindata = []; 

    if (getenv('REQUEST_METHOD')== 'GET') {
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

        $user_id = getUserWithPubKey($connect, $userpubkey);

        // get user status
        $status = 1;

        //get records from user and delivery address table
        //get user details
        $getUser = $connect->prepare("SELECT * FROM users WHERE userpubkey = ? AND status = ?");
        $getUser->bind_param("ss",$userpubkey, $status);
        $getUser->execute();
        $result = $getUser->get_result();

        if($result->num_rows > 0){
            //user exist
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $email = $row['email'];
            $firstname = $row['fname'];
            $lastname = $row['lname'];
            $phoneno = $row['phoneno'];
            $location = $row['location'];
            $balance = $row['bal'];
            $refcode = $row['refcode'];
            $state = $row['state'];
            $country = $row['country'];
            $username = $row['username'];
            $agent = $row["is_agent"];
            $dob = $row['dob'];
            $sex = $row['sex'];
            $created = gettheTimeAndDate(strtotime($row['created_at']));
            $updated = gettheTimeAndDate(strtotime($row['updated_at']));
            $referredBy = ( getUserFullname($connect, $row['referby']) ) ? getUserFullname($connect, $row['referby']) : "";
            $statusCode = $row['status'];
            if ($row['status'] == 0){
                $userStatus = "Banned";
            }
            if ($row['status'] == 1){
                $userStatus = "Active";
            }
            if ($row['status'] == 2){
                $userStatus = "Suspended";
            }
            if ($row['status'] == 3){
                $userStatus = "Frozen";
            }
            $adminSeen = $row['adminseen'];
            $adminCheck = ($row['adminseen'] == 0) ? "Not seen" : "Seen";


            $maindata = [
                'id' => $id,
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phoneno' => $phoneno,
                'location' => $location,
                'balance' => $balance,
                'refcode' => $refcode,
                'state' => $state,
                'country' => $country,
                'status_code' => $statusCode,
                'status' => $userStatus,
                'status' => $userStatus,
                'agent' => $agent,
                'admin_seen_code' => $adminSeen,
                'admin_seen' => $adminCheck,
                'username' => $username,
                'referredBy' => $referredBy,
                'dob' => $dob,
                "sex" => $sex,
                'created' => $created,
                'updated' => $updated
            ];
            $errordesc = "";
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