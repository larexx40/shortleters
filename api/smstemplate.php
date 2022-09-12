<?php

//SMS FUNCTION below is where all functions related to sms is added
//  you dont have to edit this
function  GetActiveTermiApi(){
    global $connect;
    $alldata=[];
    $active=1;
    $getdataemail =  $connect->prepare("SELECT * FROM termiapidetails WHERE status=?");
    $getdataemail->bind_param("s",$active);
    $getdataemail->execute();
    $getresultemail = $getdataemail->get_result();
    if( $getresultemail->num_rows> 0){
        $getthedata= $getresultemail->fetch_assoc();
        $alldata=$getthedata;
    }
    return $alldata;
} 
function  GetActiveKudiApi(){
    global $connect;
    $alldata=[];
    $active=1;
    $getdataemail =  $connect->prepare("SELECT * FROM kudiapidetails WHERE status=?");
    $getdataemail->bind_param("s",$active);
    $getdataemail->execute();
    $getresultemail = $getdataemail->get_result();
    if( $getresultemail->num_rows> 0){
        $getthedata= $getresultemail->fetch_assoc();
        $alldata=$getthedata;
    }
    return $alldata;
}
function  GetActiveSmartSolutionApi(){
    global $connect;
    $alldata=[];
    $active=1;
    $getdataemail =  $connect->prepare("SELECT * FROM smartsolutionapidetails WHERE status=?");
    $getdataemail->bind_param("s",$active);
    $getdataemail->execute();
    $getresultemail = $getdataemail->get_result();
    if( $getresultemail->num_rows> 0){
        $getthedata= $getresultemail->fetch_assoc();
        $alldata=$getthedata;
    }
    return $alldata;
}


//  code for all integrations
function sendWithTermi($sendto,$smstosend){
        $termidata=GetActiveTermiApi();
        $smssent=false;
        $dnum = substr($sendto, 1);
        $sendto="234".$dnum;
       $arr = array(
        "to"=> $sendto,
        "sms"=>$smstosend,
       "api_key"=> $termidata['apikey'],
       "from"=> $termidata['sendfrom'],
       "type"=> $termidata['smstype'],
       "channel"=> $termidata['smschannel'],
       );
       //below is the base url
       $url ="https://termii.com/api/sms/send";
       $params =  json_encode($arr);
       $curl = curl_init();
       curl_setopt_array($curl, array(
       //u change the url infront based on the request u want
       CURLOPT_URL => $url,
       CURLOPT_POSTFIELDS => $params,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 30,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       //change this based on what u need post,get etc
       CURLOPT_CUSTOMREQUEST => "POST",
       CURLOPT_HTTPHEADER => array(
       "content-type: application/json",
       ),
       ));
       $resp = curl_exec($curl);
       $err = curl_error($curl);
       curl_close($curl);
        if($err){
            $smssent=false;
        }else{
            $theresponse= json_decode($resp);
            //   print_r($theresponse);
            if($theresponse->code=="ok"){
                $smssent=true;
                $msgid= $theresponse->message_id;
                // later log sms sent
                // $systype="Termii";
                // $insert_data4 = $connect->prepare("INSERT INTO smslog(message,sentto,sentwith,messageid,sentrom) VALUES (?,?,?,?,?)");
                // $insert_data4->bind_param("sssss", $msg,$sendto,$systype,$msgid,$sendfrom);
                // $insert_data4->execute();
                // $insert_data4->close();
            }else{
                 $smssent=false;
            }
        }

        return $smssent;
}
function sendWithKudiSMS($sendto,$smstosend){
        $sysdata=GetActiveKudiApi();
        $smssent=false;

        /*
        Sending messages using the KudiSMS API
        Requirements - PHP, file_get_contents (enabled) function
        */
        // Initialize variables ( set your variables here )
        $username = $sysdata['username'];
        $password = $sysdata['password'];
        $sender = $sysdata['sendfrom'];
        $message = $smstosend;
        // Separate multiple numbers by comma
        $mobiles = $sendto;
          // Set your domain's API URL
        $api_url = 'https://account.kudisms.net/api/';
         //Create the message data
        $data = array('username' => $username, 'password' => $password, 'sender' => $sender,
            'message' => $message, 'mobiles' => $mobiles);
            //URL encode the message data
            $data = http_build_query($data);
            //Send the message  
            $request = $api_url . '?' . $data;
            $result = file_get_contents($request);
            $result = json_decode($result);
            if (isset($result->status) && strtoupper($result->status) == 'OK') {
            // Message sent successfully, do anything here
            // echo 'Message sent at N' . $result->price;
                 $smssent=true;
            } else if (isset($result->error)) {
                $smssent=false;
            // Message failed, check reason.
            // echo 'Message failed - error: ' . $result->error;
            } else {
                $smssent=false;
            // Could not determine the message response.
            // echo 'Unable to process request';
            }
}
function sendWithSmartSolution($sendto,$smstosend){
        $sysdata=GetActiveSmartSolutionApi();
        $smssent=false;
        // Initialize variables ( set your variables here )
        $sendfrom = $sysdata['sendfrom'];
        $sendtype = $sysdata['sendtype'];
        $routing = $sysdata['routing'];
        $token = $sysdata['apitoken'];
        // ref_id ADD THIS WHEN LOGGING SMS
        $message = $smstosend;
        // Separate multiple numbers by comma
        $mobiles = $sendto;
        $baseurl = 'https://smartsmssolutions.com/api/json.php?';
      
          $sms_array = array
              (
              'sender' => $sendfrom,
              'to' => $mobiles,
              'message' => $message,
              'type' => $sendtype,
              'routing' => $routing,
              'token' => $token,
          );
      
          $params = http_build_query($sms_array);
          $ch = curl_init();
      
          curl_setopt($ch, CURLOPT_URL, $baseurl);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
      
          $resp = curl_exec($ch);
          $err = curl_error($ch);
           if($err){
               $smssent=false;
           }else{
               $theresponse= json_decode($resp);
               //   print_r($theresponse);
               if($theresponse->code==1000){
                    $smssent=true;
                    $msgid= $theresponse->message_id;
                   // $systype="Termii";
                   // $insert_data4 = $connect->prepare("INSERT INTO smslog(message,sentto,sentwith,messageid,sentrom) VALUES (?,?,?,?,?)");
                   // $insert_data4->bind_param("sssss", $msg,$sendto,$systype,$msgid,$sendfrom);
                   // $insert_data4->execute();
                   // $insert_data4->close();
               }else{
                    $smssent=false;
               }
           }
           curl_close($ch);
           return  $smssent;
}
//  code for all integrations
//  you dont have to edit this



