<?php
require 'connectdata.php';

$sql = "SELECT p.product_id, p.name
        FROM products p
        LEFT JOIN order_details od ON p.product_id = od.product_id
        WHERE od.product_id IS NULL;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 06</title>
</head>
<body>
<h2>Liệt kê sản phẩm chưa từng được đặt hàng</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã Id</th>
        <th>Tên sản phẩm</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['product_id']) ?></td>
            <td><?= $row['name'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
