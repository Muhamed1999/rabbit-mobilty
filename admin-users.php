<?php
require 'db.php';

// حذف المستخدم إذا تم الطلب
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM users WHERE id = $id");
}

// عرض المستخدمين
$users = $conn->query("SELECT id, email FROM users");
$userCount = $users->num_rows;
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إدارة المستخدمين</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="dashboard">
    <a href="admin.html">← الرجوع إلى لوحة التحكم</a>
    <h1>👥 إدارة المستخدمين</h1>
    <h2>📊 عدد المستخدمين: <?= $userCount ?></h2>

    <table>
      <tr><th>ID</th><th>البريد الإلكتروني</th><th>حذف</th></tr>
      <?php while($user = $users->fetch_assoc()): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><a href="admin-users.php?delete=<?= $user['id'] ?>" onclick="return confirm('هل أنت متأكد من الحذف؟')" style="color:red;">🗑 حذف</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
