<?php
/* Database connection start */
$servername = "172.17.0.2";
$username = "root";
$password = "101281";
$dbname = "supermarket";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$acentos = $conn->query("SET NAMES 'utf8'");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
