<?php
require '/../Bai1/connect.php';

$q = $_GET['q'] ?? '';   // từ khóa tìm kiếm

try {
    if ($q !== '') {
        // Tìm theo tên 
        $stmt = $conn->prepare("SELECT id, name, email, phone FROM students WHERE name LIKE :kw");
        $kw = "%" . $q . "%";
        $stmt->bindParam(':kw', $kw, PDO::PARAM_STR);
    } else {
        // Nếu không nhập gì thì lấy tất cả
        $stmt = $conn->prepare("SELECT id, name, email, phone FROM students");
    }

    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>

<h3>Tìm kiếm sinh viên</h3>
<form method="get">
    <input type="text" name="q" placeholder="Nhập tên..." value="<?= htmlspecialchars($q) ?>">
    <button type="submit">Tìm</button>
</form>

<table border="1" cellpadding="5" style="margin-top:10px;">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
    </tr>
    <?php if (count($students) > 0): ?>
        <?php foreach ($students as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Không tìm thấy sinh viên nào.</td></tr>
    <?php endif; ?>
</table>
