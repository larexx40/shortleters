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

    if ($method == 'POST') {
        // Check if the email field is passed
        if (!isset($_POST['email'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required email field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $email = cleanme($_POST['email']);
        }

        // Check if the firstname field is passed
        if (!isset($_POST['firstname'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required firstname field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $firstname = cleanme($_POST['firstname']);
        }


        // Check if the lastname field is passed
        if (!isset($_POST['lastname'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required lastname field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $lastname = cleanme($_POST['lastname']);
        }

        // Check if the lastname field is passed
        if (!isset($_POST['username'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required lastname field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $username = cleanme($_POST['username']);
        }

        if (!isset($_POST['refer_code'])){
            $refferedBy = "";
        }else{
            $refferedBy = cleanme($_POST['refer_code']);
        }


        // Check if the phone field is passed
        if (!isset($_POST['phone'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required phone field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $phone = cleanme($_POST['phone']);
        }

        // Check if the firstname field is passed
        if (!isset($_POST['password'])){
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $password = cleanme($_POST['password']);
        }

        // check if none of the field is empty
        if ( empty($email) || empty($firstname) || empty($lastname) || empty($phone) || empty($password) || empty($username) ){

            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the email and password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        // check if email sent is a valid email
        if (!(validateEmail($email))){
            $errordesc = "Invalid email address";
            $linktosolve = 'https://';
            $hint = "pass a valid email address in the email field in this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if phone is a valid phone number
        if (!validatePhone($phone)){

            $errordesc = "Invalid phone number";
            $linktosolve = 'https://';
            $hint = "pass a valid phone number in the phone field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }



        if (!validatePassword($password)){
            // Check if password is strong enough

            $errordesc = "Password doesn't contain necessary characters";
            $linktosolve = 'https://';
            $hint = "Password field must contain uppercase, lowercase, a number, special characters and also must be more than 8 characters";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }

        // check if username is unique
        $error = checkifFieldisUnique($connect, "users" , "username" , $username);
        if ( $error ){
            $errordesc = $error;
            $linktosolve = 'https://';
            $hint = "Password field must contain uppercase, lowercase, a number, special characters and also must be more than 8 characters";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // Check if the email or phone number is already in the database
        $query = 'SELECT * FROM users WHERE email = ? OR phoneno = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            // send response that the user already exits
            $errordesc =  "User already exists";
            $linktosolve = 'https://';
            $hint = "Email and Phone Number is unique therefore no two user can have the same email address or Phone number";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

            $stmt->close();
        }else{
        
            $stmt->close();
            // get user ip, loc, and browser details for session logs
            $browser= $_SERVER['HTTP_USER_AGENT'];
            $userIp = getIPAddress();

            $time = new DateTimeImmutable();
            $fullDate = gettheTimeAndDate($time->getTimestamp());
            $date = explode(" ", $fullDate)[0];
            $location = getLoc("41.217.94.84");
            $sessioncode = generatePubKey(12);
            $tableName = "users";
            
            // call the function to register the user since its a new user
            $registered = registerAUser($connect, $email, $firstname, $lastname, $phone, $password, $username , $refferedBy ,$endpoint, $method, $tableName);

            if ($registered){
                $userType = "4";
                $activity = "2";
                // add session log since the user has registered
                addSessionLog($connect, $email, $activity ,$sessioncode, $userIp, $browser, $date, $location, $userType ,$method, $endpoint);

                // generate the registration notification email format
                $emailFrom = "noreply@cart.ng";
                $subject = "Successfully Registered to the cart.ng platform";
                $toemail = $email;
                $msgintext = "Hello Chief  $firstname,<br>
                You just successfully created your account on cart.ng with the ip properties below.<br><br> IP Address: $userIp <br><br>Device: $browser <br><br>Date: $fullDate.<br>
                If this was you, you can safely disregard this email. If this wasn't you, please chat our support team immediately.";

                $mailsent = sendUserMail($subject, $toemail, $msgintext, $msgintext);

                if ($mailsent){
                    $text= "User registration Successful";
                    $status = true;
                    $data = array(
                        'auth' => $registered,
                    );
                    $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                    respondOK($successData);
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