// FUNCTIONS functions related to the users
 function smsgetUserData($userid)
{
    //input type checks if its from post request or just normal function call
    global $connect;
    $alldata = [];

    $checkdata = $connect->prepare("SELECT  * FROM users  WHERE id=?");
    $checkdata->bind_param("s",$userid);
    $checkdata->execute();
    $getresultemail = $checkdata->get_result();
    if ($getresultemail->num_rows > 0) {
        $getthedata = $getresultemail->fetch_assoc();
        $alldata = $getthedata;
    }
    return $alldata;
}
function smsgetSingleUserTransWithOrderID($orderid)
{
    global $connect;
    $alldata=[];
    $checkdata = $connect->prepare("SELECT * FROM userwallettrans  WHERE orderid = ?");
    $checkdata->bind_param("s",$orderid);
    $checkdata->execute();
    $getresultemail = $checkdata->get_result();
    if ($getresultemail->num_rows > 0) {
        while ($getthedata = $getresultemail->fetch_assoc()) {

            array_push($alldata,$getthedata);
            // array_push($alldata, array("id" => $getthedata['id'], "username" => $getthedata['username'], "addresssentto" => $getthedata['addresssentto'], "transhash" => $getthedata['transhash'], "orderid" => $getthedata['orderid'], "amtusd" => $getthedata['amtusd'], "amttopay" => $getthedata['amttopay'], "ourrate" => $getthedata['ourrate'], "ordertime" => $ordertime, "paytime" => $paytime, "accpayto" => $getthedata['accpayto'], "approvedby" => $getthedata['approvedby'], "paymentref" => $getthedata['paymentref'], "status" => $getthedata['status'], "statustext" => $statustext, "confirmation" => $getthedata['confirmation'], "cointrackid" => $getthedata['cointrackid'], "livecointype" => $getthedata['livecointype'], "transactiontype" => $getthedata['transactiontype'], "systempayref" => $getthedata['systempayref']));

        }
        $alldata = $alldata[0];
    }
        return $alldata;
    
}


// MESSAGES below are where you should add all functions for certain sms
 function newlyRegisteredSms($userid){//sms to send to users that just registered
        $userdsatas= smsgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];


        $smstemplate="Hello $usernameis, how are you";
        
        return $smstemplate;
      
}

function transactionConfirmSms($userid,$transorderid){// sms to send when transaction is confirmed
       
        $userdsatas= smsgetUserData($userid);
         // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below, more data would be added as the system grows
        $usernameis=$userdsatas['username'];

        $gttransdata=smsgetSingleUserTransWithOrderID($transorderid);
        // `userid`, `addresssentto`, `transhash`, `livetransid`, `orderid`, `ordertime`, `confirmtime`, `approvedby`, `status`, `liveusdrate`, `confirmation`, `syslivewallet`, `cointrackid`, `livecointype`, `addresssentfrm`, `btcvalue`, `theusdval`, `manualstatus`, `approvaltype`, `created_at`, `updated_at`, `ourrrate`, `amttopay`, `currencytag`, `transtype`, `virtualcardtrackid`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below, more data would be added as the system grows
        $transrealamt = $gttransdata['theusdval'];

        
        $mailtext="The total of   USD for  Naira at the rate of   N/$ has now reflected on the blockchain network. Kindly wait for 1 Conf before AutoWithdrawal occurs.";
        
        return $mailtext;
}
