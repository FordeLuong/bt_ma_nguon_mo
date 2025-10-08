<?php
$file = "note.txt";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';
    file_put_contents($file, $content . PHP_EOL, FILE_APPEND | LOCK_EX);
}
$all = file_exists($file) ? file_get_contents($file) : "";
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Ghi chú</title>
</head>

<body>
    <h3>Nhập ghi chú</h3>
    <form method="post">
        <textarea name="content" rows="3" cols="40"></textarea><br>
        <button type="submit">Lưu</button>
    </form>

    <h3>Nội dung đã lưu:</h3>
    <pre><?= $all ?></pre>
</body>

</html>