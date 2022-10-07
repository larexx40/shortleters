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
    $maindata= [];
 
    if ($method == 'GET') {
        //get company details to decode usertoken
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

        //check if isadmin
        // $adminid = checkIfIsAdmin($connect,$userpubkey);
        $user_id = getUserWithPubKey($connect, $userpubkey);
        
        if(!$user_id){
            // send user not found response to the user
            $errordesc =  "User not a admin";
            $linktosolve = 'https://';
            $hint = "Only admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondUnAuthorized($data);
        }

        if ( !isset($_GET['apartment_id']) ){
            // send error if name field is not passed
            $errordesc = "Apartment id must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);

        }else{
            $apartment_id = cleanme($_GET['apartment_id']);
        }


        if (empty($apartment_id) ){
            // send error if inputs are empty
            $errordesc = "Highlight inputs are required";
            $linktosolve = 'https://';
            $hint = "Pass in Highlight details, it can't be empty";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        

        $query = "SELECT scenic_ids FROM `apartments` WHERE apartment_id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $apartment_id);
        $stmt->execute();
        $result= $stmt->get_result();
        $num_row = $result->num_rows;


        if ( $num_row > 0 ){
            $row = $result->fetch_assoc();
            $scenic_ids = ($row["scenic_ids"])? explode(",", $row["scenic_ids"]): null;
            $scenic_id_name = [];
            if ($scenic_ids){
                for ($i = 0; $i < count($scenic_ids); $i++){
                    $id_name = getNameFromField($connect, "scenic_view", "scenicid", $scenic_ids[$i]);
                    array_push($scenic_id_name, array(
                        'scenic_id' => $scenic_ids[$i],
                        'name' => ($id_name)? $id_name : null
                    ));
                }
            }else{
                $scenic_id_name = $scenic_ids;
            }

            $data = $scenic_id_name;
            $text= "Fetch Successful";
            $status = true;
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);
            
        }else{
            $errordesc = "Apartment not Found";
            $linktosolve = 'https://';
            $hint = "Kindly pass valid value to all the fields";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        if ( $stmt->error ){
            $errordesc =  $stmt->error;
            $linktosolve = 'https://';
            $hint = "500 code internal error, check ur database connections";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondInternalError($data);
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