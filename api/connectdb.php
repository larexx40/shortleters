<?php
date_default_timezone_set("Africa/Lagos");
//Database Connection to shortleters

$username= 'root';
$password= '';
$dbname= 'shortleters';
$connect= mysqli_connect('localhost',$username,$password,$dbname);

// $host = "localhost";
// $user = "root";
// $password = "1234";
// $dbName = "shortleters";
// $connect= mysqli_connect($host,$user,$password,$dbName);


$resetLink = "http://localhost/shortleters/pages/resetpassword.php";
$admin_resetLink = "http://localhost/shortleters/admin/resetpassword.php";
$shop_resetLink = "http://localhost/shortleters/shop/resetpassword.php";
$logistics_resetLink = "http://localhost/shortleters/logistics/resetpassword.php";
$imageurl = "http://localhost/shortleters/assets/images/"

?>