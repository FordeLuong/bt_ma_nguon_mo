<?php
require '../Bai1/connect.php';

try {
    $sql = "ALTER TABLE students ADD birthday DATE";
    $conn->exec($sql);
    echo "Thêm cột birthday thành công!<br>";

    $stmt = $conn->prepare("UPDATE students SET birthday = ? WHERE id = ?");

    $updates = [
        ['1990-05-15', 1],
        ['1995-10-20', 2],
        ['1992-07-30', 6],
    ];

    foreach ($updates as $update) {
        $stmt->execute([$update[0], $update[1]]);
    }

    echo "Cập nhật birthday thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>