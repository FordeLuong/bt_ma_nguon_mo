<?php
require 'connectdata.php';

$sql = "SELECT c.customer_id, c.name, SUM(od.quantity * od.price) AS total_spent
        FROM customers c
        JOIN orders o ON c.customer_id = o.customer_id
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY c.customer_id, c.name
        ORDER BY total_spent DESC
        LIMIT 5;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 10</title>
</head>
<body>
<h2>Liệt kê 5 khách hàng chi tiêu nhiều nhất</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã KH</th>
        <th>Tên KH</th>
        <th>Tổng chi tiêu</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['customer_id']) ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['total_spent'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
