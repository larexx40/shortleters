<?php
// you dont habve to touh this
// MAIL FUNCTIONS

require("sendgrid/sendgrid/sendgrid-php.php");

function  GetActiveSendGridApi(){
  global $connect;
  $alldata=[];
  $active=1;
  $getdataemail =  $connect->prepare("SELECT * FROM sendgridapidetails WHERE status=?");
  $getdataemail->bind_param("s",$active);
  $getdataemail->execute();
  $getresultemail = $getdataemail->get_result();
  if( $getresultemail->num_rows> 0){
      $getthedata= $getresultemail->fetch_assoc();
      $alldata=$getthedata;
  }
  return $alldata;
}
    // Sengrid
function sendWithSenGrid($subject,$toemail,$msgintext,$messageinhtml){
      $issent =false;
      $sendgriddata=GetActiveSendGridApi();
      $sendgridkey =$sendgriddata['apikey'];
      $sendgridid = $sendgriddata['secreteid'];
      $emailfrom=$sendgriddata['emailfrom'];
      // If not using Composer, uncomment the above line
      $email = new \SendGrid\Mail\Mail();
      $email->setFrom($emailfrom, "$sendgridid");
      $email->setSubject($subject);
      $email->addTo($toemail);
      $email->addContent(
          "text/plain", strip_tags($msgintext)
      );
      $email->addContent(
          "text/html", $messageinhtml
      );
      $sendgrid = new \SendGrid($sendgridkey);
      try {
          $response = $sendgrid->send($email);

          $issent =true;
      // check response and set this well
          // print $response->statusCode() . "\n";
          // print_r($response->headers());
          // print $response->body() . "\n";
      } catch (Exception $e) {
          $issent =false;

      }
    return $issent;

}
// you dont habve to touh this
     

// FUNCTIONS functions related to the users
function mailgetUserData($userid)
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

function mailgetUserSessionLog($username,$sessioncode)
{
    //input type checks if its from post request or just normal function call
    global $connect;
    $alldata = [];

    $checkdata = $connect->prepare("SELECT  * FROM usersessionlog WHERE username=? AND sessioncode=?");
    $checkdata->bind_param("ss",$username,$sessioncode);
    $checkdata->execute();
    $getresultemail = $checkdata->get_result();
    if ($getresultemail->num_rows > 0) {
        $getthedata = $getresultemail->fetch_assoc();
        $alldata = $getthedata;
    }
    return $alldata;
}

function mailgetSingleUserTransWithOrderID($orderid)
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

function mailgetAllSystemSetting(){
  global $connect;
  $alldata=[];
  $active=1;
  $getdataemail =  $connect->prepare("SELECT * FROM systemsettings WHERE id=?");
  $getdataemail->bind_param("s",$active);
  $getdataemail->execute();
  $getresultemail = $getdataemail->get_result();
  if( $getresultemail->num_rows> 0){
      $getthedata= $getresultemail->fetch_assoc();
      $alldata=$getthedata;
  }
  return $alldata;
}


