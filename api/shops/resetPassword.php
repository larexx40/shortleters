<?php
    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']);
    
    //allow only post method
    if (getenv('REQUEST_METHOD') === 'POST'){
        //Get company private key
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        // $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        // $userpubkey = $decodeToken->usertoken;

        // // cheeck if it thesuper admin
        //  //check if user is admin
        // if(!checkIfIsAdmin($connect, $userpubkey)){
        //     //respond not admin
        //     $errordesc =  "User not a registered admin";
        //     $linktosolve = 'https://';
        //     $hint = "Only registered admin has the ability to access this route";
        //     $errorData = returnError7003($errordesc, $linktosolve, $hint);
        //     $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        //     respondBadRequest($data);
        // }
        // $adminid =checkIfIsAdmin($connect, $userpubkey);

        //collect input and validate it
        if(!isset($_POST['password'])){
            $errordesc="Password required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input password";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $password = cleanme($_POST['password']);
        }
        //check if password is strong
        if(!validatePassword($password)){
            // Check if password is strong enough
            $errordesc = "Password doesn't contain necessary characters";
            $linktosolve = 'https://';
            $hint = "Password field must contain uppercase, lowercase, a number, special characters and also must be more than 8 characters";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        if (isset($_POST['token'])) {
            $token = cleanme($_POST['token']);
        }else{
            $errordesc="Token required";
            $linktosolve="htps://";
            $hint=["Check your Email or Phone for Token","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="pass in token in the token field";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }

        //check if empty('') return true
        if(empty($password) || empty($token)){
            $errordesc="input cannot be empty";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input Username and Password";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            //check if token exist
            $user_type = 2;
            $sql = "SELECT * FROM token WHERE token =? AND user_type = ?";
            $getToken = $connect->prepare($sql);
            $getToken->bind_param('ss', $token, $user_type);
            $getToken->execute();
            $result = $getToken->get_result();

            if($result->num_rows > 0){
                //then check expiry
                $row = $result->fetch_assoc();
                $expiredAt = $row['time'];
                $currentTime = time();

                if($expiredAt >= $currentTime){//Token not expire
                    //update password using email or phone;
                    $hashPassword = Password_encrypt($password);
    
                    //update password using email
                    $email = $row['useridentity'];
                    $sql = "UPDATE shops SET password = ? WHERE shop_email =?";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ss', $hashPassword, $email);
                    $stmt->execute();
                    if($stmt->affected_rows >0 ){
                        //affected row = 0/you input same value or email not found
                        //-1 db error
                        //password updated
                        $maindata=[];
                        $errordesc = " ";
                        $linktosolve = "htps://";
                        $hint = [];
                        $errordata = [];
                        $text = "Password Updated, Proceed to login";
                        $status = true;
                        $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                        respondOK($data);
                    }else{
                        //invalid input/ server error
                        $errordesc= $stmt->error;
                        $linktosolve="htps://";
                        $hint=["Ensure to send valid data or data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                        $errordata=returnError7003($errordesc,$linktosolve,$hint);
                        $text="invalid phoneno or DB issue";
                        $method=getenv('REQUEST_METHOD');
                        $data=returnErrorArray($text,$method,$endpoint,$errordata);
                        respondBadRequest($data);
                    }
                }else{//expired token
                    //return response expired expired
                    $errordesc="Token Expired";
                    $linktosolve="htps://";
                    $hint=["Generate another token","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="Fill in valid token";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }
            }else{
                //invalid token
                $errordesc="Incorrect token";
                $linktosolve="htps://";
                $hint=["Input token sent to your email or phone","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Incorrect token, Fill in valid token";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }
        }

    }else {
        //method not allowed
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