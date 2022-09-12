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
       //Get company private key for jwtauth
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

       if(!checkIfIsAdmin($connect, $userpubkey)){
        // send Admin not found response
        $errordesc =  "Admin  not found";
        $linktosolve = 'https://';
        $hint = "Only Super Admin can access this route";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondUnAuthorized($data);
        }
        $adminid = checkIfIsAdmin($connect, $userpubkey);

        // check if the current password field was passed 
        if ( !isset($_POST['currentPassword'] ) ) {
            // send error if current password is not passed
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required current password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }else{
            $currentpassword = cleanme($_POST['currentPassword']);
        }

        // check if the new password field was passed 
        if ( !isset($_POST['newPassword'] ) ) {

            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required new password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }else{
            $newpassword = cleanme($_POST['newPassword']);
        }
        if ( empty($currentpassword) || empty($newpassword) ){
            $errordesc = "Insert all fields";
            $linktosolve = 'https://';
            $hint = "Kindly pass value to the user_id, current password and new password field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check for user details in the database
        $query = 'SELECT `password`, `name` FROM `admin` WHERE id = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $adminid);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ( $num_row < 1){

            // send user not found response to the user
            $errordesc =  "Admin not found";
            $linktosolve = 'https://';
            $hint = "Admin is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        
        }else{
            $row =  mysqli_fetch_assoc($result);
            $oldHashedPass = $row['password'];
            $stmt->close();
            
            // check if old pass hash from db is equivalent to the current password passed
            if ( check_pass($currentpassword, $oldHashedPass) ){

                // Check if new password is not equal to old password
                if ( check_pass($newpassword, $oldHashedPass ) ){
                    // Send error response that password is equal to old password
                    $errordesc = "New Password Can't be equal to old password";
                    $linktosolve = 'https://';
                    $hint = "Password must be different from old password in the db";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);
                }
                
                // Check if new password meets the standard
                if ( !validatePassword($newpassword) ) {
                    // Send error response that password doesn't meet standard
                    $errordesc = "Password doesn't contain necessary characters";
                    $linktosolve = 'https://';
                    $hint = "Password field must contain uppercase, lowercase, a number, special characters and also must be more than 8 characters";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondBadRequest($data);

                }

                $hashNewPassword = Password_encrypt($newpassword);

                $updatePassQuery = "UPDATE `admin` SET `password` = ? WHERE id = ?";
                $updateStmt = $connect->prepare($updatePassQuery);
                $updateStmt->bind_param('ss', $hashNewPassword, $adminid);
                $updateStmt->execute();

                if ( $updateStmt->affected_rows > 0 ){
                    $maindata=[];
                    $errordesc = " ";
                    $linktosolve = "htps://";
                    $hint = "Successfull Password Change";
                    $errordata = [];
                    $text = "Password Updated Proceed to Login";
                    $status = true;
                    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                    respondOK($data);
                
                }else{

                    //invalid input/ server error
                    $errordesc="Bad request";
                    $linktosolve="htps://";
                    $hint=["Ensure to send valid data, data already registered in the database.", "Use registered API to get a valid data","Read the documentation to understand how to use this API"];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="invalid phoneno or DB issue";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }
            
            }else{
                // send Invalid current password response to the user
                $errordesc =  "Incorrect Password";
                $linktosolve = 'https://';
                $hint = "Current password passed does not match the passowrd in the database";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
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