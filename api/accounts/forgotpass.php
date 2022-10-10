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

    // check if the right request was sent
    if ($method == 'POST') {
        // Check if the userIdentity field is passed
        if (!isset($_POST['userIdentity'])){
            $errordesc = "userIdentity fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required userIdentity field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            // sanitize the userIdentity being sent by the user
            $userIdentity = cleanme($_POST['userIdentity']);

            // check if the userIdentity field is not empty
            if ( empty($userIdentity) ){
                $errordesc = "Insert all fields";
                $linktosolve = 'https://';
                $hint = "Kindly pass value to the email and password field in this register endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            

            // check the identity of the user whether its an email or phone number
            //sent error response if userIdentity sent is not an email or phone number
            $verifyType = checkIsEmailorPhone($userIdentity);
            if(!$verifyType){
                $errordesc = "Invalid email or phone number";
                $linktosolve = 'https://';
                $hint = "Kindly pass an email or phone number in identity field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            // check if the user does not exist in the database
            $query = 'SELECT * FROM users WHERE email = ? OR phoneno = ?';
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ss", $userIdentity, $userIdentity);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_row = $result->num_rows;

            if ( $num_row < 1){

                // send user not found response to the user
                $errordesc =  "Account with user not found";
                $linktosolve = 'https://';
                $hint = "User is not in the database ensure the user is in the database";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            
            }else{
                $row = $result->fetch_assoc();
                $user_id = $row['id'];
                $firstname = $row['fname'];
                $stmt->close();

                // set expireTime of the token to 5 minutes
                $expiresin = "5";

                // generate token and insert it into the token table
                $token = generateUniqueNumericKey($connect, "token", "token", 6);
                $created_time = new DateTimeImmutable();
                $expiretime = $created_time->modify("+$expiresin minutes")->getTimestamp();

                $tokenQuery = 'INSERT INTO token (user_id, useridentity, token, time, verifytype) Values (?, ?, ?, ?, ?)';
                $tokenStmt = $connect->prepare($tokenQuery);
                $tokenStmt->bind_param("sssss", $user_id, $userIdentity, $token, $expiretime, $verifyType);


                // check if statement executes 
                if ($tokenStmt->execute()){
                    $tokenStmt->close();
                    $tokenlink = $resetLink. "?token=".$token;

                    
                    if ($verifyType == 1){
                        $emailFrom = "noreply@Shortleters.ng";
                        $subject = "Reset Password Request ";
                        $toemail = $userIdentity;
                        
                        $msgintext = "Hello Mr  $firstname,\n
                        Kindly use this $token to reset your password or
                        follow this link to reset your password on Shortleters.ng \n $tokenlink \n
                        If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                        
                        $msginHtml = "Hello Mr  $firstname,<br>
                        Kindly use this $token to reset your password or <br>
                        follow this link to reset your password on Shortleters.ng <br> $tokenlink <br>
                        If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                    

                        //$mailsent = sendUserMail($subject, $toemail, $msgintext, $msginHtml);
                        
                        $text= "Reset password link successfully sent to your mail";
                        $status = true;
                        $data = ['tokenlink'=>$tokenlink];
                        $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                        respondOK($successData);
                        
                    }

                    if ($verifyType == 2){

                        $smstosend = "Hello Mr  $firstname,\n
                        Kindly ust this OTP to reset your password on Shortleters.ng \n $token \n
                        If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                        
                        
                        

                        $sent = sendUserSMS($userIdentity, $smstosend);

                        if ($sent){

                            $text= "OTP sent to your phone";
                            $status = true;
                            $data = [];
                            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                            respondOK($successData);

                        }

                    }


                    
                }else{
                    // send internal error response
                    $errordesc =  $tokenStmt->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondInternalError($data);
                }
                
                
            }
            
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