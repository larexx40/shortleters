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

    if ($method == 'POST') {

        // Get company private key
        $query = 'SELECT * FROM apidatatable';
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row =  mysqli_fetch_assoc($result);
        $companykey = $row['privatekey'];
        $servername = $row['servername'];
        $expiresIn = $row['tokenexpiremin'];

        $decodedToken = ValidateAPITokenSentIN($servername, $companykey, $method, $endpoint);
        $pubkey = $decodedToken->usertoken;

        if  (!checkIfIsAdmin($connect, $pubkey) ){

            // send user not found response to the user
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin has the ability to add send grid api details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( !isset($_POST['id']) ){
            // send error if the name isn't passed
            $errordesc =  "System settings id not passed";
            $linktosolve = 'https://';
            $hint = "pass System settings id";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $system_id = cleanme($_POST['id']);
        }

        if ( !isset($_POST['name']) ){
            // send error if the name isn't passed
            $errordesc =  "System settings name not passed";
            $linktosolve = 'https://';
            $hint = "pass System settings name";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $system_name = cleanme($_POST['name']);
        }

        if ( !isset($_POST['iosversion']) ){
            // send error if the name isn't passed
            $errordesc =  "IOSVersion not passed";
            $linktosolve = 'https://';
            $hint = "pass IOSVersion to the field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $ios_version = cleanme($_POST['iosversion']);
        }


        if ( !isset($_POST['andriodversion']) ){
            // send error if the name isn't passed
            $errordesc =  "andriodVersion not passed";
            $linktosolve = 'https://';
            $hint = "pass andriodVersion to the field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $andriod_version = cleanme($_POST['andriodversion']);
        }

        if ( !isset($_POST['webversion']) ){
            // send error if the name isn't passed
            $errordesc =  "webVersion not passed";
            $linktosolve = 'https://';
            $hint = "pass webVersion to the field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $web_version = cleanme($_POST['webversion']);
        }

        if ( !isset($_POST['activesmssystem']) ){
            // send error if the name isn't passed
            $errordesc =  "Active Sms System not passed";
            $linktosolve = 'https://';
            $hint = "pass Active Sms System to the field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $active_sms_system = cleanme($_POST['activesmssystem']);
        }

        if ( !isset($_POST['activemailsystem']) ){
            // send error if the name isn't passed
            $errordesc =  "Active Mail System not passed";
            $linktosolve = 'https://';
            $hint = "pass Active Mail System to the field";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }else{
            $active_mail_system = cleanme($_POST['activemailsystem']);
        }


        if ( empty($system_name) || empty($ios_version) || empty($andriod_version) || empty($web_version) ){
            // send error response if any field is empty
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the system name, ios version, android version, web version, active mail, active sms, this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if (!is_numeric($active_mail_system) || !is_numeric($active_sms_system) ){
            $errordesc = "Insert Valid values to active mail and sms fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the system name, ios version, android version, web version, active mail, active sms, this endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // insert data
        $query = "UPDATE `systemsettings` SET `name`= ?,`iosversion`= ?,`androidversion`= ?,`webversion`= ?,`activesmssystem`= ?,`activemailsystem`= ? WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sssssss", $system_name, $ios_version, $andriod_version, $web_version, $active_sms_system, $active_mail_system, $system_id);
        $stmt->execute();

        if ($stmt->error){
            $errordesc =  $stmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondInternalError($data);
        }
        
        if ($stmt->affected_rows > 0){
            // send everything okay data
            $text= "System settings successfully updated";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
        }else{
            // send everything okay data but same record can't be updated
            $text= "Records already exist";
            $status = true;
            $data = [];
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
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