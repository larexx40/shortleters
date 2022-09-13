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

    // check if the right request was sent
    if ($method == 'POST') {

        // check if the logistics id field was passed 
        if ( !isset($_POST['logistics_id'] ) ) {
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required logistics id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }else{
            $logistics_id = cleanme($_POST['logistics_id']);
        }

        // check if the location id field was passed 
        if ( !isset($_POST['location_id'] ) ) {
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required location id field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }else{
            $location_id = cleanme($_POST['location_id']);
        }

        // check if the weight field was passed 
        if ( !isset($_POST['weight'] ) ) {
            $errordesc = "All fields must be passed";
            $linktosolve = 'https://';
            $hint = "Kindly pass the required shipment weight field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);

        }else{
            $weight = cleanme($_POST['weight']);
        }

        if (!is_numeric($weight)){
            // send a response to show that the weight has to be an integer or float
            $errordesc = "Invalid weight";
            $linktosolve = 'https://';
            $hint = "Kindly pass a valid intrger or flaot fo the weight field in this register endpoint";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
        }

        // get price for the logistics firm in the passed location details
        $Checkquery = 'SELECT * FROM logistics_prices where location_id = ? AND logistic_id = ?';
        $stmt = $connect->prepare($Checkquery);
        $stmt->bind_param("ss", $location_id, $logistics_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = mysqli_fetch_assoc($result);

            $min_weight = $row['lbsweightmin'];
            $max_weight = $row['lbsweightmax'];


            // send error if weight is lower than minimum weight
            if ( $weight < $min_weight && $weight <= $max_weight){
                $errordesc = "Shipment is below minimum weight, Kindly check other locations or logistics firm";
                $linktosolve = 'https://';
                $hint = "Shipment is below minimum weight, Kindly check other locations or logistics firm";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            // send error if weight is larger than maximum weight
            if ($weight > $max_weight){
                $errordesc = "Shipment is above maximum weight, Kindly check other locations or logistics firm";
                $linktosolve = 'https://';
                $hint = "Shipment is above maximum weight, Kindly check other locations or logistics firm";
                $errorData = returnError7003($errordesc, $linktosolve, $hint);
                $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
                respondBadRequest($data);
            }

            // proceed to sending the price since all conditions was met
            $text= "Price Fetched";
            $status = true;
            $data = array(
                'price' => $row['price']
            );
            $successData = returnSuccessArray($text, $method, $endpoint, [], $data, $status);
            respondOK($successData);

        }else{
            $errordesc = "Location Price Not Available";
            $linktosolve = 'https://';
            $hint = "Kindly check the DB if the location price is available";
            $errorData = returnError7003($errordesc, $linktosolve, $hint);
            $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, []);
            respondBadRequest($data);
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