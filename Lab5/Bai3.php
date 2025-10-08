<?php
require 'connectdata.php';

$sql = "SELECT c.category_name, COUNT(p.product_id) AS total_products
        FROM categories c
        JOIN products p ON c.category_id = p.category_id
        GROUP BY c.category_name
        HAVING COUNT(p.product_id) > 5;";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 03</title>
</head>
<body>
<h2>Tìm loại hàng có trên 5 sản phẩm</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Loại hàng</th>
        <th>Số sản phẩm</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['category_name']) ?></td>
            <td><?= $row['total_products'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
