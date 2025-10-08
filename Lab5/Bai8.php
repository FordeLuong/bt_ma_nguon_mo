<?php
require 'connectdata.php';

$sql = "SELECT p.category_id, c.category_name, SUM(od.quantity) as Soluongtheoloai, SUM(od.quantity * od.price) as Tongdoanhthu
        FROM categories c, order_details od, products p
        WHERE c.category_id = p.category_id AND p.product_id = od.product_id
        GROUP BY c.category_name";

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 08</title>
</head>
<body>
<h2>Thống kê tổng số lượng và doanh thu của từng loại sản phẩm</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã Loại</th>
        <th>Tên Loại</th>
        <th>Số lượng theo loại</th>
        <th>Tổng doanh thu</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['category_id']) ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['Soluongtheoloai'] ?></td>
            <td><?= $row['Tongdoanhthu'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