// MAIL specific functions to call, in this type of case, some APi need you to send the mail as ordinary text and as html, that is why you would see HTML and normal text, when adding yours add it like this
//  pass variables needed as i did below adn create the db function above to call it with tag mail
// newly reg mail
 function newlyRegisteredHTML($userid){
        $userdsatas= mailgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];

        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];

        $greetingText = "Hello $usernameis, thank you for signing up.";
        $headtext = "Welcome and congrats on becoming a member of the  $appname family. There are a lot of awesome functions in the system to make things easier for you. We will also always add more and more functions to make the system easier to use. ";
        $bottomtext = "If you have any questions, comments or concerns, don't hesitate to reach us via $supportemail, Thank you and we are excited to have you! Cheers!";
        // adding link and button of link use below
        $calltoaction = false; // set as true and add details below
        $calltoactionlink = "";
        $calltoactiontext = "";
        // adding link and button of link use below
        $buttonis = "";
        if ($calltoaction == true) {
            $buttonis = ' <td align="left">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td> <a href="' . $calltoactionlink . '" target="_blank">' . $calltoactiontext . '</a> </td>
                </tr>
              </tbody>
            </table>
          </td>';
        }

        $mailtemplate = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Simple Transactional Email</title>
            <style>
              /* -------------------------------------
                  GLOBAL RESETS
              ------------------------------------- */

              /*All the styling goes here*/

              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%;
              }

              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
              }

              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top;
              }

              /* -------------------------------------
                  BODY & CONTAINER
              ------------------------------------- */

              .body {
                background-color: #f6f6f6;
                width: 100%;
              }

              /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px;
              }

              /* This should also be a block element, so that it will fill 100% of the .container */
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px;
              }

              /* -------------------------------------
                  HEADER, FOOTER, MAIN
              ------------------------------------- */
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%;
              }

              .wrapper {
                box-sizing: border-box;
                padding: 20px;
              }

              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }

              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%;
              }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center;
              }

              /* -------------------------------------
                  TYPOGRAPHY
              ------------------------------------- */
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px;
              }

              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize;
              }

              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px;
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px;
              }

              a {
                color: #3498db;
                text-decoration: underline;
              }

              /* -------------------------------------
                  BUTTONS
              ------------------------------------- */
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto;
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center;
              }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize;
              }

              .btn-primary table td {
                background-color: #3498db;
              }

              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff;
              }

              /* -------------------------------------
                  OTHER STYLES THAT MIGHT BE USEFUL
              ------------------------------------- */
              .last {
                margin-bottom: 0;
              }

              .first {
                margin-top: 0;
              }

              .align-center {
                text-align: center;
              }

              .align-right {
                text-align: right;
              }

              .align-left {
                text-align: left;
              }

              .clear {
                clear: both;
              }

              .mt0 {
                margin-top: 0;
              }

              .mb0 {
                margin-bottom: 0;
              }

              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0;
              }

              .powered-by a {
                text-decoration: none;
              }

              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0;
              }

              /* -------------------------------------
                  RESPONSIVE AND MOBILE FRIENDLY STYLES
              ------------------------------------- */
              @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important;
                }
                table.body p,
                table.body ul,
                table.body ol,
                table.body td,
                table.body span,
                table.body a {
                  font-size: 16px !important;
                }
                table.body .wrapper,
                table.body .article {
                  padding: 10px !important;
                }
                table.body .content {
                  padding: 0 !important;
                }
                table.body .container {
                  padding: 0 !important;
                  width: 100% !important;
                }
                table.body .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important;
                }
                table.body .btn table {
                  width: 100% !important;
                }
                table.body .btn a {
                  width: 100% !important;
                }
                table.body .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important;
                }
              }

              /* -------------------------------------
                  PRESERVE THESE STYLES IN THE HEAD
              ------------------------------------- */
              @media all {
                .ExternalClass {
                  width: 100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%;
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important;
                }
                #MessageViewBody a {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important;
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important;
                }
              }

            </style>
          </head>
          <body class="">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                <img src="' . $logourl . '" height="50" class="content">

                  <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">
                        <!--image url-->
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p>' . $greetingText . '</p>
                                <p>' . $headtext . '</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                        ' . $buttonis . '
                                    </tr>
                                  </tbody>
                                </table>
                                <p>' . $bottomtext . '</p>
                                <p>Thank you for using ' . $appname . '</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span class="apple-link">' . $location . '</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="content-block powered-by">
                            Powered by <a href="' . $baseurl . '">' . $appname . '</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->

                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';

        return $mailtemplate;

}
 function newlyRegisteredText($userid) {
      $userdsatas= mailgetUserData($userid);
      // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
      //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $usernameis=$userdsatas['username'];

      $systemdata=mailgetAllSystemSetting();
      // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
      //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $appname =  $systemdata['name'];
      $baseurl =  $systemdata['baseurl'];
      $location = $systemdata['location'];
      $summaryapp =$systemdata['appshortdetail'];
      $supportemail = $systemdata['supportemail'];
      $logourl =  $systemdata['appimgurl'];

        $mailtext = "Hello $usernameis, thank you for signing up. ";
        $mailtext .= "Welcome and congrats on becoming a member of the  $appname family.  ";
        $mailtext .= "If you have any questions, comments or concerns, don't hesitate to reach us via $supportemail, Thank you and we are excited to have you! Cheers!";

        return $mailtext;

}
function newlyRegisteredSubject($userid){
  $userdsatas= mailgetUserData($userid);
  // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $usernameis=$userdsatas['username'];

  $systemdata=mailgetAllSystemSetting();
  // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
  //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $appname =  $systemdata['name'];
  $baseurl =  $systemdata['baseurl'];
  $location = $systemdata['location'];
  $summaryapp =$systemdata['appshortdetail'];
  $supportemail = $systemdata['supportemail'];
  $logourl =  $systemdata['appimgurl'];

  $subject="New user";
  return $subject;
}
// loggin mail
function loginMailHTML($userid, $sessioncode){
      $userdsatas= mailgetUserData($userid);
      // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
      //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $usernameis=$userdsatas['username'];

      $systemdata=mailgetAllSystemSetting();
      // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
      //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $appname =  $systemdata['name'];
      $baseurl =  $systemdata['baseurl'];
      $location = $systemdata['location'];
      $summaryapp =$systemdata['appshortdetail'];
      $supportemail = $systemdata['supportemail'];
      $logourl =  $systemdata['appimgurl'];

      $usersseslog=mailgetUserSessionLog($usernameis,$sessioncode);
      //  `email`, `username`, `sessioncode`, `ipaddress`, `browser`, `date`, `status`, `location`, `inserttime`, `user_type`, `created_at`, `updated_at`
      $browser=$usersseslog['browser'];
      $ipaddress=$usersseslog['ipaddress'];


        $greetingText = "Hello $usernameis.";
        $headtext = "We noticed you just logged in. If this was not you, kindly chat with our support team.<br> <h3>IP Address:$ipaddress</h3><br><h3>Browser:$browser<h3>";
        $bottomtext = "If you have any questions, comments or concerns, don't hesitate to reach us via $supportemail, Thank you and we are excited to have you! Cheers!";
        // adding link and button of link use below
        $calltoaction = false; // set as true and add details below
        $calltoactionlink = "";
        $calltoactiontext = "";
        // adding link and button of link use below
        $buttonis = "";
        if ($calltoaction == true) {
            $buttonis = ' <td align="left">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td> <a href="' . $calltoactionlink . '" target="_blank">' . $calltoactiontext . '</a> </td>
                </tr>
              </tbody>
            </table>
          </td>';
        }

        $mailtemplate = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Simple Transactional Email</title>
            <style>
              /* -------------------------------------
                  GLOBAL RESETS
              ------------------------------------- */

              /*All the styling goes here*/

              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%;
              }

              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
              }

              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top;
              }

              /* -------------------------------------
                  BODY & CONTAINER
              ------------------------------------- */

              .body {
                background-color: #f6f6f6;
                width: 100%;
              }

              /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px;
              }

              /* This should also be a block element, so that it will fill 100% of the .container */
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px;
              }

              /* -------------------------------------
                  HEADER, FOOTER, MAIN
              ------------------------------------- */
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%;
              }

              .wrapper {
                box-sizing: border-box;
                padding: 20px;
              }

              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }

              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%;
              }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center;
              }

              /* -------------------------------------
                  TYPOGRAPHY
              ------------------------------------- */
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px;
              }

              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize;
              }

              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px;
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px;
              }

              a {
                color: #3498db;
                text-decoration: underline;
              }

              /* -------------------------------------
                  BUTTONS
              ------------------------------------- */
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto;
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center;
              }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize;
              }

              .btn-primary table td {
                background-color: #3498db;
              }

              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff;
              }

              /* -------------------------------------
                  OTHER STYLES THAT MIGHT BE USEFUL
              ------------------------------------- */
              .last {
                margin-bottom: 0;
              }

              .first {
                margin-top: 0;
              }

              .align-center {
                text-align: center;
              }

              .align-right {
                text-align: right;
              }

              .align-left {
                text-align: left;
              }

              .clear {
                clear: both;
              }

              .mt0 {
                margin-top: 0;
              }

              .mb0 {
                margin-bottom: 0;
              }

              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0;
              }

              .powered-by a {
                text-decoration: none;
              }

              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0;
              }

              /* -------------------------------------
                  RESPONSIVE AND MOBILE FRIENDLY STYLES
              ------------------------------------- */
              @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important;
                }
                table.body p,
                table.body ul,
                table.body ol,
                table.body td,
                table.body span,
                table.body a {
                  font-size: 16px !important;
                }
                table.body .wrapper,
                table.body .article {
                  padding: 10px !important;
                }
                table.body .content {
                  padding: 0 !important;
                }
                table.body .container {
                  padding: 0 !important;
                  width: 100% !important;
                }
                table.body .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important;
                }
                table.body .btn table {
                  width: 100% !important;
                }
                table.body .btn a {
                  width: 100% !important;
                }
                table.body .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important;
                }
              }

              /* -------------------------------------
                  PRESERVE THESE STYLES IN THE HEAD
              ------------------------------------- */
              @media all {
                .ExternalClass {
                  width: 100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%;
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important;
                }
                #MessageViewBody a {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important;
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important;
                }
              }

            </style>
          </head>
          <body class="">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                <img src="' . $logourl . '" height="50" class="content">

                  <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">
                        <!--image url-->
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p>' . $greetingText . '</p>
                                <p>' . $headtext . '</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                        ' . $buttonis . '
                                    </tr>
                                  </tbody>
                                </table>
                                <p>' . $bottomtext . '</p>
                                <p>Thank you for using ' . $appname . '</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span class="apple-link">' . $location . '</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="content-block powered-by">
                            Powered by <a href="' . $baseurl . '">' . $appname . '</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->

                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';

        return $mailtemplate;
}
function loginMailText($userid, $sessioncode){      
      $userdsatas= mailgetUserData($userid);
      // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
      //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $usernameis=$userdsatas['username'];

      $systemdata=mailgetAllSystemSetting();
      // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
      //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $appname =  $systemdata['name'];
      $baseurl =  $systemdata['baseurl'];
      $location = $systemdata['location'];
      $summaryapp =$systemdata['appshortdetail'];
      $supportemail = $systemdata['supportemail'];
      $logourl =  $systemdata['appimgurl'];

      $usersseslog=mailgetUserSessionLog($usernameis,$sessioncode);
      //  `email`, `username`, `sessioncode`, `ipaddress`, `browser`, `date`, `status`, `location`, `inserttime`, `user_type`, `created_at`, `updated_at`
      $browser=$usersseslog['browser'];
      $ipaddress=$usersseslog['ipaddress'];


        $mailtext = "We noticed you just logged in. If this was not you, kindly chat with our support team.<br> <h3>IP Address:$ipaddress</h3><br><h3>Browser:$browser<h3>";

        return $mailtext;
}
function loginmailSubject($userid){
  $userdsatas= mailgetUserData($userid);
  // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $usernameis=$userdsatas['username'];

  $systemdata=mailgetAllSystemSetting();
  // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
  //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $appname =  $systemdata['name'];
  $baseurl =  $systemdata['baseurl'];
  $location = $systemdata['location'];
  $summaryapp =$systemdata['appshortdetail'];
  $supportemail = $systemdata['supportemail'];
  $logourl =  $systemdata['appimgurl'];

  $subject="New user";
  return $subject;
}
// forgot pass mail
function forgotPasswordHTML($userid, $resetink){
      $userdsatas= mailgetUserData($userid);
      // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
      //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $usernameis=$userdsatas['username'];

      $systemdata=mailgetAllSystemSetting();
      // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
      //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
      $appname =  $systemdata['name'];
      $baseurl =  $systemdata['baseurl'];
      $location = $systemdata['location'];
      $summaryapp =$systemdata['appshortdetail'];
      $supportemail = $systemdata['supportemail'];
      $logourl =  $systemdata['appimgurl'];


        $greetingText = "Hello $usernameis.";
        $headtext = "We received a notification for the reset of your account password,If this was you, you can safely disregard this note. If this wasn't you, please chat our support team immediately.<br>Your Password Reset link is <h5 align='center'>$resetink</h5> <p>kindly copy above link to your brower or click below button to reset your password</p>";
        $bottomtext = "If you have any questions, comments or concerns, don't hesitate to reach us via $supportemail, Thank you and we are excited to have you! Cheers!";
        // adding link and button of link use below
        $calltoaction = true; // set as true and add details below
        $calltoactionlink = "$resetink";
        $calltoactiontext = "Reset password";
        // adding link and button of link use below
        $buttonis = "";
        if ($calltoaction == true) {
            $buttonis = ' <td align="left">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td> <a href="' . $calltoactionlink . '" target="_blank">' . $calltoactiontext . '</a> </td>
                </tr>
              </tbody>
            </table>
          </td>';
        }

        $mailtemplate = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Simple Transactional Email</title>
            <style>
              /* -------------------------------------
                  GLOBAL RESETS
              ------------------------------------- */

              /*All the styling goes here*/

              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%;
              }

              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
              }

              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top;
              }

              /* -------------------------------------
                  BODY & CONTAINER
              ------------------------------------- */

              .body {
                background-color: #f6f6f6;
                width: 100%;
              }

              /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px;
              }

              /* This should also be a block element, so that it will fill 100% of the .container */
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px;
              }

              /* -------------------------------------
                  HEADER, FOOTER, MAIN
              ------------------------------------- */
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%;
              }

              .wrapper {
                box-sizing: border-box;
                padding: 20px;
              }

              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }

              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%;
              }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center;
              }

              /* -------------------------------------
                  TYPOGRAPHY
              ------------------------------------- */
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px;
              }

              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize;
              }

              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px;
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px;
              }

              a {
                color: #3498db;
                text-decoration: underline;
              }

              /* -------------------------------------
                  BUTTONS
              ------------------------------------- */
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto;
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center;
              }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize;
              }

              .btn-primary table td {
                background-color: #3498db;
              }

              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff;
              }

              /* -------------------------------------
                  OTHER STYLES THAT MIGHT BE USEFUL
              ------------------------------------- */
              .last {
                margin-bottom: 0;
              }

              .first {
                margin-top: 0;
              }

              .align-center {
                text-align: center;
              }

              .align-right {
                text-align: right;
              }

              .align-left {
                text-align: left;
              }

              .clear {
                clear: both;
              }

              .mt0 {
                margin-top: 0;
              }

              .mb0 {
                margin-bottom: 0;
              }

              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0;
              }

              .powered-by a {
                text-decoration: none;
              }

              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0;
              }

              /* -------------------------------------
                  RESPONSIVE AND MOBILE FRIENDLY STYLES
              ------------------------------------- */
              @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important;
                }
                table.body p,
                table.body ul,
                table.body ol,
                table.body td,
                table.body span,
                table.body a {
                  font-size: 16px !important;
                }
                table.body .wrapper,
                table.body .article {
                  padding: 10px !important;
                }
                table.body .content {
                  padding: 0 !important;
                }
                table.body .container {
                  padding: 0 !important;
                  width: 100% !important;
                }
                table.body .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important;
                }
                table.body .btn table {
                  width: 100% !important;
                }
                table.body .btn a {
                  width: 100% !important;
                }
                table.body .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important;
                }
              }

              /* -------------------------------------
                  PRESERVE THESE STYLES IN THE HEAD
              ------------------------------------- */
              @media all {
                .ExternalClass {
                  width: 100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%;
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important;
                }
                #MessageViewBody a {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important;
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important;
                }
              }

            </style>
          </head>
          <body class="">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                <img src="' . $logourl . '" height="50" class="content">

                  <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">
                        <!--image url-->
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p>' . $greetingText . '</p>
                                <p>' . $headtext . '</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                        ' . $buttonis . '
                                    </tr>
                                  </tbody>
                                </table>
                                <p>' . $bottomtext . '</p>
                                <p>Thank you for using ' . $appname . '</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span class="apple-link">' . $location . '</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="content-block powered-by">
                            Powered by <a href="' . $baseurl . '">' . $appname . '</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->

                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';

        return $mailtemplate;

}
function forgotPasswordText($userid, $resetink){
        $userdsatas= mailgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];

        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];
        $mailtext = "We received a notification for the reset of your account password,If this was you, you can safely disregard this note. If this wasn't you, please chat our support team immediately.<br>Your Password Reset link is <h5 align='center'>$resetink</h5> <p>kindly click to reset your password</p>";

        return $mailtext;

}
function forgotpassSubject($userid){
  $userdsatas= mailgetUserData($userid);
  // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $usernameis=$userdsatas['username'];

  $systemdata=mailgetAllSystemSetting();
  // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
  //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $appname =  $systemdata['name'];
  $baseurl =  $systemdata['baseurl'];
  $location = $systemdata['location'];
  $summaryapp =$systemdata['appshortdetail'];
  $supportemail = $systemdata['supportemail'];
  $logourl =  $systemdata['appimgurl'];

  $subject="New user";
  return $subject;
}
// reset pass mail
function resetPasswordSuccessHTML($userid){
        $userdsatas= mailgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];

        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];


        $greetingText = "Hello $usernameis.";
        $headtext = "Password reset successfully";
        $bottomtext = "If you have any questions, comments or concerns, don't hesitate to reach us via $supportemail, Thank you and we are excited to have you! Cheers!";
        // adding link and button of link use below
        $calltoaction = true; // set as true and add details below
        $calltoactionlink = $baseurl . "home/login";
        $calltoactiontext = "Login";
        // adding link and button of link use below
        $buttonis = "";
        if ($calltoaction == true) {
            $buttonis = ' <td align="left">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td> <a href="' . $calltoactionlink . '" target="_blank">' . $calltoactiontext . '</a> </td>
                </tr>
              </tbody>
            </table>
          </td>';
        }

        $mailtemplate = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Simple Transactional Email</title>
            <style>
              /* -------------------------------------
                  GLOBAL RESETS
              ------------------------------------- */

              /*All the styling goes here*/

              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%;
              }

              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
              }

              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top;
              }

              /* -------------------------------------
                  BODY & CONTAINER
              ------------------------------------- */

              .body {
                background-color: #f6f6f6;
                width: 100%;
              }

              /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px;
              }

              /* This should also be a block element, so that it will fill 100% of the .container */
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px;
              }

              /* -------------------------------------
                  HEADER, FOOTER, MAIN
              ------------------------------------- */
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%;
              }

              .wrapper {
                box-sizing: border-box;
                padding: 20px;
              }

              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }

              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%;
              }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center;
              }

              /* -------------------------------------
                  TYPOGRAPHY
              ------------------------------------- */
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px;
              }

              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize;
              }

              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px;
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px;
              }

              a {
                color: #3498db;
                text-decoration: underline;
              }

              /* -------------------------------------
                  BUTTONS
              ------------------------------------- */
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto;
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center;
              }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize;
              }

              .btn-primary table td {
                background-color: #3498db;
              }

              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff;
              }

              /* -------------------------------------
                  OTHER STYLES THAT MIGHT BE USEFUL
              ------------------------------------- */
              .last {
                margin-bottom: 0;
              }

              .first {
                margin-top: 0;
              }

              .align-center {
                text-align: center;
              }

              .align-right {
                text-align: right;
              }

              .align-left {
                text-align: left;
              }

              .clear {
                clear: both;
              }

              .mt0 {
                margin-top: 0;
              }

              .mb0 {
                margin-bottom: 0;
              }

              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0;
              }

              .powered-by a {
                text-decoration: none;
              }

              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0;
              }

              /* -------------------------------------
                  RESPONSIVE AND MOBILE FRIENDLY STYLES
              ------------------------------------- */
              @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important;
                }
                table.body p,
                table.body ul,
                table.body ol,
                table.body td,
                table.body span,
                table.body a {
                  font-size: 16px !important;
                }
                table.body .wrapper,
                table.body .article {
                  padding: 10px !important;
                }
                table.body .content {
                  padding: 0 !important;
                }
                table.body .container {
                  padding: 0 !important;
                  width: 100% !important;
                }
                table.body .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important;
                }
                table.body .btn table {
                  width: 100% !important;
                }
                table.body .btn a {
                  width: 100% !important;
                }
                table.body .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important;
                }
              }

              /* -------------------------------------
                  PRESERVE THESE STYLES IN THE HEAD
              ------------------------------------- */
              @media all {
                .ExternalClass {
                  width: 100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%;
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important;
                }
                #MessageViewBody a {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important;
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important;
                }
              }

            </style>
          </head>
          <body class="">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                <img src="' . $logourl . '" height="50" class="content">

                  <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">
                        <!--image url-->
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p>' . $greetingText . '</p>
                                <p>' . $headtext . '</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                        ' . $buttonis . '
                                    </tr>
                                  </tbody>
                                </table>
                                <p>' . $bottomtext . '</p>
                                <p>Thank you for using ' . $appname . '</p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                    <!-- END MAIN CONTENT AREA -->
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span class="apple-link">' . $location . '</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="content-block powered-by">
                            Powered by <a href="' . $baseurl . '">' . $appname . '</a>.
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- END FOOTER -->

                  </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';

        return $mailtemplate;

}
function resetPasswordSuccessText($userid) {
        $userdsatas= mailgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];

        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];

        $mailtext = "you have sc=uccssfully reset your password";

        return $mailtext;

}
function resetPasswordSubject($userid){
  $userdsatas= mailgetUserData($userid);
  // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $usernameis=$userdsatas['username'];

  $systemdata=mailgetAllSystemSetting();
  // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
  //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $appname =  $systemdata['name'];
  $baseurl =  $systemdata['baseurl'];
  $location = $systemdata['location'];
  $summaryapp =$systemdata['appshortdetail'];
  $supportemail = $systemdata['supportemail'];
  $logourl =  $systemdata['appimgurl'];

  $subject="New user";
  return $subject;
}
// payment successful mails
function paymentSuccessfullHTML($userid, $transorderid){

        $userdsatas= mailgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];

        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];

        
        $gttransdata=mailgetSingleUserTransWithOrderID($transorderid);
        // `userid`, `addresssentto`, `transhash`, `livetransid`, `orderid`, `ordertime`, `confirmtime`, `approvedby`, `status`, `liveusdrate`, `confirmation`, `syslivewallet`, `cointrackid`, `livecointype`, `addresssentfrm`, `btcvalue`, `theusdval`, `manualstatus`, `approvaltype`, `created_at`, `updated_at`, `ourrrate`, `amttopay`, `currencytag`, `transtype`, `virtualcardtrackid`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below, more data would be added as the system grows
        $transrealamt = $gttransdata['theusdval'];


        $greetingText = "Hello $usernameis.";
        $headtext = "Payment successful";
        $bottomtext = "If you have any questions, comments or concerns, don't hesitate to reach us via $supportemail, Thank you and we are excited to have you! Cheers!";
        // adding link and button of link use below
        $calltoaction = false; // set as true and add details below
        $calltoactionlink = "";
        $calltoactiontext = "";
        // adding link and button of link use below
        $buttonis = "";
        if ($calltoaction == true) {
            $buttonis = ' <td align="left">
          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td> <a href="' . $calltoactionlink . '" target="_blank">' . $calltoactiontext . '</a> </td>
              </tr>
            </tbody>
          </table>
        </td>';
        }

        $mailtemplate = '<!doctype html>
      <html>
        <head>
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <title>Simple Transactional Email</title>
          <style>
            /* -------------------------------------
                GLOBAL RESETS
            ------------------------------------- */

            /*All the styling goes here*/

            img {
              border: none;
              -ms-interpolation-mode: bicubic;
              max-width: 100%;
            }

            body {
              background-color: #f6f6f6;
              font-family: sans-serif;
              -webkit-font-smoothing: antialiased;
              font-size: 14px;
              line-height: 1.4;
              margin: 0;
              padding: 0;
              -ms-text-size-adjust: 100%;
              -webkit-text-size-adjust: 100%;
            }

            table {
              border-collapse: separate;
              mso-table-lspace: 0pt;
              mso-table-rspace: 0pt;
              width: 100%; }
              table td {
                font-family: sans-serif;
                font-size: 14px;
                vertical-align: top;
            }

            /* -------------------------------------
                BODY & CONTAINER
            ------------------------------------- */

            .body {
              background-color: #f6f6f6;
              width: 100%;
            }

            /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
            .container {
              display: block;
              margin: 0 auto !important;
              /* makes it centered */
              max-width: 580px;
              padding: 10px;
              width: 580px;
            }

            /* This should also be a block element, so that it will fill 100% of the .container */
            .content {
              box-sizing: border-box;
              display: block;
              margin: 0 auto;
              max-width: 580px;
              padding: 10px;
            }

            /* -------------------------------------
                HEADER, FOOTER, MAIN
            ------------------------------------- */
            .main {
              background: #ffffff;
              border-radius: 3px;
              width: 100%;
            }

            .wrapper {
              box-sizing: border-box;
              padding: 20px;
            }

            .content-block {
              padding-bottom: 10px;
              padding-top: 10px;
            }

            .footer {
              clear: both;
              margin-top: 10px;
              text-align: center;
              width: 100%;
            }
              .footer td,
              .footer p,
              .footer span,
              .footer a {
                color: #999999;
                font-size: 12px;
                text-align: center;
            }

            /* -------------------------------------
                TYPOGRAPHY
            ------------------------------------- */
            h1,
            h2,
            h3,
            h4 {
              color: #000000;
              font-family: sans-serif;
              font-weight: 400;
              line-height: 1.4;
              margin: 0;
              margin-bottom: 30px;
            }

            h1 {
              font-size: 35px;
              font-weight: 300;
              text-align: center;
              text-transform: capitalize;
            }

            p,
            ul,
            ol {
              font-family: sans-serif;
              font-size: 14px;
              font-weight: normal;
              margin: 0;
              margin-bottom: 15px;
            }
              p li,
              ul li,
              ol li {
                list-style-position: inside;
                margin-left: 5px;
            }

            a {
              color: #3498db;
              text-decoration: underline;
            }

            /* -------------------------------------
                BUTTONS
            ------------------------------------- */
            .btn {
              box-sizing: border-box;
              width: 100%; }
              .btn > tbody > tr > td {
                padding-bottom: 15px; }
              .btn table {
                width: auto;
            }
              .btn table td {
                background-color: #ffffff;
                border-radius: 5px;
                text-align: center;
            }
              .btn a {
                background-color: #ffffff;
                border: solid 1px #3498db;
                border-radius: 5px;
                box-sizing: border-box;
                color: #3498db;
                cursor: pointer;
                display: inline-block;
                font-size: 14px;
                font-weight: bold;
                margin: 0;
                padding: 12px 25px;
                text-decoration: none;
                text-transform: capitalize;
            }

            .btn-primary table td {
              background-color: #3498db;
            }

            .btn-primary a {
              background-color: #3498db;
              border-color: #3498db;
              color: #ffffff;
            }

            /* -------------------------------------
                OTHER STYLES THAT MIGHT BE USEFUL
            ------------------------------------- */
            .last {
              margin-bottom: 0;
            }

            .first {
              margin-top: 0;
            }

            .align-center {
              text-align: center;
            }

            .align-right {
              text-align: right;
            }

            .align-left {
              text-align: left;
            }

            .clear {
              clear: both;
            }

            .mt0 {
              margin-top: 0;
            }

            .mb0 {
              margin-bottom: 0;
            }

            .preheader {
              color: transparent;
              display: none;
              height: 0;
              max-height: 0;
              max-width: 0;
              opacity: 0;
              overflow: hidden;
              mso-hide: all;
              visibility: hidden;
              width: 0;
            }

            .powered-by a {
              text-decoration: none;
            }

            hr {
              border: 0;
              border-bottom: 1px solid #f6f6f6;
              margin: 20px 0;
            }

            /* -------------------------------------
                RESPONSIVE AND MOBILE FRIENDLY STYLES
            ------------------------------------- */
            @media only screen and (max-width: 620px) {
              table.body h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
              }
              table.body p,
              table.body ul,
              table.body ol,
              table.body td,
              table.body span,
              table.body a {
                font-size: 16px !important;
              }
              table.body .wrapper,
              table.body .article {
                padding: 10px !important;
              }
              table.body .content {
                padding: 0 !important;
              }
              table.body .container {
                padding: 0 !important;
                width: 100% !important;
              }
              table.body .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
              }
              table.body .btn table {
                width: 100% !important;
              }
              table.body .btn a {
                width: 100% !important;
              }
              table.body .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
              }
            }

            /* -------------------------------------
                PRESERVE THESE STYLES IN THE HEAD
            ------------------------------------- */
            @media all {
              .ExternalClass {
                width: 100%;
              }
              .ExternalClass,
              .ExternalClass p,
              .ExternalClass span,
              .ExternalClass font,
              .ExternalClass td,
              .ExternalClass div {
                line-height: 100%;
              }
              .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
              }
              #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
              }
              .btn-primary table td:hover {
                background-color: #34495e !important;
              }
              .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
              }
            }

          </style>
        </head>
        <body class="">
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
            <tr>
              <td>&nbsp;</td>
              <td class="container">
              <img src="' . $logourl . '" height="50" class="content">

                <div class="content">

                  <!-- START CENTERED WHITE CONTAINER -->
                  <table role="presentation" class="main">
                      <!--image url-->
                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                      <td class="wrapper">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td>
                              <p>' . $greetingText . '</p>
                              <p>' . $headtext . '</p>
                              <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                <tbody>
                                  <tr>
                                      ' . $buttonis . '
                                  </tr>
                                </tbody>
                              </table>
                              <p>' . $bottomtext . '</p>
                              <p>Thank you for using ' . $appname . '</p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>

                  <!-- END MAIN CONTENT AREA -->
                  </table>
                  <!-- END CENTERED WHITE CONTAINER -->

                  <!-- START FOOTER -->
                  <div class="footer">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td class="content-block">
                          <span class="apple-link">' . $location . '</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="content-block powered-by">
                          Powered by <a href="' . $baseurl . '">' . $appname . '</a>.
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- END FOOTER -->

                </div>
              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </body>
      </html>';

        return $mailtemplate;

}
function paymentSuccessfullText($userid, $transorderid){
        $userdsatas= mailgetUserData($userid);
        // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $usernameis=$userdsatas['username'];

        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];

        
        $gttransdata=mailgetSingleUserTransWithOrderID($transorderid);
        // `userid`, `addresssentto`, `transhash`, `livetransid`, `orderid`, `ordertime`, `confirmtime`, `approvedby`, `status`, `liveusdrate`, `confirmation`, `syslivewallet`, `cointrackid`, `livecointype`, `addresssentfrm`, `btcvalue`, `theusdval`, `manualstatus`, `approvaltype`, `created_at`, `updated_at`, `ourrrate`, `amttopay`, `currencytag`, `transtype`, `virtualcardtrackid`
        //  if you need to pick any data of the user , check above for the data field name and call it as seen below, more data would be added as the system grows
        $transrealamt = $gttransdata['theusdval'];

        $mailtext = "Payment Succssfully made";

        return $mailtext;

}
function paymentSuccessSubject($userid, $transorderid){
  $userdsatas= mailgetUserData($userid);
  // `email`, `fname`, `username`, `lname`, `password`, `phoneno`, `bal`, `refcode`, `referby`, `fcm`, `status`, `adminseen`, `userpubkey`, `created_at`, `updated_at`, `state`, `country`, `dob`, `sex`, `emailverified`, `phoneverified`, `address1`, `address2`, `nextkinfname`, `nextkinemail`, `nextkinpno`, `nextkinaddress`, `depositnotification`, `securitynotification`, `transfernotification`, `userlevel`, `lastpassupdate`
  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $usernameis=$userdsatas['username'];

          
  $gttransdata=mailgetSingleUserTransWithOrderID($transorderid);
  // `userid`, `addresssentto`, `transhash`, `livetransid`, `orderid`, `ordertime`, `confirmtime`, `approvedby`, `status`, `liveusdrate`, `confirmation`, `syslivewallet`, `cointrackid`, `livecointype`, `addresssentfrm`, `btcvalue`, `theusdval`, `manualstatus`, `approvaltype`, `created_at`, `updated_at`, `ourrrate`, `amttopay`, `currencytag`, `transtype`, `virtualcardtrackid`
  //  if you need to pick any data of the user , check above for the data field name and call it as seen below, more data would be added as the system grows
  $transrealamt = $gttransdata['theusdval'];

  $systemdata=mailgetAllSystemSetting();
  // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
  //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $appname =  $systemdata['name'];
  $baseurl =  $systemdata['baseurl'];
  $location = $systemdata['location'];
  $summaryapp =$systemdata['appshortdetail'];
  $supportemail = $systemdata['supportemail'];
  $logourl =  $systemdata['appimgurl'];

  $subject="New user";
  return $subject;
}
  
