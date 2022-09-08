<?php

$db_name = "mysql:host=localhost;dbname=shop_db";
$username = "root";
$password = "";

$conn = new PDO($db_name, $username, $password);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("SET CHARACTER SET utf8"); // <--utf8

?>