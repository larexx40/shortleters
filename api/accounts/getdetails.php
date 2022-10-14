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

        //user exist
        if($result->num_rows > 0){
            $getUser->close();
            
            $row = $result->fetch_assoc();
            $id=$row['id'];
            $email =$row['email'];
            $firstName = $row['fname'];
            $lastName = $row['lname'];
            $username = $row['username'];
            $fullname = $row['fname']." ".$row['lname'];
            $balance = $row['bal'];
            $phoneno = $row['phoneno'];
            $state = $row['state'];
            $country = $row['country'];
            $dob = $row['dob'];
            $sex = $row['sex'];
            if($sex== 1){
                $gender = "Male";
            }elseif($sex== 2){
                $gender = "Female";
            }else{
                $gender = "Others";
            }
            $refcode = $row['refcode'];
            $verified = $row['verified'];
            $validid = $row['validid'];
            if($validid == ''){
                $identity = 'Not Provided';
            }
            $identity_details = ($validid)? getValidIdentityDetails($connect, $validid): null;
            $validid_status = ($identity_details)? $identity_details['status']: null;$address = $row['address'];
            $address = $row['address'];
            $state = $row['state'];
            $country = $row['country'] ;
            $zipCode = $row['zipcode'];
            

            //get default delivery address
            // $default = 1;
            // $getAddress = $connect->prepare("SELECT * FROM deliveryaddress WHERE defultaddress = ? AND userid = ?");
            // $getAddress->bind_param("ss",$default, $user_id);
            // $getAddress->execute();
            // $result = $getAddress->get_result();

            //     //get delivery address
            //     $row = $result->fetch_assoc();
            //     $addressno = ( $row ) ? $row['address_no'] : "";
                
            //     $lga = ( $row ) ? $row['lga'] : "";
            
            //     $getAddress->close();

            $maindata = [
                "userid"=>$id,
                "Email"=>$email,
                "Firstname"=>$firstName,
                "Lastname"=>$lastName,
                "fullname" => $fullname,
                "Username"=>$username,
                "Fullname"=>$fullname,
                "phone" => $phoneno,
                "balance"=>$balance,
                // "Addressno"=> $addressno,
                // "address_state" => $address_state,
                // "address_country" => $address_country,
                // "Local government"=> $lga ,
                "State"=>$state,
                "Country"=>$country,
                "sex" => $sex,
                'gender'=>$gender,
                'dob' => $dob,
                // "Zipcode"=>$zipCode,
                "refcode" => $refcode,
               'verified'=> $verified,
               'validid'=>$validid,
               'identity_details'=>$identity_details,
               'validid_status'=>$validid_status,
               'identity'=>$identity,
               "address"=> $address,
               'state'=>$state,
               'country'=>$country,
               'zipcode'=>$zipCode,
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