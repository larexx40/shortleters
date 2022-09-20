<?php
    function validatePhone($phone) {
        $regExp = '/^[0-9]{11}+$/';


        if (preg_match($regExp, $phone)){
            return true;
        }else{
            return false;
        }
    }

    function validateEmail($email) {

        if ( filter_var($email, FILTER_VALIDATE_EMAIL) ){
            return true;
        }else{
            return false;
        }
    }

    function checkExpiry($expireAt){
        $currentTime = time();
        if($expireAt >= $currentTime){
            return true;
        }else {
            return false;
        }
    }
    //add five mins for token
    function minutesToAdd($minsToAdd){
        $mins = time() + $minsToAdd;
        return $mins;
        
    }

    function validatePassword($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {
            return false;
        }else{
            return true;
        }
    }
    
    function checkIfUsernameisEmailorPhone($username){
       $phone =  (validatePhone($username)) ? 'phone': null;
       $email = (filter_var($username, FILTER_VALIDATE_EMAIL)) ? 'email' : null;

       if ($phone){
        return $phone;
       }

       if ($email){
        return $email;
       }

    }

    // sets verify type due to user identity given
    function setVerifyType($user_identity){
        if ($user_identity == 'phone'){
            return 2;
        }

        if ($user_identity == 'email'){
            return 1;
        }
    }

    function getIPAddress() {  
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    } 
    
    function getIP(){
        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');
        return $ip;
    }

    function getLoc($userIp){
        $url = "http://ipinfo.io/".$userIp."/geo";
        $json     = file_get_contents($url);
        $json     = json_decode($json, true);
        // $country  = ($json['country']) ?  $json['country'] : "";
        // $region   = ($json['region']) ? $json['region'] : "";
        // $city     = ($json['city']) ? $json['city'] : "";
        
        if (array_key_exists('loc', $json) ){
            $location = ($json['loc']) ? $json['loc'] : "";

        }else{
            $location = "";
        }

        return $location;
    }

    function generatePubKey($strength){
        $input = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $output = generate_string($input, $strength);

        return $output;
    }

    function generateShortKey($strength){
        $input = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $output = generate_string($input, $strength);

        return $output;
    }

    function generateUniqueShortKey($connect, $tableName, $field){
        $loop = 0;
        while ($loop == 0){
            $userKey = "SHL".generateShortKey(5);
            if ( checkIfCodeisInDB($connect, $tableName, $field ,$userKey) ){
                $loop = 0;
            }else {
                $loop = 1;
                break;
            }
        }

        return $userKey;
    }

    function generateUniqueKey($connect, $tableName, $strength, $field){
        $loop = 0;
        while ($loop == 0){
            $userKey = "CNG-PDT".generateShortKey($strength);
            if ( checkIfCodeisInDB($connect, $tableName, $field ,$userKey) ){
                $loop = 0;
            }else {
                $loop = 1;
                break;
            }
        }

        return $userKey;
    }

    function generateUserPubKey($connect, $tableName){
        //add role to your generate function
        //if user (checkIfPubKeyisInDB), return $userkey
        //else if admin (checkIfIsAdmin), return $adminkey
        //else (checkIfPubKeyisInDB), so we wont edit all api
        $loop = 0;
        while ($loop == 0){
            $userKey = "CNG".generatePubKey(37). $tableName;
            if ( checkIfPubKeyisInDB($connect, $tableName, $userKey) ){
                $loop = 0;
            }else {
                $loop = 1;
                break;
            }
        }

        return $userKey;
    }

    

    function checkIfPubKeyisInDB($connect, $tableName, $pubkey) {
        // Check if the email or phone number is already in the database
        $query = "SELECT * FROM $tableName WHERE userpubkey = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $pubkey);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            return true;
        }

        return false;
    }

    function checkIfCodeisInDB($connect, $tableName, $field ,$pubkey) {
        // Check if the email or phone number is already in the database
        $query = "SELECT * FROM $tableName WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $pubkey);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            return true;
        }

        return false;
        
    }

    function checkIfUserisInDB($connect, $user_id) {
        // Check if the email or phone number is already in the database
        $query = 'SELECT * FROM users WHERE id = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            
            return true;
        }

        return false;
    }

    function getUserWithPubKey($connect, $userpubkey) {
        // Check if the email or phone number is already in the database
        $query = 'SELECT * FROM users WHERE userpubkey = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $userpubkey);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row =  mysqli_fetch_assoc($result);
            $user_id = $row['id'];
            return $user_id;
        }

        return false;
    }

    function getTableEmail($connect, $table ,$userpubkey) {
        // Check if the email or phone number is already in the database
        $query = "SELECT * FROM $table WHERE userpubkey = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $userpubkey);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row =  mysqli_fetch_assoc($result);
            $email = $row['email'];
            return $email;
        }

        return false;
    }

    function getLogisticsWithPubKey($connect, $userpubkey) {
        // Check if the email or phone number is already in the database
        $query = 'SELECT * FROM logistics WHERE userpubkey = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $userpubkey);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row =  mysqli_fetch_assoc($result);
            $user_id = $row['id'];
            return $user_id;
        }

        return false;
    }

    function checkIfLogisticOrShopIsUnique($connect, $table, $name, $email, $username){
        // check email
        $query = "SELECT * FROM $table WHERE shop_email = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $email );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $error = "Email already exist";
            return $error ;
        }

        // check name
        $query = "SELECT * FROM $table WHERE name = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $name );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           $error = "Already exist";
           return $error ;
        }
        
        // check username
        $query = "SELECT * FROM $table WHERE username = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s",  $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           $error = "Username already exist";
           return $error ;
        }

        return false;

    }

    function checkifFieldisUnique($connect, $table, $field, $phone){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $phone );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           $error = $field. " already exist";
           return $error ;
        }
    }

    function checkifFieldExist($connect, $table, $field, $data){
        // check field
        $Checkquery = "SELECT * FROM `$table` WHERE `$field` = ?";
        $Checkstmt = $connect->prepare($Checkquery);

        $Checkstmt->bind_param("s", $data );
        $Checkstmt->execute();
        $result = $Checkstmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           return $num_row;
        }

        return false;
    }

    function getNameFromField($connect, $table, $field, $data){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            $name = $row['name'];
            return $name;
        }

        return false;
    }

    

    function getEmailFromField($connect, $table, $field, $data){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            $email = $row['email'];
            return $email;
        }

        return false;
    }

    function addSessionLog($conn, $email, $activity ,$sessioncode, $ipaddress, $browser, $date, $location, $user_type, $method, $endpoint) {
        // set status to 1
        $status = 1;
        // Insert seesion log query
        $query = 'INSERT INTO usersessionlog (email, activity ,sessioncode, ipaddress, browser, date , status, location, user_type) Values (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $email, $activity ,$sessioncode, $ipaddress, $browser, $date, $status, $location, $user_type);

        if( $stmt->execute() ){
            return true;
        }

        $errordesc =  $stmt->error;
        $linktosolve = 'https://';
        $hint = "500 code internal error, check ur database connections";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondInternalError($data);
    }

    function registerAUser($conn, $email, $firstname, $lastname, $phone, $password, $username , $refferedBy , $endpoint, $method, $tableName){
        // generate password hash and user public key

        $hashpass = Password_encrypt($password);
        $userPubKey = generateUserPubKey($conn, $tableName);
        $referCode = generateUniqueShortKey($conn, $tableName, "refcode");

        // get id of the refferedBy
        $query = 'SELECT * FROM `users` WHERE `refcode` = ?';
        $Referstmt = $conn->prepare($query);
        $Referstmt->bind_param("s", $refferedBy);
        $Referstmt->execute();
        $result = $Referstmt->get_result();
        $num_row = $result->num_rows;
        if ($num_row > 0){
            $row =  mysqli_fetch_assoc($result);
            $refferral_id = $row['id'];
        }else{
            $refferral_id = "";
        }
        

        // Get company private key
        $query = 'SELECT * FROM apidatatable';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $row =  mysqli_fetch_assoc($result);
        $companykey = $row['privatekey'];
        $servername = $row['servername'];
        $expiresIn = $row['tokenexpiremin'];

        // insert user into the database
        $query = 'INSERT INTO users (email, fname, lname, phoneno, userpubkey ,password, refcode, referby, username) Values (?, ?, ?, ?, ?, ?, ?, ?, ?);';
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $email, $firstname, $lastname, $phone, $userPubKey ,$hashpass, $referCode, $refferral_id, $username);
                
        if( $stmt->execute() ){
            $token = getTokenToSendAPI($userPubKey, $companykey, $expiresIn, $servername);
            
            $auth = array(
                'token' => $token,
                'token_type' => 'Bearer'
            );

            return $auth;
        }


        $errordesc =  $stmt->error;
        $linktosolve = 'https://';
        $hint = "500 code internal error, check ur database connections";
        $errorData = returnError7003($errordesc, $linktosolve, $hint);
        $data = returnErrorArray($errordesc, $method, $endpoint, $errorData, null);
        respondInternalError($data);


    }

    function validateOrderRefno($connect, $orderRefno){
        // Check if the orderrefno is already in the database
        $query = 'SELECT * FROM productcart WHERE orderref_number = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $orderRefno);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            return true;
        }

        return false;
    }

    function generateOrderrefno($connect){
        $input = "1234756789098765421789512357";
        $strength= 17;
        $refno = generate_string($input, $strength);

        //check if refno is in database
        $loop = 0;
        while ($loop == 0){
            if ( validateOrderRefno($connect, $refno) ){
                $loop = 0;
            }else {
                $loop = 1;
                break;
            }
        }
        return $refno;
    }

    function getUserFullname($connect, $userid){
        $query = "SELECT  `email`, `fname`, `lname` FROM `users` WHERE `id` = ?";
        $getUser = $connect->prepare($query);
        $getUser->bind_param("s", $userid);
        $getUser->execute();
        $result = $getUser->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();

            $fullname = $row['fname']. " ". $row['lname'];
        }
        else{
            $fullname = "";
        }

        return $fullname;

    }

    function getShopname($connect, $userid){
        $query = "SELECT * FROM `shops` WHERE `id` = ?";
        $getUser = $connect->prepare($query);
        $getUser->bind_param("s", $userid);
        $getUser->execute();
        $result = $getUser->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();

            $shopname = $row['name'];
        }

        return $shopname;

    }

    function generateCart($connect,$userpubkey,$logisticid,$deliveryAddressid,$deliveryCharge,$shipType,$totalWeight){
        $orderStatusid = 6; //pending
        $orderRefno = generateOrderrefno($connect);
        $paid = 0; //default 
        $sqlQuery = "INSERT INTO productcart(user_id, orderstatus_id, orderref_number, logisticid, deliveryaddress_id, delivery_charge, ship_type, paid, totalweightlbs) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("sssssssss", $userpubkey,$orderStatusid,$orderRefno,$logisticid,$deliveryAddressid,$deliveryCharge, $shipType, $paid, $totalWeight);
        $insertCart = $stmt->execute();
        if ($insertCart) {
            return $orderRefno;
        }
    }

    function checkIfUser ($connect, $userPubKey){
        $sqlQuery = 'SELECT * FROM users where userpubkey = ?';
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $userPubKey);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){  
            $row = $result->fetch_assoc();
            $id =$row['id'];
            return $id;
        }
        return false;
    }

    function checkIfIsAdmin($connect, $pubkey){
        $adminQuery = 'SELECT * FROM admin where userpubkey = ?';
        $adminStmt = $connect->prepare($adminQuery);
        $adminStmt->bind_param("s", $pubkey);
        $adminStmt->execute();
        $result = $adminStmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();

            $adminId = $row['id'];
            return $adminId;
        }
        return false;
    }

    function checkIfShopOwner ($connect, $userPubKey){
        $sqlQuery = 'SELECT * FROM shops where userpubkey = ?';
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $userPubKey);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){  
            $row = $result->fetch_assoc();
            $id =$row['id'];
            return $id;
        }
        return false;
    }

    function checkIfLogistic ($connect, $userPubKey){
        $sqlQuery = 'SELECT * FROM logistics where userpubkey = ?';
        $stmt = $connect->prepare($sqlQuery);
        $stmt->bind_param("s", $userPubKey);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){  
            $row = $result->fetch_assoc();
            $id =$row['id'];
            return $id;
        }
        return false;
    }

    function getActiveProduct($connect, $id){
        // check field
        $active = 1;
        $query = "SELECT * FROM products WHERE (id = ? OR productid =?) AND status = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sss", $id, $id, $active );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           $row = $result->fetch_assoc();
           return $row;
        }

        return false;
    }

    function getUserBalance($connect, $userid){
        // check field
        $active = 1;
        $query = "SELECT * FROM users WHERE id = ? AND status = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $userid, $active );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            $balance =$row['bal'];
            return $balance;
        }

        return false;
    }

    function getLogisticPrice($connect, $logisticid, $locationid){
        // check field
        $active = 1;
        $query = "SELECT * FROM logistics_prices WHERE location_id = ? AND logistic_id AND status = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sss", $locationid, $logisticid, $active );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            return $row;
        }

        return false;
    }
    
    function getShopWithPubKey($connect, $userpubkey) {
        // Check if the email or phone number is already in the database
        $query = 'SELECT * FROM shops WHERE userpubkey = ?';
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $userpubkey);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row =  mysqli_fetch_assoc($result);
            $shop_id = $row['id'];
            return $shop_id;
        }

        return false;
    }

    function checkIfIsSuperAdmin($connect, $pubkey){
        $adminQuery = 'SELECT * FROM admin where userpubkey = ? AND superadmin = 1';
        $adminStmt = $connect->prepare($adminQuery);
        $adminStmt->bind_param("s", $pubkey);
        $adminStmt->execute();
        $result = $adminStmt->get_result();
        $num_row = $result->num_rows;
        if ($num_row > 0){   
            $row = $result->fetch_assoc();
            $id =$row['id'];
            return $id;
        }
        return false;
    }

    function checkIfExist($connect, $table, $field, $data){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           return true;
        }

        return false;
    }

    function getProductImage($connect, $table, $field, $data){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $all_images = [];
            while ($row = $result->fetch_assoc()){
                $image = $row['name'];
                array_push($all_images, array('image' => $image));
            }
           return $all_images;
        }

        return false;
    }

    function getCategoryImage($connect, $field ,$data){
        // check field
        $query = "SELECT * FROM productcategories WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            while ($row = $result->fetch_assoc()){
                $image = $row['category_image'];
            }
           return $image;
        }

        return false;
    }

    function getSubcategory($connect, $data){
        // check field
        $query = "SELECT * FROM productsub_cat WHERE cat_id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $value = [];
            while ($row = $result->fetch_assoc()){
                $id = $row['id'];
                $name = $row['name'];
                $image = ($row['image'])? $row['image']: null;
                $no_of_products = ( checkifFieldExist($connect, "products", "subcat_id", $id) ) ? checkifFieldExist($connect, "products", "subcat_id", $id) : 0;
                array_push($value, array('id' => $id, 'sub_category' => $name, 'image' => $image ,'no_of_products' => $no_of_products));
            }
           return $value;
        }

        return false;
    }

    function getFieldsDetails($connect, $table, $field, $data){
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $value = [];
            while ($row = $result->fetch_assoc()){
                $value = array('details' => $row);
            }
           return $value;
        }

        return false;
    }


    function getProductDetails($connect, $table , $field ,$data){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $value = [];
            while ($row = $result->fetch_assoc()){
                $name = $row['name'];
                $cat = $row['category_id'];
                $sub_cat = $row['subcat_id'];
                $cat_name = ($cat)? getNameFromField($connect, "productcategories", "id", $cat) : null;
                $sub_cat_name = ($sub_cat)? getNameFromField($connect, "productsub_cat", "id", $sub_cat) : null;
                $price = $row['sellingprice'];
                $type = $row['type'];
                $discount_price = $row['discountprice'];
                $special_price = $row['special_price'];

                 $value = array('name' => $name, 
                'sub_category_id' => $sub_cat, 'category' => $cat, 'price' => $price, 'type' => $type,
                'cat_name' => $cat_name, 'sub_cat_name' => $sub_cat_name, 'discount_price' =>$discount_price , 'special_price' => $special_price);
            }
           return $value;
        }

        return false;
    }

    function getAllProductDetails($connect, $table , $field ,$data){
        // check field
        $query = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $value = [];
            while ($row = $result->fetch_assoc()){
                $name = $row['name'];
                $id = $row['productid'];
                $cat = $row['category_id'];
                $sub_cat = $row['subcat_id'];
                $cat_name = ($cat)? getNameFromField($connect, "productcategories", "id", $cat) : null;
                $sub_cat_name = ($sub_cat)? getNameFromField($connect, "productsub_cat", "id", $sub_cat) : null;
                $price = $row['sellingprice'];
                $type = $row['type'];
                $discount_price = $row['discountprice'];
                $special_price = $row['special_price'];
                $images = getProductImage($connect, "product_images", "product_id", $id);
                $image = ($images) ? $images[0]['image'] : null;

                array_push($value, array('id' => $id, 'name' => $name, 
                'sub_category_id' => $sub_cat, 'category' => $cat, 'price' => $price, 'type' => $type,
                'cat_name' => $cat_name, 'sub_cat_name' => $sub_cat_name, 
                'discount_price' =>$discount_price , 'special_price' => $special_price, 'image' => $image));
            }
           return $value;
        }

        return false;
    }

    function uploadImage($file, $path, $endpoint, $method){
        $img_name = $file['name'];
        $img_size = $file['size'];
        $tmp_name = $file['tmp_name'];
        $error = $file['error'];


        if ($error === 0){
            if ($img_size > 2097152) {
                $errordesc= "Image is too large";
                $linktosolve="htps://";
                $hint=["Ensure to use the method stated in the documentation."];
                $errordata=returnError7003($errordesc,$linktosolve,$hint);
                $text= "Image is too large";
                $method=getenv('REQUEST_METHOD');
                $data=returnErrorArray($text,$method,$endpoint,$errordata);
                respondBadRequest($data);
            }else{
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png", "webp");

               
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $path = "../../assets/images/$path/";
                    $new_img_name = uniqid("CNG-IMG-", true). "." . $img_ex_lc;
                    $img_upload_path =  $path. $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                   
                    return $new_img_name;
                }else{
            
                    $errordesc= "Image type not allowed";
                    $linktosolve="htps://";
                    $hint=["Ensure to use the method stated in the documentation."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text= "Image type not allowed";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }
            }
        }else{

            $errordesc= "Unknown error occurred";
            $linktosolve="htps://";
            $hint=["Ensure to use the method stated in the documentation."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text= "Unknown error occurred";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);

        }
    }

    function waterMarkImage($image, $image_type, $waterImagePath,$endpoint, $method){
        $waterImage = imagecreatefrompng($waterImagePath);
        switch($image_type){
            case 'jpg':
                $img = imagecreatefromjpeg($image);
                break;
            case 'jpeg':
                $img = imagecreatefromjpeg($image);
                break;
            case 'png':
                $img = imagecreatefrompng($image);
                break;
            case 'webp':
                $img = imagecreatefromwebp($image);
                break;
            default:
                $img = imagecreatefromjpeg($image);
            
        }

        $marin_right = 10;
        $margin_bottom = 10;

        $sx = imagesx($waterImage);
        $sy = imagesy($waterImage);

        imagecopy($img, $waterImage, imagesx($img) - $sx - $marin_right, imagesy($img) - $sy - $margin_bottom, 0, 0, imagesx($waterImage ), imagesy($waterImage
        ) );


        imagepng($img, $image);
        imagedestroy($img);

        if ( file_exists($image) ){
            return true;
        }else{
            $errordesc= "Image upload failed, please try again.";
            $linktosolve="htps://";
            $hint=["Ensure to use the method stated in the documentation."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text= "Image upload failed, please try again.";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondBadRequest($data);
        }


    }

    function countActiveLocations($connect, $id){
        // check field
        //SELECT * FROM `logistic_locations` WHERE `logistic_id` = 1 AND `status` = 1
        $countLocation = "SELECT id FROM `logistic_locations` WHERE `logistic_id` = ? AND `status` = 1";
        $countStmt = $connect->prepare($countLocation);
        $countStmt->bind_param("s",$id);
        $countStmt->execute();  
        $result = $countStmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           return $num_row;
        }

        return false;
    }

    function countRow($connect, $table, $field){
        // check field
        $query = "SELECT $field FROM $table";
        $countRow = $connect->prepare($query);
        $countRow->execute();
        $result = $countRow->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           return $num_row;
        }

        return false;
    }
    function countRowWithParam($connect, $table, $field, $data){
        // check field
        // $query = "SELECT id FROM `sub_building_types` WHERE `build_type_id` = ?";
        $query = "SELECT id FROM $table WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           return $num_row;
        }

        return "0";
    }

    function resizeImage($fileName,$new_width, $new_height, $directory){
        list($width,$height,$type) = getimagesize($fileName);
        // $new_height = round($height*$new_width/$width);
        $old_image = imagecreatetruecolor($new_width,$new_height);
        switch($type){
            case IMAGETYPE_JPEG:
                $new_image = imagecreatefromjpeg($fileName);
                break;
            case IMAGETYPE_GIF:
                $new_image = imagecreatefromgif($fileName);
                break;
            case IMAGETYPE_PNG:
                imagealphablending($old_image, true);
                imagesavealpha($old_image, false);
                $new_image = imagecreatefrompng($fileName);
                break;
        }
        switch($type){
            case IMAGETYPE_JPEG:
                imagecopyresampled($old_image,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
                imagejpeg($old_image,$directory);
                break;
            case IMAGETYPE_GIF:
                $bgcolor = imagecolorallocatealpha($new_image,0,0,0,127);
                imagefill($old_image, 0, 0, $bgcolor);
                imagecolortransparent($old_image,$bgcolor);
                imagecopyresampled($old_image,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
                imagegif($old_image,$directory);
                break;
            case IMAGETYPE_PNG:
                $whitecolor =imagecolorallocate($new_image, 255, 255, 255);
                imagefill($old_image, 0, 0, $whitecolor);
                imagecopyresampled($old_image,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
                imagejpeg($old_image,$directory);
                break;
        }
        imagedestroy($old_image);
        imagedestroy($new_image);
   }

   function getSliderImage($connect, $product_id){
        // check field
        $image = 1;
        $query = "SELECT name FROM product_images WHERE product_id = ? AND slider_image = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $product_id, $image);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            return $row['name'];
        }

        return false;
    }

    function getCategory($connect, $data){
        // check field
        $query = "SELECT * FROM productcategories WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $name = $row['name'];
            $image=$row['category_image'];
            $description = $row['description'];
            
           $value= (object)array('id' => $id, 'category_name' => $name, "category_image"=>$image, "description"=>$description);
           return $value;
        }

        return false;
    }

    function getproduct($connect, $data){
        //`productid`,`name`,`status`,`sellingprice`,`brand_id`,`status`
        $active = 1;
        $query = "SELECT `productid`,`name`,`status`,`sellingprice`,`brand_id`, `type`, `category_id` ,`special_price`,`status` FROM products WHERE productid = ? AND status = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $data, $active );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            $productid = $row['productid'];
            $productName = $row['name'];
            $sellingPrice=$row['sellingprice'];
            $type = $row['type'];
            $cat_id = $row['category_id'];
            $category_name = ( $cat_id)? getNameFromField($connect, "productcategories", "id", $cat_id): null;
            $special_price = $row['special_price'];
            $images = getProductImage($connect, "product_images", "product_id", $data);
            $productImage = ($images)? $images[0]['image']: null;
            $value= (object)array('productid' => $productid, 'productName' => $productName, 
            "sellingPrice"=>$sellingPrice, "productImage"=>$productImage, "type" => $type, 
            "special_price" => $special_price, "cat_id" => $cat_id, "cat_name" => $category_name);
           return $value;
        }

        return false;
    }

    function getAverageProductReview($connect, $product_id){
        $query = "SELECT `ratestar` FROM `productreview` WHERE `productid` = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $sum = 0;
            while($row = $result->fetch_assoc()){
                $sum += $row['ratestar'];
            }
            $average = intdiv($sum, $num_row);

            return array('num_of_reviews' => $num_row, "aver_review" => $average);

        }

        return false;
    }

    function getReviews($connect, $product_id){
        // check field
        $query = "SELECT productreview.userid, users.fname, users.lname, `productid`, `review`, `ratestar`, productreview.created_at 
                FROM `productreview` LEFT JOIN users ON users.id = productreview.userid WHERE productreview.productid = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $product_id );
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $reviews = [];
            while ($row = $result->fetch_assoc()){
                $user = $row['fname']." ". $row['lname'];
                $rateStar= $row['ratestar'];
                $review = $row['review'];
                array_push($reviews, array('user' => $user, 'rateStar' => $rateStar, 'review' => $review));
            }
           return $reviews;
        }

        return false;
    }

    function getBrandImage($connect, $brand_id){
        $query = "SELECT `brand_image` FROM `productbrand` WHERE `id` = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $brand_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $row = $result->fetch_assoc();
            return $row['brand_image'];
        }

        return false;
    }

    function getRelatedProducts($connect, $field, $data){
        $query = "SELECT `name`, `productid`, `type`, `sellingprice`, `special_price`, `category_id` FROM `products` WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
            $all_products = [];
            while($row = $result->fetch_assoc()){
                $image = getProductImage($connect, "product_images" , "product_id", $row['productid']);
                $type = $row['type'];
                $price = $row['sellingprice'];
                $special_price = $row['special_price'];
                $category = $row['category_id'];
                array_push($all_products, array('product_id' => $row['productid'], 
                'product_image' => $image[0]['image'],
                'name' => $row['name'],
                'price' => $price,
                'type' => $type,
                'category' => $category,
                'category_name' => (getNameFromField($connect, "productcategories", "id", $category))? getNameFromField($connect, "productcategories", "id", $category): null,
                'special_price' => $special_price
            ));
            }
            return $all_products;
        }

        return false;
    }
   
   

//    function removeImageBg($_filename){
//     $img = imagecreatefromstring($_filename); //or whatever loading function you need
//     $white = imagecolorallocate($img, 255, 255, 255);
//     imagecolortransparent($img, $white);
//     imagepng($img, $_filename);
//    }
   function remove_image_background($image, $bgcolor, $fuzz){
            echo "Removing Background";
            $image = shell_exec('convert '.$image.' -fuzz '.$fuzz.'% -transparent "rgb('.$bgcolor['red'].','.$bgcolor['green'].','.$bgcolor['blue'].')" '.$image.'');
            echo $image;
            return $image;
    }

    function unique_multi_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }

    function getTransaction($connect, $field, $data){
        // check field
        $active = 1;
        $query = "SELECT * FROM user_transactions WHERE $field = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;

        if ($num_row > 0){
           $row = $result->fetch_assoc();
           return $row;
        }

        return false;
    }
?>