<?php
function toUpper($str)
{
    return mb_strtoupper($str, "UTF-8"); // hỗ trợ tiếng Việt
}
$result = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $txt = $_POST['txt'] ?? '';
    $result = toUpper($txt);
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Viết hoa chuỗi</title>
</head>

<body>
    <h3>Chuyển chuỗi thành in hoa</h3>
    <form method="post">
        Nhập chuỗi: <input type="text" name="txt">
        <button type="submit">Chuyển</button>
    </form>
    <p>Kết quả: <?= $result ?></p>
</body>

</html>