<?php
require '/../Bai1/connect.php';

// Lấy tham số sort từ query string (?sort=name hoặc ?sort=email)
$allowed = ['name', 'email'];
$sort = $_GET['sort'] ?? 'id'; // mặc định theo id
if (!in_array($sort, $allowed) && $sort !== 'id') {
    $sort = 'id';
}

try {
    $sql = "SELECT id, name, email, phone FROM students ORDER BY $sort ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}
?>

<h3>Danh sách sinh viên</h3>
<form method="get">
    <label>Sắp xếp theo:</label>
    <select name="sort" onchange="this.form.submit()">
        <option value="id" <?= $sort === 'id' ? 'selected' : '' ?>>ID</option>
        <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Họ tên</option>
        <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>Email</option>
    </select>
</form>

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
