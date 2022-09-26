<?php
// send some CORS headers so the API can be called from anywhere
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");// OPTIONS,GET,POST,PUT,DELETE
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
Header("Cache-Control: no-cache");
// header("Access-Control-Max-Age: 3600");//3600 seconds
// 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

include "../cartsfunction.php";
require '../googleAPI/vendor/autoload.php';

$method = getenv('REQUEST_METHOD');
$endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);
$maindata=[];  

//allow only post method
if (getenv('REQUEST_METHOD') === 'GET'){
  //get companydetalis and servername for auth token
  $detailsID =1;
  $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
  $getCompanyDetails->bind_param('i', $detailsID);
  $getCompanyDetails->execute();
  $result = $getCompanyDetails->get_result();
  $companyDetails = $result->fetch_assoc();
  $companyprivateKey = $companyDetails['privatekey'];
  $minutetoend = $companyDetails['tokenexpiremin'];
  $serverName = $companyDetails['servername'];

  // init configuration
  $googleOauthKey = getActiveGoogleOauthDetails($connect);
  $clientID = $googleOauthKey['clientID'];
  $clientSecret = $googleOauthKey['clientSecret'];
  $redirectUri = $googleOauthKey['redirectUri'];
    
  // create Client Request to access Google API
  // $client = new Google_Client();
  $client = new Google\Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");
    
  // authenticate code from Google OAuth Flow
  if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    
    // get profile info
  //   $google_oauth = new Google_Service_Oauth2($client);
    $google_oauth = new Google\Service\Oauth2($client);

    //get user info from google
    $google_account_info = $google_oauth->userinfo->get();
    $user = googleLogin($connect, $google_account_info);
    //return user pub key
    if($user){
      // header('location: ../../user/index.php');
      $userid = $google_account_info->id;
      $email =  $google_account_info->email;
      $firstname = $google_account_info->given_name;
      $surname =  $google_account_info->family_name;
      $gender = $google_account_info->gender;
      $name =  $google_account_info->name;
      $token = getTokenToSendAPI($userid,$companyprivateKey,$minutetoend,$serverName);
      $maindata = [
        'redirectLink'=>'../../user/index.php',
        'userInfo'=>$google_account_info,
      ];
      $errordesc = "";
      $linktosolve = "htps://";
      $hint = [];
      $errordata = [];
      $text = "User Details Fetched";
      $status = true;
      $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
      respondOK($data);
    }else{
      //go to error
      header('Location: ../../user/errorpage.php');
      exit();
    }
    
  } else {
    $redirectLink = $client->createAuthUrl();
    // header("Location: $redirectLink");
    // // echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
    $maindata = [
      'redirectLink'=>$redirectLink,
      
    ];
    $errordesc = "";
    $linktosolve = "htps://";
    $hint = [];
    $errordata = [];
    $text = "User Details Fetched";
    $status = true;
    $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
    respondOK($data);
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