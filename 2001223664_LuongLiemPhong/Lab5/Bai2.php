<?php
require 'connectdata.php';

$sql = "SELECT o.order_date, SUM(od.quantity * od.price) AS total_revenue
        FROM orders o
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY o.order_date;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 02</title>
</head>
<body>
<h2>Tính tổng doanh thu từng ngày</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Ngày</th>
        <th>Doanh thu</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['order_date']) ?></td>
            <td><?= $row['total_revenue'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
