<?php
date_default_timezone_set("Africa/Lagos");
//Database Connection to loadngdatabase
// $server= 'localhost';
// $username= 'root';
// $password= '';
// $dbname= 'cart.ng';

$username= 'root';
$password= '';
$dbname= 'cart.ng';
$connect= mysqli_connect('localhost',$username,$password,$dbname);

// $host = "localhost";
// $user = "root";
// $password = "1234";
// $dbName = "newcart";
// $connect= mysqli_connect($host,$user,$password,$dbName);


$resetLink = "http://localhost/cart.ng2/resetpassword.php";
$admin_resetLink = "http://localhost/cart.ng2/admin/resetpassword.php";
$shop_resetLink = "http://localhost/cart.ng2/shop/resetpassword.php";
$logistics_resetLink = "http://localhost/cart.ng2/logistics/resetpassword.php";



?>