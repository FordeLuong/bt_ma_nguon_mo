<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách files</title>
</head>

<body>
    <h3>Danh sách file đã upload</h3>
    <p><a href="upload.php">Quay lại Upload</a> | <a href="logout.php">Đăng xuất</a></p>

    <?php
    if (file_exists('data/uploads.txt')) {
        $lines = file('data/uploads.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        echo "<ul>";
        foreach ($lines as $ln) {
            list($user, $fname, $time) = explode("|", $ln);
            echo "<li>$time — $user — <a href='uploads/$fname' target='_blank'>$fname</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Chưa có file nào.";
    }
    ?>
</body>

</html>