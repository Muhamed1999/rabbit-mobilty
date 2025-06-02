<?php
// لا تضع أي مسافات أو أسطر قبل <?php

// بيانات دخول افتراضية
$correct_email = "admin@example.com";
$correct_password = "123456";

// استلام البيانات من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === $correct_email && $password === $correct_password) {
        // التوجيه إلى الصفحة الأخرى
        header("Location: youser.html");
        exit();
    } else {
        // بيانات خاطئة، أرجع المستخدم لصفحة تسجيل الدخول
        echo "<script>
                alert('بيانات غير صحيحة، حاول مرة أخرى');
                window.location.href = 'login.html';
              </script>";
        exit();
    }
} else {
    // لو حد دخل على login.php مباشرة بدون POST
    header("Location: login.html");
    exit();
}
