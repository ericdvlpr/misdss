<?php
//database_connection.php

$connect = new PDO('mysql:host=localhost;dbname=db_misdss', 'root', '123456');
session_start();
date_default_timezone_set("Asia/Manila");
?>