<?php
require 'connectdata.php';

$sql = "SELECT c.customer_id, c.name, SUM(od.quantity) AS total_items
        FROM customers c
        JOIN orders o ON c.customer_id = o.customer_id
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY c.customer_id, c.name
        ORDER BY total_items DESC
        LIMIT 1;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 07</title>
</head>
<body>
<h2>Khách hàng mua nhiều sản phẩm nhất</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã khách hàng</th>
        <th>Tên khách hàng</th>
        <th>Tổng sản phẩm</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['customer_id']) ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['total_items'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
