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

    $method = getenv('REQUEST_METHOD');
    $endpoint =  basename($_SERVER['PHP_SELF']);

    if ($method == 'POST') {
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
        //check if its admin
        if(!checkIfIsAdmin($connect, $userpubkey)){
            //respond not admin
            $errordesc =  "User not an Admin";
            $linktosolve = 'https://';
            $hint = "Only Admin can access this route";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
            respondBadRequest($data);
        }
        
        if(!isset($_POST['id'])){
            $errordesc="id required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in  id";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $id = cleanme($_POST['id']); 
        }

        if(!isset($_POST['name'])){
            $errordesc="name required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Pass in  name";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
            
        }else {
            $name = cleanme($_POST['name']); 
        }

        if(!isset($_POST['description'])){
            $errordesc="description required";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Input Description";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            $description = cleanme($_POST['description']);
        }

        if ( !isset($_FILES['image']) ){

            if ( !isset($_POST['image']) ){

                $errordesc="Product Images required";
                $linktosolve="htps://";
                $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Product images must be sent";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);

            }else{
                $category_image = $_FILES['image'];
            }

        }else{
            $category_image = $_FILES['image'];
        }

        if(empty($name) || empty($id) || empty($description) ){
            //all input required / bad request
            $errordesc="Bad request";
            $linktosolve="htps://";
            $hint=["Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Please fill all require data input";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{

            if (is_array($category_image)){
                $image = uploadImage($category_image, "category", $endpoint, $method);
            }else{
                $image = $category_image;
            }
            // UPDATE db with id
            $sql = "UPDATE `productcategories` SET `name`=?,`description`=?,`category_image`= ?  WHERE id = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param('ssss', $name,$description, $image ,$id);
            $stmt->execute();
            $affectedRow = $stmt->affected_rows;

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
            
            if ($affectedRow > 0){
                $maindata=[];
                $errordesc = " ";
                $linktosolve = "htps://";
                $hint = [];
                $errordata = [];
                $text = "product categories Updated";
                $status = true;
                $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
                respondOK($data);

            }else{
                //return id not found respond
                $errordesc=$stmt->error;
                $linktosolve="htps://";
                $hint='id not found';
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text="Product category not found";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }

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