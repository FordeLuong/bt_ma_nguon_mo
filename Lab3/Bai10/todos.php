<?php
$file = "todos.json";

// Nếu chưa có file thì tạo rỗng
if (!file_exists($file)) {
    file_put_contents($file, json_encode([], JSON_PRETTY_PRINT));
}

// Đọc dữ liệu
$todos = json_decode(file_get_contents($file), true);

// Lấy danh sách
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    echo json_encode($todos);
    exit;
}

// Thêm mới
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'] ?? '';
    if ($task !== '') {
        $todos[] = ['task' => $task, 'completed' => false];
        file_put_contents($file, json_encode($todos, JSON_PRETTY_PRINT));
    }
    echo "OK";
    exit;
}

// Toggle hoàn thành
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'] ?? -1;
    if (isset($todos[$id])) {
        $todos[$id]['completed'] = !$todos[$id]['completed'];
        file_put_contents($file, json_encode($todos, JSON_PRETTY_PRINT));
    }
    echo "OK";
    exit;
}

// Xóa
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'] ?? -1;
    if (isset($todos[$id])) {
        array_splice($todos, $id, 1);
        file_put_contents($file, json_encode($todos, JSON_PRETTY_PRINT));
    }
    echo "OK";
    exit;
}
