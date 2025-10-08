<?php
$name = $_COOKIE['username'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    setcookie("username", $name, time() + 3600 * 24 * 7); // lưu 7 ngày
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Ghi nhớ tên</title>
</head>

<body>
    <?php if (empty($name)): ?>
        <form method="post">
            Nhập tên của bạn: <input type="text" name="name">
            <button type="submit">Lưu</button>
        </form>
    <?php else: ?>
        <p>Xin chào <?= $name ?>, rất vui gặp lại bạn!</p>
    <?php endif; ?>
</body>

</html>