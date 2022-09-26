<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../cartsfunction.php";
    
    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');
    $maindata =[];

    if ($method == 'POST') {
        // Check if the phone field is passed
        if (!isset($_POST['token'])){
            $errordesc = "Signup token must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required token field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $token = cleanme($_POST['token']);
        }     

        // check if phoneno is empty
        if ( empty($token) ){
            $errordesc = "Insert token fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the email and password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        //check if token exist
        $sql = "SELECT * FROM token WHERE token = ?";
        $getToken = $connect->prepare($sql);
        $getToken->bind_param('s', $token);
        $getToken->execute();
        $result = $getToken->get_result();

        if($result->num_rows > 0){
            //then check expiry
            $row = $result->fetch_assoc();
            $expiredAt = $row['time'];
            $identity= $row['useridentity'];
            $verifytype = $row['verifytype'];
            $currentTime = time();

            if($expiredAt >= $currentTime){
                //valid token
                $userpubkey = generateUserPubKey($connect, 'users');
                if($verifytype == 1){
                    $getToken->close();
                    //email
                    //create user with email only
                    $sql = "INSERT INTO users (email, userpubkey) Values (?, ?)'";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ss', $identity, $userpubkey);
                    $createUser = $stmt->execute();
                }
                if($verifytype == 2){
                    $getToken->close();
                    //phoneno
                    //create user with phone number only
                    $sql = "INSERT INTO users (phoneno, userpubkey) Values (?, ?)";
                    $stmt = $connect->prepare($sql);
                    $stmt->bind_param('ss', $identity, $userpubkey);
                    $createUser = $stmt->execute();
                }
                if($createUser){
                    $maindata = [];
                    $errordesc = "";
                    $linktosolve = "htps://";
                    $hint = [];
                    $errordata = [];
                    $text = "User created";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondOK($data);
                }

            }else{
                //token expired
                $errordesc="Token Expired";
                $linktosolve="htps://";
                $hint=["Generate another token","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Token Expired";
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
            $text="Token not exist, Fill in valid token";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }

        
      
    }else{
        
        // Send an error response because a wrong method was passed 
        $errordesc = "Method not allowed";
        $linktosolve = 'https://';
        $hint = "This route only accepts POST request, kindly pass a post request";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
        respondMethodNotAlowed($data);
    }
    
?>