function errorMessageHTML($errorMsg){
        //  for admin
  
        $systemdata=mailgetAllSystemSetting();
        // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
        //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
        $appname =  $systemdata['name'];
        $baseurl =  $systemdata['baseurl'];
        $location = $systemdata['location'];
        $summaryapp =$systemdata['appshortdetail'];
        $supportemail = $systemdata['supportemail'];
        $logourl =  $systemdata['appimgurl'];
  

        $greetingText = "Hello programmer.";
        $headtext = "$errorMsg";
        $bottomtext = "";
        // adding link and button of link use below
        $calltoaction = false; // set as true and add details below
        $calltoactionlink = "";
        $calltoactiontext = "";
        // adding link and button of link use below
        $buttonis = "";
        if ($calltoaction == true) {
            $buttonis = ' <td align="left">
      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td> <a href="' . $calltoactionlink . '" target="_blank">' . $calltoactiontext . '</a> </td>
          </tr>
        </tbody>
      </table>
        </td>';
            }

        $mailtemplate = '<!doctype html>
            <html>
              <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Simple Transactional Email</title>
                <style>
                  /* -------------------------------------
                      GLOBAL RESETS
                  ------------------------------------- */

                  /*All the styling goes here*/

                  img {
                    border: none;
                    -ms-interpolation-mode: bicubic;
                    max-width: 100%;
                  }

                  body {
                    background-color: #f6f6f6;
                    font-family: sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                    padding: 0;
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                  }

                  table {
                    border-collapse: separate;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    width: 100%; }
                    table td {
                      font-family: sans-serif;
                      font-size: 14px;
                      vertical-align: top;
                  }

                  /* -------------------------------------
                      BODY & CONTAINER
                  ------------------------------------- */

                  .body {
                    background-color: #f6f6f6;
                    width: 100%;
                  }

                  /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                  .container {
                    display: block;
                    margin: 0 auto !important;
                    /* makes it centered */
                    max-width: 580px;
                    padding: 10px;
                    width: 580px;
                  }

                  /* This should also be a block element, so that it will fill 100% of the .container */
                  .content {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    max-width: 580px;
                    padding: 10px;
                  }

                  /* -------------------------------------
                      HEADER, FOOTER, MAIN
                  ------------------------------------- */
                  .main {
                    background: #ffffff;
                    border-radius: 3px;
                    width: 100%;
                  }

                  .wrapper {
                    box-sizing: border-box;
                    padding: 20px;
                  }
                  .makeitCenter{
                    text-align: center;
                  }

                  .content-block {
                    padding-bottom: 10px;
                    padding-top: 10px;
                  }

                  .footer {
                    clear: both;
                    margin-top: 10px;
                    text-align: center;
                    width: 100%;
                  }
                    .footer td,
                    .footer p,
                    .footer span,
                    .footer a {
                      color: #999999;
                      font-size: 12px;
                      text-align: center;
                  }

                  /* -------------------------------------
                      TYPOGRAPHY
                  ------------------------------------- */
                  h1,
                  h2,
                  h3,
                  h4 {
                    color: #000000;
                    font-family: sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    margin: 0;
                    margin-bottom: 30px;
                  }

                  h1 {
                    font-size: 35px;
                    font-weight: 300;
                    text-align: center;
                    text-transform: capitalize;
                  }

                  p,
                  ul,
                  ol {
                    font-family: sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    margin: 0;
                    margin-bottom: 15px;
                  }
                    p li,
                    ul li,
                    ol li {
                      list-style-position: inside;
                      margin-left: 5px;
                  }

                  a {
                    color: #3498db;
                    text-decoration: underline;
                  }

                  /* -------------------------------------
                      BUTTONS
                  ------------------------------------- */
                  .btn {
                    box-sizing: border-box;
                    width: 100%; }
                    .btn > tbody > tr > td {
                      padding-bottom: 15px; }
                    .btn table {
                      width: auto;
                  }
                    .btn table td {
                      background-color: #ffffff;
                      border-radius: 5px;
                      text-align: center;
                  }
                    .btn a {
                      background-color: #ffffff;
                      border: solid 1px #3498db;
                      border-radius: 5px;
                      box-sizing: border-box;
                      color: #3498db;
                      cursor: pointer;
                      display: inline-block;
                      font-size: 14px;
                      font-weight: bold;
                      margin: 0;
                      padding: 12px 25px;
                      text-decoration: none;
                      text-transform: capitalize;
                  }

                  .btn-primary table td {
                    background-color: #3498db;
                  }

                  .btn-primary a {
                    background-color: #3498db;
                    border-color: #3498db;
                    color: #ffffff;
                  }

                  /* -------------------------------------
                      OTHER STYLES THAT MIGHT BE USEFUL
                  ------------------------------------- */
                  .last {
                    margin-bottom: 0;
                  }

                  .first {
                    margin-top: 0;
                  }

                  .align-center {
                    text-align: center;
                  }

                  .align-right {
                    text-align: right;
                  }

                  .align-left {
                    text-align: left;
                  }

                  .clear {
                    clear: both;
                  }

                  .mt0 {
                    margin-top: 0;
                  }

                  .mb0 {
                    margin-bottom: 0;
                  }

                  .preheader {
                    color: transparent;
                    display: none;
                    height: 0;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                    mso-hide: all;
                    visibility: hidden;
                    width: 0;
                  }

                  .powered-by a {
                    text-decoration: none;
                  }

                  hr {
                    border: 0;
                    border-bottom: 1px solid #f6f6f6;
                    margin: 20px 0;
                  }

                  /* -------------------------------------
                      RESPONSIVE AND MOBILE FRIENDLY STYLES
                  ------------------------------------- */
                  @media only screen and (max-width: 620px) {
                    table.body h1 {
                      font-size: 28px !important;
                      margin-bottom: 10px !important;
                    }
                    table.body p,
                    table.body ul,
                    table.body ol,
                    table.body td,
                    table.body span,
                    table.body a {
                      font-size: 16px !important;
                    }
                    table.body .wrapper,
                    table.body .article {
                      padding: 10px !important;
                    }
                    table.body .content {
                      padding: 0 !important;
                    }
                    table.body .container {
                      padding: 0 !important;
                      width: 100% !important;
                    }
                    table.body .main {
                      border-left-width: 0 !important;
                      border-radius: 0 !important;
                      border-right-width: 0 !important;
                    }
                    table.body .btn table {
                      width: 100% !important;
                    }
                    table.body .btn a {
                      width: 100% !important;
                    }
                    table.body .img-responsive {
                      height: auto !important;
                      max-width: 100% !important;
                      width: auto !important;
                    }
                  }

                  /* -------------------------------------
                      PRESERVE THESE STYLES IN THE HEAD
                  ------------------------------------- */
                  @media all {
                    .ExternalClass {
                      width: 100%;
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                      line-height: 100%;
                    }
                    .apple-link a {
                      color: inherit !important;
                      font-family: inherit !important;
                      font-size: inherit !important;
                      font-weight: inherit !important;
                      line-height: inherit !important;
                      text-decoration: none !important;
                    }
                    #MessageViewBody a {
                      color: inherit;
                      text-decoration: none;
                      font-size: inherit;
                      font-family: inherit;
                      font-weight: inherit;
                      line-height: inherit;
                    }
                    .btn-primary table td:hover {
                      background-color: #34495e !important;
                    }
                    .btn-primary a:hover {
                      background-color: #34495e !important;
                      border-color: #34495e !important;
                    }
                  }

                </style>
              </head>
              <body class="">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                  <tr>
                    <td>&nbsp;</td>
                    <td class="container">
                    <img src="' . $logourl . '" height="50" class="content">

                      <div class="content">

                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role="presentation" class="main">
                            <!--image url-->
                          <!-- START MAIN CONTENT AREA -->
                          <tr>
                            <td class="wrapper">
                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td>
                                    <p>' . $greetingText . '</p>
                                    <p>' . $headtext . '</p>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                      <tbody>
                                        <tr>
                                            ' . $buttonis . '
                                        </tr>
                                      </tbody>
                                    </table>
                                    <p>' . $bottomtext . '</p>
                                    <p>Thank you for using ' . $appname . '</p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>

                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        <!-- END CENTERED WHITE CONTAINER -->

                        <!-- START FOOTER -->
                        <div class="footer">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td class="content-block">
                                <span class="apple-link">' . $location . '</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="content-block powered-by">
                                Powered by <a href="' . $baseurl . '">' . $appname . '</a>.
                              </td>
                            </tr>
                          </table>
                        </div>
                        <!-- END FOOTER -->

                      </div>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </body>
            </html>';

        return $mailtemplate;

}
function errorMessageText($errorMsg){
        $alldata = [];

        $mailtext = "$errorMsg";

        return $mailtext;

}
function errorMessageSubject($errorMsg){
  $systemdata=mailgetAllSystemSetting();
  // `name`, `iosversion`, `androidversion`, `webversion`, `activesmssystem`, `activemailsystem`, `emailfrom`, `baseurl`, `location`, `appshortdetail`, `supportemail`, `appimgurl`, `created_at`, `updated_at`
  //  //  if you need to pick any data of the user , check above for the data field name and call it as seen below
  $appname =  $systemdata['name'];
  $baseurl =  $systemdata['baseurl'];
  $location = $systemdata['location'];
  $summaryapp =$systemdata['appshortdetail'];
  $supportemail = $systemdata['supportemail'];
  $logourl =  $systemdata['appimgurl'];

  $subject="New user";
  return $subject;
}



