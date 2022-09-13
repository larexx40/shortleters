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

    // check if the right request was sent
    if ($method == 'GET') {
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
        $user_pubkey = $decodedToken->usertoken;

        // check if user is admin
        if (!checkIfIsAdmin($connect, $user_pubkey)){
            // send user not found response to the user
            $errordesc =  "User not Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can add, delete, update and get Termi Table Details";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // pass id and validate
        if ( !isset($_GET['termi_id']) ){
            $errordesc="id is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="id of row to update must be passed";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $termiID = cleanme($_GET['termi_id']);
        }

        if ( !is_numeric($termiID) ){
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Kindly pass a valid termi id";
            $method;
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }
            // Output page
            $query = "SELECT * FROM `termiapidetails` where id = ?";
            $getAll = $connect->prepare($query);
            $getAll->bind_param("s", $termiID);
            $getAll->execute();
            $result = $getAll->get_result();
            $num_row = $result->num_rows;

            if ($num_row > 0){

                while($row = $result->fetch_assoc()){
                    $send_from = $row['sendfrom'];
                    $key = $row['apikey'];
                    $name = $row['name'];
                    $sms_type = $row['smstype'];
                    $sms_channel = $row['smschannel'];
                    $status = ($row['status'] == 0) ? "inactive" : "active";
                    
                    $termi = array(
                        'id' => $row['id'],
                        'sendFrom' => $send_from,
                        'apikey' => $key,
                        'name' => $name,
                        'smstype' => $sms_type,
                        'smschannel' => $sms_channel,
                        'status_code' => $row['status'],
                        'status' => $status
                    );
                }

                $data = array(
                    'termi' => $termi
                );
                $text= "Fetch Successful";
                $status = true;
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);
            }else{

                $errordesc = "No records";
                $linktosolve = 'https://';
                $hint = "Kindly make sure the table has been populated";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondOK($data);

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