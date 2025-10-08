<?php
require 'connectdata.php';

$sql = "SELECT c.category_name, p.name, p.price
        FROM products p
        JOIN categories c ON p.category_id = c.category_id
        WHERE p.price = (
        SELECT MAX(p2.price)
        FROM products p2
        WHERE p2.category_id = p.category_id
        );";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 05</title>
</head>
<body>
<h2>Tìm sản phẩm có giá cao nhất trong từng loại hàng</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Loại hàng</th>
        <th>Tên sản phảm</th>
        <th>Giá</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['category_name']) ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price']?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
