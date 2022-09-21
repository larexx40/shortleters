<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']);
    $maindata=[];

    if($method =='GET'){
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
        $userPubKey = $decodeToken->usertoken;

        $sqlQuery ="SELECT `id`, `sys_setting_id`, `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `activepaymentsystem`, 
                    `min_apart_photo`, `max_apart_highlights`, `charge_perc`, `discount_perc`, `discount_guest` FROM `systemsettings`";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;
        
        //check for database connection 
        if(!$stmt->execute()){
            //DB error || invalid input
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Database comection error";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }
        //return fetched data as array
        
        if($numRow > 0){
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $systemSettingsid = $row['sys_setting_id'];
            $name = $row['name'];
            $iosversion = $row['iosversion'];
            $androidversion = $row['androidversion'];
            $webversion = $row['webversion'];
            $activeSmsCode = $row['activesmssystem'];
            //1 Termi, 2 kudi 3 smart solution
            if($activeSmsCode == 1){
                $smsApi = "Termi";
            }elseif($activeSmsCode == 2){
                $smsApi = "Kudi";
            }elseif($activeSmsCode == 3){
                $smsApi = "Smart Solution";
            }else {
                $smsApi = "None";
            }

            $activeEmailCode = $row['activemailsystem'];
            if($activeEmailCode == 1){
                $emailApi = "SendGrid";
            }else {
                $emailApi = "None";
            }
            $activePaymentCode=$row['activepaymentsystem'];
            // 1paystack 2monify 3oneapp
            if($activePaymentCode == 1){
                $paymentApi = "PayStack";
            }elseif($activePaymentCode == 2){
                $paymentApi = "Monify";
            }elseif($activePaymentCode == 3){
                $paymentApi = "OneApp";
            }else {
                $paymentApi = "None";
            }
            $minApartmentPhotos = $row['min_apart_photo'];
            $maxApartmentHighlights = $row['max_apart_highlights'];
            $chargePercentage = $row['charge_perc'];
            $discountPercentage = $row['discount_perc'];
            $discount_guest = $row['discount_guest']; 

            $maindata = [
                "id"=>$id,
                "systemSettingsid"=> $systemSettingsid ,
                "name"=>$name,
                "iosversion"=>$iosversion,
                "androidversion"=>$androidversion ,
                "webversion"=>$webversion,
                "activeSmsCode"=>$activeSmsCode,
                "smsApi"=>$smsApi ,
                "activeEmailCode"=>$activeEmailCode,
                "emailApi"=>$emailApi,
                "activePaymentCode"=>$activePaymentCode,
                "paymentApi"=>$paymentApi,
                "maxApartmentHighlights"=>$maxApartmentHighlights,
                "minApartmentPhotos"=>$minApartmentPhotos,
                "chargePercentage"=>$chargePercentage,
                "discountPercentage"=>$discountPercentage,
                "discount_guest"=>$discount_guest 
            ];
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //not found
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Record Not Found";
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }


    }else {
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