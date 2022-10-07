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
    $endpoint = "/api/user/".basename($_SERVER['PHP_SELF']);

    if ($method == 'POST') {

        if (!isset($_FILES['image'])){
            $errordesc="kindly pass image";
            $linktosolve="htps://";
            $hint=["Ensure to use the method stated in the documentation."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="kindly pass image";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }else{
            // echo json_encode($_FILES['image']);
            $file = $_FILES['image'];
            $path = "test";

            $response = uploadImage($file, $path, $endpoint, $method);


            if ( $response ){
                $split = explode(".", $response);
                $length = count($split);
                $type = $split[$length - 1];
                $imagePath = "../../assets/images/" ."$path/". $response;

                $watermark_image = "../../assets/images/watermarks/Shortleters on White Cloth.png";
                $watermarkedImage = waterMarkImage($imagePath, $type, $watermark_image, $endpoint, $method);

                if ($watermarkedImage){
                    $text= "Image Uploaded";
                    $status = true;
                    $data = [$imagePath];
                    $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
                    respondOK($successData);
                }
                

                
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