<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'bahar';
$connect = mysqli_connect($host, $user, $pass, $db, 3307) or die("cannot connect beacause: " . mysqli_connect_error());
?>
