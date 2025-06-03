<?php
require 'db.php';

// جلب المستخدمين
$users = $conn->query("SELECT email FROM users");

// جلب الطلبات
$requests = $conn->query("SELECT * FROM requests ORDER BY created_at DESC");

// جلب المخزون
$inventory = $conn->query("SELECT * FROM inventory");

?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>لوحة تحكم الإدارة</title>
  <style>
    body { font-family: Arial; padding: 30px; background: #f8f8f8; direction: rtl; }
    h1 { color: #28a745; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: right; }
    th { background: #28a745; color: white; }
  </style>
</head>
<body>

  <h1>👨‍💼 لوحة تحكم الإدارة</h1>

  <h2>📧 المستخدمون</h2>
  <table>
    <tr><th>البريد الإلكتروني</th></tr>
    <?php while($user = $users->fetch_assoc()): ?>
      <tr><td><?= htmlspecialchars($user['email']) ?></td></tr>
    <?php endwhile; ?>
  </table>

  <h2>📋 الطلبات</h2>
  <table>
    <tr>
      <th>البريد</th><th>الأسكوتر</th><th>القطعة</th><th>ملاحظة</th><th>الحالة</th><th>تاريخ الإرسال</th>
    </tr>
    <?php while($req = $requests->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($req['user_email']) ?></td>
        <td><?= htmlspecialchars($req['scooter_name']) ?></td>
        <td><?= htmlspecialchars($req['part_name']) ?></td>
        <td><?= htmlspecialchars($req['note']) ?></td>
        <td><?= $req['status'] ?></td>
        <td><?= $req['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h2>📦 المخزون</h2>
  <table>
    <tr><th>اسم القطعة</th><th>الكمية</th></tr>
    <?php while($item = $inventory->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($item['part_name']) ?></td>
        <td><?= $item['quantity'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>
</html>
