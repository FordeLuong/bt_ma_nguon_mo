<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $f = $_FILES['file'];
    if ($f['error'] === 0) {
        if (!is_dir('uploads'))
            mkdir('uploads', 0777, true);
        if (!is_dir('data'))
            mkdir('data', 0777, true);

        $target = 'uploads/' . time() . "_" . basename($f['name']);
        if (move_uploaded_file($f['tmp_name'], $target)) {
            $line = $_SESSION['user'] . "|" . basename($target) . "|" . date("Y-m-d H:i:s") . PHP_EOL;
            file_put_contents('data/uploads.txt', $line, FILE_APPEND | LOCK_EX);

            setcookie("last_file", basename($target), time() + 3600);

            $msg = "Upload thành công!";
        } else
            $msg = "Lỗi lưu file.";
    } else
        $msg = "Lỗi upload.";
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Upload</title>
</head>

<body>
    <p>Xin chào <b><?= htmlspecialchars($_SESSION['user']) ?></b> |
        <a href="files.php">Xem files</a> |
        <a href="logout.php">Đăng xuất</a>
    </p>

    <?php if (!empty($msg))
        echo "<p>$msg</p>"; ?>
    <form method="post" enctype="multipart/form-data">
        Chọn file: <input type="file" name="file"><br>
        <button type="submit">Upload</button>
    </form>

    <?php
    if (!empty($_COOKIE['last_file'])) {
        echo "<p>File cuối cùng bạn upload: " . htmlspecialchars($_COOKIE['last_file']) . "</p>";
    }
    ?>
</body>

</html>