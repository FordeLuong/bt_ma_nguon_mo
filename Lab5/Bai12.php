<?php
require 'connectdata.php';

$sql = "SELECT p.product_id, p.name, COUNT(od.order_id) AS order_count
        FROM products p
        LEFT JOIN order_details od ON p.product_id = od.product_id
        GROUP BY p.product_id, p.name;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 12</title>
</head>
<body>
<h2>Liệt kê tất cả sản phẩm và số lần được đặt hàng (nếu chưa đặt thì là 0)</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Số lần được đặt</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['product_id']) ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['order_count'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
