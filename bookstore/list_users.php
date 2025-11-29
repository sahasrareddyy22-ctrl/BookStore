<?php
require 'dbconfig.php';
$stmt = $pdo->query('SELECT id, name, email, phone, sex, dob, languages, address, created_at FROM users ORDER BY created_at DESC');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Registered Users</title></head>
<body>
  <h2>Registered Users</h2>
  <table border="1" cellpadding="6" cellspacing="0">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Sex</th><th>DOB</th><th>Lang</th><th>Address</th><th>Created</th></tr></thead>
    <tbody>
      <?php foreach($rows as $r): ?>
        <tr>
          <td><?=htmlspecialchars($r['id'])?></td>
          <td><?=htmlspecialchars($r['name'])?></td>
          <td><?=htmlspecialchars($r['email'])?></td>
          <td><?=htmlspecialchars($r['phone'])?></td>
          <td><?=htmlspecialchars($r['sex'])?></td>
          <td><?=htmlspecialchars($r['dob'])?></td>
          <td><?=htmlspecialchars($r['languages'])?></td>
          <td><?=htmlspecialchars($r['address'])?></td>
          <td><?=htmlspecialchars($r['created_at'])?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
