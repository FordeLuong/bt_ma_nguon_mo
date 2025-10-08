<?php
require '../Bai1/connect.php';
$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><a href="../Bai5/delete_student.php?id=<?= $row['id'] ?>" onclick="returnconfirm('Xóa?')">Xóa</a></td>
            <td><a href="../Bai6/edit_student.php?id=<?= $row['id'] ?>">Sửa</a></td>
        </tr>
    <?php endforeach; ?>
</table>