<?php
session_start();
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === 'admin' && $pass === '123') {
        $_SESSION['user'] = $user;
        header("Location: upload.php");
        exit;
    } else {
        $msg = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>

<body>
    <h3>Form đăng nhập</h3>
    <?php if (!empty($msg))
        echo "<p style='color:red'>$msg</p>"; ?>
    <form method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>

</html>