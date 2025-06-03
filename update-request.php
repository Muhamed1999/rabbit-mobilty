<?php
require 'db.php';
$id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if ($id && in_array($action, ['approve', 'reject'])) {
  $status = $action === 'approve' ? 'approved' : 'rejected';
  $stmt = $conn->prepare("UPDATE requests SET status = ? WHERE id = ?");
  $stmt->bind_param("si", $status, $id);
  $stmt->execute();
}
header("Location: admin-requests.php");
exit();
?>