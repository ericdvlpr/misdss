<?php
//database_connection.php
$servername = 'ec2-107-22-238-186.compute-1.amazonaws.com';
$username = 'aygabyyzeffuhq';
$password = '7ca7fb3752582bea0df33ecbdccf6dfb208ed85b4c0ee490421ead59aa7ddf1b';
$connect = new PDO('mysql:host=$servername;dbname=dc9f8mgkpa0jsi', $username, $password);
session_start();
date_default_timezone_set("Asia/Manila");
?>
