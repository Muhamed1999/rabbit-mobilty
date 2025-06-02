<?php
require 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// تحضير الاستعلام
$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashed);
    $stmt->fetch();

    if (password_verify($password, $hashed)) {
        // ✅ تسجيل دخول ناجح
        header("Location: youser.html");
        exit();
    }
}

// ❌ فشل تسجيل الدخول
echo "<script>alert('البريد الإلكتروني أو كلمة المرور غير صحيحة'); window.location.href = 'login.html';</script>";
