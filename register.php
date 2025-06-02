<?php
require 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// تشفير كلمة المرور
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $hashedPassword);

if ($stmt->execute()) {
    echo "<script>alert('تم التسجيل بنجاح'); window.location.href = 'login.html';</script>";
} else {
    echo "<script>alert('حدث خطأ أو البريد مستخدم من قبل'); window.history.back();</script>";
}
?>
