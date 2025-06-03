<?php
session_start();
$admin_user = 'admin';
$admin_pass = '123456';

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

if ($user === $admin_user && $pass === $admin_pass) {
  $_SESSION['admin'] = true;
  header("Location: admin.html");
  exit();
} else {
  echo "<script>alert('بيانات خاطئة'); window.location.href='admin-login.html';</script>";
}
?>