<?php
require 'connectdata.php';

$sql = "SELECT c.customer_id, c.name, SUM(od.quantity * od.price) AS total_spent
        FROM customers c
        JOIN orders o ON c.customer_id = o.customer_id
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY c.customer_id, c.name
        HAVING total_spent > 1000000;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 04</title>
</head>
<body>
<h2>Danh sách khách hàng và tổng tiền đã mua</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã khách hàng</th>
        <th>Họ và tên</th>
        <th>Tổng tiền đã tiêu</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['customer_id']) ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['total_spent']?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
