<?php
require 'connectdata.php';

$sql = "SELECT c.category_id, c.category_name, SUM(od.quantity * od.price) AS total_revenue
        FROM categories c
        JOIN products p ON c.category_id = p.category_id
        JOIN order_details od ON p.product_id = od.product_id
        GROUP BY c.category_id, c.category_name
        ORDER BY total_revenue DESC
        LIMIT 1;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 11</title>
</head>
<body>
<h2>Tìm loại hàng có doanh thu cao nhất</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã loại</th>
        <th>Tên loại</th>
        <th>Tổng doanh thu</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['category_id']) ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['total_revenue'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
