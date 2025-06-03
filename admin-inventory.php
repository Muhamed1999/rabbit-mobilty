<?php
require 'db.php';

// تحديث الكمية لو تم إرسال تعديل
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $part = $_POST['part_name'] ?? '';
  $qty = intval($_POST['quantity'] ?? 0);

  if ($part !== '') {
    $stmt = $conn->prepare("UPDATE inventory SET quantity = ? WHERE part_name = ?");
    $stmt->bind_param("is", $qty, $part);
    $stmt->execute();
  }
}

// عرض البيانات
$inventory = $conn->query("SELECT * FROM inventory ORDER BY part_name");
$inventoryCount = $inventory->num_rows;
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>إدارة المخزون</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="dashboard">
    <a href="admin.html">← الرجوع إلى لوحة التحكم</a>
    <h1>📦 إدارة المخزون</h1>
    <h2>📊 عدد القطع في المخزون: <?= $inventoryCount ?></h2>

    <table>
      <tr>
        <th>اسم القطعة</th>
        <th>الكمية</th>
        <th>تعديل</th>
      </tr>
      <?php while($item = $inventory->fetch_assoc()): ?>
        <tr>
          <form method="post">
            <td><?= htmlspecialchars($item['part_name']) ?></td>
            <td>
              <input type="number" name="quantity" value="<?= $item['quantity'] ?>" style="width:60px;">
              <input type="hidden" name="part_name" value="<?= htmlspecialchars($item['part_name']) ?>">
            </td>
            <td><button type="submit">💾 حفظ</button></td>
          </form>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
