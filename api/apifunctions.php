
<?php
include("Firebase/Firebase/src/JWT.php");
use \Firebase\JWT\JWT; 
// activate this to prevnt errors from breaking the API , but remove it when debugging
// error_reporting(E_ERROR | E_PARSE);
// LATER UPGRADEs
/*
***Convert ALL API to class
*** Add all link to documentation
*** add more hint

*/
//  ALL RESPONSE CODE
function respondOK($data){
    // response 
    header('HTTP/1.1 200 OK');
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondNotCompleted($data){
    // 202 Accepted Indicates that the request has been received but not completed yet.
    header('HTTP/1.1 202 OK');
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondURLChanged($data){
    // The URL of the requested resource has been changed temporarily
    header('HTTP/1.1 302 URL changed');
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondNotFound($data){
    //  Not found
    header('HTTP/1.1 404 Not found');
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondForbiddenAuthorized($data){
    // 403 Forbidden
    // Unauthorized request. The client does not have access rights to the content. Unlike 401, the client’s identity is known to the server.
    header("HTTP/1.1 403 Forbidden");
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondUnAuthorized($data){
    // the client’s identity is known to the server.
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondInternalError($data){
    //  internal server error
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondBadRequest($data){
    // 400 Bad Request
    header("HTTP/1.1 400 Bad request");
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
function respondMethodNotAlowed($data){
    // 405 Method Not Allowed
    header("HTTP/1.1 405 Method Not allowed");
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    exit;
}
// ALL RESPONSE CODE

// ALL RESPONSE ERROR
function returnError7001($errordesc,$linktosolve,$hint){
    // bad request
    $data = ["code"=>7001,"text"=>$errordesc,"link"=>"$linktosolve","hint"=>$hint];
    return $data;
}
function returnError7002($errordesc,$linktosolve,$hint){
    // Unauthorized
    $data = ["code"=>7002,"text"=>$errordesc,"link"=>"$linktosolve","hint"=>$hint];
    return $data;
}
function returnError7003($errordesc,$linktosolve,$hint){
    // Method Not allowed
    $data = ["code"=>7003,"text"=>$errordesc,"link"=>"$linktosolve","hint"=>$hint];
    return $data;
}
// ALL ERROR RESPONSE

// RETURN ERROR
function returnErrorArray($text,$method,$endpoint,$errordata,$maindata=[]){
    $data = ["status"=>false,"text" => $text,"data" => $maindata, "time" => date("d-m-y H:i:sA",time()), "method" => $method, "endpoint" => $endpoint,"error"=>$errordata];
    return $data;
}
//  RETURN DATA 
function returnSuccessArray($text,$method,$endpoint,$errordata,$data,$status){
    $data = ["status"=>$status,"text" => $text,"data" => $data, "time" => date("d-m-y H:i:sA",time()), "method" => $method, "endpoint" => $endpoint,"error"=>$errordata];
    return $data;
}


// Generated a unique pub key for all users
// generate Unique prive key for company from admin panel
// set Server name on admin $serverName
function getTokenToSendAPI($userPubkey,$companyprivateKey,$minutetoend,$serverName){
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify("+$minutetoend minutes")->getTimestamp();  
    $serverName = $serverName;
    $username   = "$userPubkey";
    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'usertoken' => $username,                     // User name
    ];

    // Encode the array to a JWT string.
    //  get token below
    $auttokn= JWT::encode(
        $data,
        $companyprivateKey,
        'HS512'
    );
    return $auttokn;
}

function ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint){
        $headerName = 'Authorization';
        $headers = getallheaders();
        $signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
        if($signraturHeader==null){
            $signraturHeader= isset($_SERVER['Authorization'])?$_SERVER['Authorization']:"";
        }

    try{
        if (! preg_match('/Bearer\s(\S+)/',$signraturHeader, $matches)) {
            $errordesc="The format sent in does not match the correct format for the API";
            $linktosolve="htps://";
            $hint=["Check if all header values are sent correctly.","Follow the format stated in the documentation","All letters in upper case must be in upper case","Ensure the correct method is used"];
            $errordata=returnError7001($errordesc,$linktosolve,$hint);
            $text="Bad request";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondUnAuthorized($data);
            exit;
        }

        $jwt = $matches[1];

        if (! $jwt) {
        // No token was able to be extracted from the authorization header
        $errordesc="The format sent in does not match the correct format for the API";
        $linktosolve="htps://";
        $hint=["Check if all header values are sent correctly.","Follow the format stated in the documentation","All letters in upper case must be in upper case","Ensure the correct method is used"];
        $errordata=returnError7001($errordesc,$linktosolve,$hint);
        $text="Bad request";
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondUnAuthorized($data);
        exit;
        }

        $secretKey  = $companyprivateKey;
        $token = JWT::decode($jwt, $secretKey, ['HS512']);
        $now = new DateTimeImmutable();

        if ($token->iss !== $serverName ||   $token->nbf > $now->getTimestamp() || $token->exp < $now->getTimestamp() || empty($token->usertoken)) {
            $errordesc="Uauthorized";
            $linktosolve="htps://";
            $hint=["Check if all header values are sent correctly.","Ensure token has not expired","Regenerate token","Ensure the correct method is used","Token is case sensitve"];
            $errordata=returnError7001($errordesc,$linktosolve,$hint);
            $text="Unauthorized";
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondUnAuthorized($data);
            exit;
        }
        

        return $token;
    }
//catch exception
catch(Exception $e) {
    // echo 'Message: ' .$e->getMessage();
     // No token was able to be extracted from the authorization header
     $errordesc="The format sent in does not match the correct format for the API";
     $linktosolve="htps://";
     $hint=["Check if all header values are sent correctly.","Ensure token has not expired","Regenerate token","Follow the format stated in the documentation","All letters in upper case must be in upper case","Ensure the correct method is used"];
     $errordata=returnError7001($errordesc,$linktosolve,$hint);
     $text="Bad request";
     $data=returnErrorArray($text,$method,$endpoint,$errordata);
     respondUnAuthorized($data);
     exit;
  }
}

?>