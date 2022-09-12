<?php
require("connectdb.php");


function redirect($new_location)
{
    header("location: ".$new_location);
    exit;
}
function cleanme($data) 
{
    global $connect;
    $input = $data;
    // This removes all the HTML tags from a string. This will sanitize the input string, and block any HTML tag from entering into the database.
    // filter_var($geeks, FILTER_SANITIZE_STRING);
    $input = filter_var($input, FILTER_SANITIZE_STRING);
    $input = trim($input, " \t\n\r");
    // htmlspecialchars() convert the special characters to HTML entities while htmlentities() converts all characters.
    // Convert the predefined characters "<" (less than) and ">" (greater than) to HTML entities:
    $input = htmlspecialchars($input, ENT_QUOTES,'UTF-8');
    // prevent javascript codes, Convert some characters to HTML entities:
    $input = htmlentities($input, ENT_QUOTES, 'UTF-8');
    $input = stripslashes(strip_tags($input));
    $input = mysqli_real_escape_string($connect, $input);

    return $input;
}
function getDatetimethatPasssed($endday){
    //3-05-3203
    $todayis=date("Y-m-d");
    $earlier = new DateTime("$endday");
    $later = new DateTime("$todayis");

    $abs_diff = $later->diff($earlier)->format("%a"); //3
    return $abs_diff;
}
function getDaysPassed($vendorsubendday){
    //155555444545
    $datediff =time()-$vendorsubendday;
    // $datediff =$vendorsubendday-$vendorsubstartday;//getting total days btw
    //60 is for minute
    //60 by 60 is for hr
    //60 by 60 by 24 is for days
    //any number by 60 by 60 by 24 is for months
    $difference = round($datediff/(24 * 60 *60));//getting days
    return $difference;
}
function getMinBetweentimes($latesttime,$oldtime){
    //8838983498
    $minbtwis=0;
    $subtractit=$latesttime-$oldtime;
    $minbtwis= round($subtractit/(60));
    //60 is for minute
    //60 by 60 is for hr
    //60 by 60 by 24 is for days
    //any number by 60 by 60 by 24 is for months
    return $minbtwis;
}
function getthe24Time($time){
    $data = $time;
    $date =  date('H:i',$data);
    return $date;
}
function isStringHasEmojis($string){
    $emojis_regex =
        '/[\x{0080}-\x{02AF}'
        .'\x{0300}-\x{03FF}'
        .'\x{0600}-\x{06FF}'
        .'\x{0C00}-\x{0C7F}'
        .'\x{1DC0}-\x{1DFF}'
        .'\x{1E00}-\x{1EFF}'
        .'\x{2000}-\x{209F}'
        .'\x{20D0}-\x{214F}'
        .'\x{2190}-\x{23FF}'
        .'\x{2460}-\x{25FF}'
        .'\x{2600}-\x{27EF}'
        .'\x{2900}-\x{29FF}'
        .'\x{2B00}-\x{2BFF}'
        .'\x{2C60}-\x{2C7F}'
        .'\x{2E00}-\x{2E7F}'
        .'\x{3000}-\x{303F}'
        .'\x{A490}-\x{A4CF}'
        .'\x{E000}-\x{F8FF}'
        .'\x{FE00}-\x{FE0F}'
        .'\x{FE30}-\x{FE4F}'
        .'\x{1F000}-\x{1F02F}'
        .'\x{1F0A0}-\x{1F0FF}'
        .'\x{1F100}-\x{1F64F}'
        .'\x{1F680}-\x{1F6FF}'
        .'\x{1F910}-\x{1F96B}'
        .'\x{1F980}-\x{1F9E0}]/u';
    preg_match($emojis_regex, $string, $matches);
    return !empty($matches);
}
function addDaysToTime($day,$time){
    $currentTime = $time;
   //The amount of hours that you want to add.
   $daysToAdd = $day;
   //Convert the hours into seconds.
   $secondsToAdd = $daysToAdd * (24 * 60* 60);
   //Add the seconds onto the current Unix timestamp.
   $newTime = $currentTime + $secondsToAdd;
   return $newTime;
}
function gettheTimeAndDate($time)
{
    $data = $time;
    $date =  date("d/M/Y h:ia", $data);
    return $date;
}

function generate_string($input, $strength)
{
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}


function convertTime($time)
{
    //88734873489 
    $data = $time;
    $date = strtotime($data);
    return $date;
}

//Has password function starts here
function Password_encrypt($user_pass)
{
    $BlowFish_Format="$2y$10$";
    $salt_len=24;
    $salt=Get_Salt($salt_len);
    $the_format=$BlowFish_Format . $salt;
    
    $hash_pass=crypt($user_pass, $the_format);
    return $hash_pass;
}

function Get_Salt($size)
{
    $Random_string= md5(uniqid(mt_rand(), true));
    
    $Base64_String= base64_encode($Random_string);
    
    $change_string=str_replace('+', '.', $Base64_String);
    
    $salt=substr($change_string, 0, $size);
    
    return $salt;
}

function check_pass($pass, $storedPass)
{
    $Hash=crypt($pass, $storedPass);
    if ($Hash===$storedPass) {
        return(true);
    } else {
        return(false);
    }
}

// system fnctions
function  GetActivePayStackApi(){
   global  $connect;
    $alldata=[];
    $active=1;
    $getdataemail =  $connect->prepare("SELECT * FROM paystackapidetails WHERE status=?");
    $getdataemail->bind_param("s",$active);
    $getdataemail->execute();
    $getresultemail = $getdataemail->get_result();
    if( $getresultemail->num_rows> 0){
        $getthedata= $getresultemail->fetch_assoc();
        $alldata=$getthedata;
    }
    return $alldata;
}
function  GetActiveMonifyApi(){
     global  $connect;
    $alldata=[];
    $active=1;
    $getdataemail =  $connect->prepare("SELECT * FROM monifyapidetails WHERE status=?");
    $getdataemail->bind_param("s",$active);
    $getdataemail->execute();
    $getresultemail = $getdataemail->get_result();
    if( $getresultemail->num_rows> 0){
        $getthedata= $getresultemail->fetch_assoc();
        $alldata=$getthedata;
    }
    return $alldata;
}
function  GetActiveSendGridApi(){
     global  $connect;
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
function  GetActiveTermiApi(){
     global  $connect;
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
     global  $connect;
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
     global  $connect;
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
function  GetAllSystemSetting(){
     global  $connect;
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
function sendUserMail($emailfrom,$subject,$toemail,$msgintext,$messageinhtml){
    // 1 sendGrid, 2
    $mailsent=false;
    $activemailsystem=GetAllSystemSetting()['activemailsystem'];
    if($activemailsystem==1){
        $mailsent=sendWithSenGrid($emailfrom,$subject,$toemail,$msgintext,$messageinhtml);
    }
    return $mailsent;
}
function sendUserSMS($sendto,$smstosend){
    // 1 Termi, 2 kudi 3 smart solution
    $smssent=false;
    $activemailsystem=GetAllSystemSetting()['activesmssystem'];
    if($activemailsystem==1){
        $smssent=sendWithTermi($sendto,$smstosend);
    }else if($activemailsystem==2){
        $smssent=sendWithKudiSMS($sendto,$smstosend);
    }else if($activemailsystem==3){
        $smssent=sendWithSmartSolution($sendto,$smstosend);
    }
    return $smssent;
}

include "../apifunctions.php";
include "../myfunctions.php";


// user fjnc
    
    
    
    
    
?>