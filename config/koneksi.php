<?php
$server1 = "127.0.0.1"; 
$username1 = "root";
$password1 = "";
$database1 = "lppm2020";
$port = "3306";

// Koneksi dan memilih database di server
// mysqli_connect(hostname: $server1, username: $username1, password: $password1, database: $database1, port: $port) or die("LOST CONNECTION CONTACT YOUR ADMINISTRATOR [IT]");
mysqli_connect($server1,$username1,$password1,$database1,$port) or die("LOST CONNECTION CONTACT YOUR ADMINISTRATOR [IT]");
$server1 = mysqli_connect($server1,$username1,$password1,$database1,$port);
// $server1 = mysqli_connect(hostname: $server1, username: $username1, password: $password1, database: $database1, port: $port);
//mysqli_select_db($server, $database1) or die("ERROR ON DATABASE SERVER");

$server2 = "127.0.0.1"; 
$username2 = "root";
$password2 = "";
$database2 = "integrasi";
$port = "3306";

// Koneksi dan memilih database di server
mysqli_connect($server2, $username2, $password2, $database2, $port) or die("LOST CONNECTION CONTACT YOUR ADMINISTRATOR [IT]");
$server2 = mysqli_connect($server2, $username2, $password2, $database2, $port);

?>