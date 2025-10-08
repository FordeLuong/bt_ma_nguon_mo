<?php
$students = [
    ["name" => "Nguyen Van A", "score" => 7.5],
    ["name" => "Tran Thi B", "score" => 9.0],
    ["name" => "Le Van C", "score" => 8.2],
];
$best = null;
foreach ($students as $st) {
    if ($best === null || $st['score'] > $best['score']) {
        $best = $st;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
</head>

<body>
    <h3>Danh sách sinh viên</h3>
    <ul>
        <?php foreach ($students as $st): ?>
            <li><?= $st['name'] ?> — <?= $st['score'] ?></li>
        <?php endforeach; ?>
    </ul>

    <p><b>Sinh viên điểm cao nhất:</b> <?= $best['name'] ?> (<?= $best['score'] ?>)</p>
</body>

</html>