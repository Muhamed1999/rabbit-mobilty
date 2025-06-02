<?php
$host = "localhost";
$user = "root"; // على XAMPP
$pass = "";
$db   = "scooter_system";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>
