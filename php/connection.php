<?php
$servername =getenv("localhost");
$username =getenv("root");
$password =getenv("");
$db_name =getenv("acenfi");

$conn = new mysqli($servername, $username, $password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo " ";
?>