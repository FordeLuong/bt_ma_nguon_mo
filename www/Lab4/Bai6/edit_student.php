<?php
require '../Bai1/connect.php';
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, birthday=?
WHERE id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['birthday'],
        $_POST['id']
    ]);
    header("Location: ../Bai3/list_students.php");
    exit;
}
?>
<form method="post">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">
    <label>Họ tên:</label> <input type="text" name="name" value="<?=
        $student['name'] ?>"><br>
    <label>Email:</label> <input type="email" name="email" value="<?=
        $student['email'] ?>"><br>
    <label>SĐT:</label> <input type="text" name="phone" value="<?=
        $student['phone'] ?>"><br>
    <label>Birthday</label> <input type="date" name="birthday" value="<?=
        $student['birthday'] ?>"><br>
    <button type="submit">Cập nhật</button>
</form>