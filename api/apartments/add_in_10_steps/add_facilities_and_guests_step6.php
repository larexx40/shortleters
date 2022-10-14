
<?php
    // pass cors header to allow from cross-origin
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");

    include "../../cartsfunction.php";

    // This step occurs if the user Selects the facilities and the number of guests he/she wants in the apartment
    
  

    $endpoint = basename($_SERVER['PHP_SELF']);
    $method = getenv('REQUEST_METHOD');
    $data = json_decode(file_get_contents("php://input"));

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
        $user_pubkey = $decodedToken->usertoken;

        $user_id =  getUserWithPubKey($connect, $user_pubkey);

        // send error if ur is not in the database
        if (!$user_id){
            // send user not found response to the user
            $errordesc =  "User not Authorized";
            $linktosolve = 'https://';
            $hint = "User is not in the database ensure the user is in the database";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondUnAuthorized($data);
        }


        if ( !isset($data->max_guest) ){

            $errordesc="max guest required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="max guest id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $max_guest = cleanme($data->max_guest);
        }

        if ( !isset($data->facilities) ){

            $errordesc="Facility is required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Facility must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $values = $data->facilities; 
        }

        if ( !isset($data->apartment) ){

            $errordesc="apartments id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="apartments id must be passed";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($data->apartment);
        }

        if ( empty($max_guest) || empty($apartment_id) ){

            $errordesc = "Enter all Fields";
            $linktosolve = 'https://';
            $hint = "Kindly ensure that a valid id is passed";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // check if fields are valid

        if ( !checkifFieldExist($connect, "apartments", "apartment_id", $apartment_id) ) {

            $errordesc = "Apartment does not Exist ";
            $linktosolve = 'https://';
            $hint = "Kindly ensure the product id passed is for an existing product";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        $length = count($values);

        for ($i=0; $i < $length; $i++){
            $facility_id = cleanme($values[$i]->facility);
            $number = cleanme($values[$i]->number);


            if ( empty($facility_id) ){
                $errordesc = "Enter all Fields";
                $linktosolve = 'https://';
                $hint = "Kindly ensure that a valid id is passed";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            if ( !checkifFieldExist($connect, "facilities", "facility_id", $facility_id) ) {

                $errordesc = "Facility id does not Exist ";
                $linktosolve = 'https://';
                $hint = "Kindly ensure the product id passed is for an existing product";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            //check later
            $check_if_exist = checkApartmentFacility($connect, $facility_id, $apartment_id);
            // $check_if_exist = checkifFieldExist($connect, "apartment_facilities", "apartment_id", $apartment_id);

            
            $error = true;
            if ( $check_if_exist ){
                $update_apartment_facilities = "UPDATE `apartment_facilities` SET `total_number`= ? WHERE `apartment_id` = ? AND `facility_id` = ?";
                $update_apartment_facility = $connect->prepare($update_apartment_facilities);
                $update_apartment_facility->bind_param("sss", $number, $apartment_id, $facility_id);
                $update_apartment_facility->execute();

                if($update_apartment_facility->error){
                    $errordesc =  $update_apartment_facility->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondInternalError($data);
                }
            }else{

                $apartment_facility_id = generateUniqueShortKey($connect, "apartment_facilities", "apart_facility_id");
                $insert_apartment_facilities = "INSERT INTO `apartment_facilities`(`apart_facility_id`, `apartment_id`, `facility_id`, `total_number`) VALUES (?, ?, ?, ?)";
                $apartment_facility = $connect->prepare($insert_apartment_facilities);
                $apartment_facility->bind_param("ssss", $apartment_facility_id, $apartment_id, $facility_id, $number);
                $execute = $apartment_facility->execute();

                if($apartment_facility->error){
                    $errordesc =  $apartment_facility->error;
                    $linktosolve = 'https://';
                    $hint = "500 code internal error, check ur database connections";
                    $errorData = returnError7003($errordesc, $linktosolve, $hint);
                    $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                    respondInternalError($data);
                }

                if ( $execute){
                    $error = false;
                }



            }

        }

        $steps = "6";
        
        if ( !$error ){
            // Make user and agent
            $query = "UPDATE `apartments` SET `max_guest`= ?,`steps`= ? WHERE `apartment_id` = ? AND agent_id = ?";
            $updateStatus = $connect->prepare($query);
            $updateStatus->bind_param("ssss", $max_guest, $steps ,$apartment_id ,$user_id);
            $execute = $updateStatus->execute();

            if ($updateStatus->error){
                $errordesc =  $updateStatus->error;
                $linktosolve = 'https://';
                $hint = "500 code internal error, check ur database connections";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondInternalError($data);
            }

            if ( $execute ){
                
                $text= "Saved";
                $status = true;
                $data = [];
                $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                respondOK($successData);

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