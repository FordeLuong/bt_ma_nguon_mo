<?php
require '/../Bai1/connect.php';

try {
    $stmt = $conn->prepare("SELECT id, name, email, phone FROM students");
    $stmt->execute();

    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SDT</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
