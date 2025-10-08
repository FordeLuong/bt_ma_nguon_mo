<?php
require 'connectdata.php';

$sql = "SELECT p.product_id ,p.name ,SUM(od.quantity) as Tongslspham
        FROM order_details od, products p
        WHERE p.product_id = od.product_id
        GROUP BY p.product_id, p.name
        ORDER BY Tongslspham DESC
        LIMIT 3;";
        

$stmt = $pdo->prepare($sql);  
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài tập 09</title>
</head>
<body>
<h2>Tìm 3 sản phẩm bán chạy nhất (theo số lượng bán ra).</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Tổng số lượng sản phẩm bán ra</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['product_id']) ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['Tongslspham'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
