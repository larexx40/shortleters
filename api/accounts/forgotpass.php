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
        // Check if the username field is passed
        if (!isset($_POST['username'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required username field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            // sanitize the username being sent by the user
            $username = cleanme($_POST['username']);

            // check if the username field is not empty
            if ( empty($username) ){
                $errordesc = "Insert all fields";
                $linktosolve = 'https://';
                $hint = "Kindly pass value to the email and password field in this register endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            //sent error response if username sent is not an email or phone number
            if (!checkIfUsernameisEmailorPhone($username)) {
        
                $errordesc = "Invalid username";
                $linktosolve = 'https://';
                $hint = "Kindly pass an email or phone number in the username field in this endpoint";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
        
            }

            // get the identity of the user whether its an email or phone number
            $user_identity = checkIfUsernameisEmailorPhone($username);

            // check if the user does not exist in the database
            $query = 'SELECT * FROM users WHERE email = ? OR phoneno = ?';
            $stmt = $connect->prepare($query);
            $stmt->bind_param("ss", $username, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_row = $result->num_rows;

            if ( $num_row < 1){

                // send user not found response to the user
                $errordesc =  "User not found";
                $linktosolve = 'https://';
                $hint = "User is not in the database ensure the user is in the database";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            
            }else{
                $row =  mysqli_fetch_assoc($result);
                $user_id = $row['id'];
                $firstname = $row['fname'];
                $stmt->close();

                // set expireTime of the token to 5 minutes
                $expiresin = "5";

                // generate token and insert it into the token table
                $token = generateUniqueShortKey($connect, "token", "token");
                $created_time = new DateTimeImmutable();
                $expiretime = $created_time->modify("+$expiresin minutes")->getTimestamp();
                $verifyType = setVerifyType($user_identity);

                $tokenQuery = 'INSERT INTO token (user_id, useridentity, token, time, verifytype) Values (?, ?, ?, ?, ?)';
                $tokenStmt = $connect->prepare($tokenQuery);
                $tokenStmt->bind_param("issii", $user_id, $username, $token, $expiretime, $verifyType);


                // check if statement executes 
                if ($tokenStmt->execute()){
                    $tokenStmt->close();
                    $tokenlink = $resetLink. "?token=".$token;

                    
                    if ($user_identity == 'email'){
                        $emailFrom = "noreply@cart.ng";
                        $subject = "Reset Password Request ";
                        $toemail = $username;
                        
                        $msgintext = "Hello Mr  $firstname,\n
                        Kindly follow this link to reset your password on cart.ng \n $tokenlink \n
                        If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                        
                        $msginHtml = "Hello Mr  $firstname,<br>
                        Kindly follow this link to reset your password on cart.ng <br> $tokenlink <br>
                        If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                    

                        $mailsent = sendUserMail($subject, $toemail, $msgintext, $msginHtml);

                        if ($mailsent){
                            $text= "Reset password link successfully sent";
                            $status = true;
                            $data = [];
                            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                            respondOK($successData);
                        }
                    }

                    if ($user_identity == 'phone'){

                        $smstosend = "Hello Mr  $firstname,\n
                        Kindly follow this link to reset your password on cart.ng \n $tokenlink \n
                        If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";
                        
                        
                        

                        $sent = sendUserSMS($username, $smstosend);

                        if ($sent){

                            $text= "Reset password link successfully sent";
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