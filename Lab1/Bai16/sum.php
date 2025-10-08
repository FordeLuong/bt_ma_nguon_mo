<?php
$result = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = (int) ($_POST['n'] ?? 0);
    $sum = 0;
    for ($i = 1; $i <= $n; $i++)
        $sum += $i;
    $result = "Tổng từ 1 đến $n = $sum";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tổng 1-N</title>
</head>

<body>
    <h3>Tính tổng từ 1 đến N</h3>
    <form method="post">
        Nhập N: <input type="number" name="n">
        <button type="submit">Tính</button>
    </form>
    <p><?= $result ?></p>
</body>

</html>