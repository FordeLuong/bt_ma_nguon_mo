<?php
// Bắt đầu session để sử dụng cho Bài 13
// Lệnh này PHẢI được gọi trước bất kỳ output HTML nào
session_start();

// ===================================================================================
// BÀI 1: CÁC BƯỚC CHUẨN BỊ TRƯỚC KHI CODE
//
// 1. MÔI TRƯỜNG: Cần một môi trường máy chủ web hỗ trợ PHP, ví dụ như XAMPP hoặc Laragon.
//    Hãy đảm bảo bạn đã khởi động Apache Web Server.
//
// 2. LƯU FILE: Lưu đoạn mã này thành một file có tên, ví dụ: `tong_hop_bai_tap.php`
//    và đặt nó vào thư mục gốc của web server (thường là 'htdocs' trong XAMPP).
//
// 3. TẠO THƯ MỤC:
//    - Để Bài 11 (Upload file) hoạt động, hãy tạo một thư mục con tên là 'uploads'
//      cùng cấp với file `tong_hop_bai_tap.php`.
//    - Để Bài 12 (Ghi file) hoạt động, hãy tạo một thư mục con tên là 'data'
//      cùng cấp với file này.
//    *QUAN TRỌNG*: Đảm bảo thư mục 'uploads' và 'data' có quyền ghi (writable).
//
// 4. CHẠY CHƯƠNG TRÌNH: Mở trình duyệt và truy cập vào địa chỉ
//    http://localhost/tong_hop_bai_tap.php
//
// ===================================================================================

// ===================================================================================
// KHAI BÁO CÁC HÀM SỬ DỤNG CHUNG (CHO BÀI 6, 7, 8, 9)
// ===================================================================================

/**
 * BÀI 06: Hàm kiểm tra một số có phải là số nguyên tố hay không.
 * @param int $n Số cần kiểm tra
 * @return bool True nếu là số nguyên tố, False nếu không.
 */
function isPrime($n) {
    if ($n < 2) return false;
    if ($n == 2) return true;
    if ($n % 2 == 0) return false;
    for ($i = 3; $i <= sqrt($n); $i += 2) {
        if ($n % $i == 0) return false;
    }
    return true;
}

/**
 * BÀI 07: Hàm tính diện tích hình tròn.
 * @param float $r Bán kính
 * @return float Diện tích
 */
function areaCircle($r) {
    return pi() * $r * $r;
}

/**
 * BÀI 08: Hàm tìm số lớn nhất và nhỏ nhất trong mảng.
 * @param array $a Mảng các số
 * @return array Mảng kết hợp chứa 'min' và 'max'
 */
function minMax($a) {
    if (empty($a)) return ['min' => null, 'max' => null];
    return ['min' => min($a), 'max' => max($a)];
}

/**
 * BÀI 09: Hàm đảo ngược chuỗi.
 * @param string $s Chuỗi đầu vào
 * @return string Chuỗi đã đảo ngược
 */
function reverseStr($s) {
    return strrev($s);
}


// ===================================================================================
// KHU VỰC XỬ LÝ LOGIC TỪ CÁC FORM (GET/POST)
// Phần này xử lý dữ liệu được gửi lên từ các form HTML bên dưới.
// ===================================================================================
$result_message = ''; // Biến lưu thông báo kết quả để hiển thị

// -- Xử lý cho Bài 13: Đăng xuất bằng Session --
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header('Location: tong_hop_bai_tap.php'); // Tải lại trang để về trạng thái đăng nhập
    exit;
}

// -- Xử lý cho Bài 14: Xóa Cookie --
if (isset($_GET['action']) && $_GET['action'] == 'delete_cookie') {
    setcookie('username', '', time() - 3600, '/');
    header('Location: tong_hop_bai_tap.php');
    exit;
}

// -- Xử lý các request POST --
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Bài 04: Xếp loại điểm
    if (isset($_POST['score'])) {
        $s = (float)$_POST['score'];
        $rank = ($s >= 8) ? "Giỏi" : (($s >= 6.5) ? "Khá" : (($s >= 5) ? "Trung bình" : "Yếu"));
        $result_message = "<b>Kết quả Bài 04:</b> Điểm $s - Xếp loại: $rank";
    }

    // Bài 10: Xử lý thông tin cá nhân
    elseif (isset($_POST['hoten'])) {
        $hoten = htmlspecialchars(trim($_POST['hoten']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $result_message = "<b>Kết quả Bài 10:</b> Họ tên: $hoten, Email: $email, Phone: $phone";
    }

    // Bài 11: Xử lý upload ảnh
    elseif (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $f = $_FILES['avatar'];
        $target_dir = 'uploads/';
        $target_file = $target_dir . time() . '_' . basename($f['name']);
        if (move_uploaded_file($f['tmp_name'], $target_file)) {
            $result_message = "<b>Kết quả Bài 11:</b> Upload thành công! <br><img src='$target_file' style='max-width:200px;'>";
        } else {
            $result_message = "<b>Kết quả Bài 11:</b> Lỗi khi di chuyển file.";
        }
    }

    // Bài 12: Ghi thông tin vào file
    elseif (isset($_POST['note'])) {
        $note = trim($_POST['note']);
        if (!empty($note)) {
            $line = date("Y-m-d H:i:s") . " | " . $note . PHP_EOL;
            file_put_contents('data/data.txt', $line, FILE_APPEND | LOCK_EX);
            $all_notes = htmlspecialchars(file_get_contents('data/data.txt'));
            $result_message = "<b>Kết quả Bài 12:</b> Đã lưu.<hr>Nội dung file:<br><pre>$all_notes</pre>";
        }
    }
    
    // Bài 13: Xử lý đăng nhập
    elseif (isset($_POST['username_login'])) {
        $user = $_POST['username_login'];
        $pass = $_POST['password_login'];
        if ($user === 'admin' && $pass === '123') {
            $_SESSION['user'] = $user;
            $result_message = "<b>Kết quả Bài 13:</b> Đăng nhập thành công!";
        } else {
            $result_message = "<b>Kết quả Bài 13:</b> Sai thông tin đăng nhập!";
        }
    }
    
    // Bài 14: Ghi nhớ tên bằng Cookie
    elseif (isset($_POST['username_cookie'])) {
        $name = trim($_POST['username_cookie']);
        if(!empty($name)) {
            setcookie('username', $name, time() + 3600, '/'); // Cookie tồn tại trong 1 giờ
            header('Location: tong_hop_bai_tap.php'); // Tải lại trang để thấy cookie
            exit;
        }
    }

    // Bài 16: Tính tổng từ 1 đến N
    elseif (isset($_POST['number_n'])) {
        $n = (int)$_POST['number_n'];
        if ($n > 0) {
            $sum = 0;
            for ($i = 1; $i <= $n; $i++) {
                $sum += $i;
            }
            $result_message = "<b>Kết quả Bài 16:</b> Tổng các số từ 1 đến $n là: $sum";
        } else {
             $result_message = "<b>Kết quả Bài 16:</b> Vui lòng nhập số N lớn hơn 0.";
        }
    }

}

// -- Xử lý các request GET --
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Bài 03: Tính chu vi, diện tích hình tròn
    if (isset($_GET['r']) && is_numeric($_GET['r'])) {
        $r = (float)$_GET['r'];
        $chuvi = 2 * pi() * $r;
        $dientich = pi() * $r * $r;
        $result_message = "<b>Kết quả Bài 03:</b> Với bán kính $r: <br> - Chu vi: " . round($chuvi, 2) . "<br> - Diện tích: " . round($dientich, 2);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tổng hợp Bài tập PHP</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        .container { max-width: 800px; margin: auto; }
        .exercise { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        h2 { color: #0056b3; }
        h3 { border-bottom: 2px solid #eee; padding-bottom: 5px; }
        code { background-color: #f4f4f4; padding: 2px 5px; border-radius: 3px; }
        .result-box { background-color: #e9f7ef; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        form { margin-top: 10px; }
        input[type="text"], input[type="number"], input[type="email"], input[type="password"] { padding: 5px; margin-right: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tổng hợp các bài tập PHP cơ bản</h1>

        <?php if (!empty($result_message)): ?>
            <div class="result-box"><?php echo $result_message; ?></div>
        <?php endif; ?>

        <div class="exercise">
            <h2>Bài 01: In "Hello PHP!" và thời gian hiện tại</h2>
            <h3>Kết quả:</h3>
            <?php
            echo "<h1>Hello PHP!</h1>";
            echo "<p>Thời gian hiện tại: " . date("d/m/Y H:i:s") . "</p>";
            ?>
        </div>

        <div class="exercise">
            <h2>Bài 02: Tạo biến và in ra câu giới thiệu</h2>
            <h3>Kết quả:</h3>
            <?php
            $name = "Nguyễn Văn A";
            $age = 21;
            echo "Xin chào, tôi là $name, năm nay $age tuổi.";
            ?>
        </div>

        <div class="exercise">
            <h2>Bài 03: Tính chu vi và diện tích hình tròn (Form GET)</h2>
            <form action="" method="get">
                Bán kính: <input type="number" name="r" step="any" required>
                <input type="submit" value="Tính">
            </form>
        </div>

        <div class="exercise">
            <h2>Bài 04: Xếp loại điểm (Form POST)</h2>
            <form action="" method="post">
                Điểm: <input type="number" name="score" step="0.1" required>
                <input type="submit" value="Xem xếp loại">
            </form>
        </div>
        
        <div class="exercise">
            <h2>Bài 05: In bảng cửu chương 2 → 9</h2>
            <h3>Kết quả:</h3>
            <?php
            for ($i = 2; $i <= 9; $i++) {
                echo "<h3>Bảng cửu chương $i</h3>";
                for ($j = 1; $j <= 10; $j++) {
                    echo "$i x $j = " . ($i * $j) . "<br>";
                }
            }
            ?>
        </div>

        <div class="exercise">
            <h2>Bài 06: Liệt kê các số nguyên tố từ 1 đến 100</h2>
            <h3>Kết quả:</h3>
            <?php
            for ($i = 1; $i <= 100; $i++) {
                if (isPrime($i)) {
                    echo "$i ";
                }
            }
            ?>
        </div>

        <div class="exercise">
            <h2>Bài 07 & 08 & 09: Sử dụng các hàm đã định nghĩa</h2>
            <h3>Kết quả Bài 07 (Diện tích hình tròn r=3):</h3>
            <?php echo areaCircle(3); ?>
            
            <h3>Kết quả Bài 08 (Min/Max của mảng [5, 12, 3, 9, -2, 20]):</h3>
            <?php
            $arr = [5, 12, 3, 9, -2, 20];
            $mm = minMax($arr);
            echo "Min: {$mm['min']}, Max: {$mm['max']}";
            ?>

            <h3>Kết quả Bài 09 (Đảo ngược chuỗi "Hello"):</h3>
            <?php echo reverseStr("Hello"); ?>
        </div>
        
        <div class="exercise">
            <h2>Bài 10: Nhập và hiển thị thông tin</h2>
            <form action="" method="post">
                Họ tên: <input type="text" name="hoten" required><br>
                Email: <input type="email" name="email" required><br>
                Phone: <input type="text" name="phone" required><br>
                <input type="submit" value="Gửi">
            </form>
        </div>

        <div class="exercise">
            <h2>Bài 11: Upload file ảnh</h2>
            <form action="" method="post" enctype="multipart/form-data">
                Chọn ảnh: <input type="file" name="avatar" accept="image/*" required><br>
                <input type="submit" value="Upload">
            </form>
        </div>

        <div class="exercise">
            <h2>Bài 12: Ghi chú vào file</h2>
            <form action="" method="post">
                Nội dung: <input type="text" name="note" size="50" required><br>
                <input type="submit" value="Lưu">
            </form>
        </div>

        <div class="exercise">
            <h2>Bài 13: Đăng nhập bằng Session</h2>
            <?php if (!empty($_SESSION['user'])): ?>
                <p>Xin chào, <b><?php echo htmlspecialchars($_SESSION['user']); ?></b>!</p>
                <a href="?action=logout">Đăng xuất</a>
            <?php else: ?>
                <form action="" method="post">
                    <p>Demo: dùng <code>admin</code> / <code>123</code></p>
                    Username: <input type="text" name="username_login" required><br>
                    Password: <input type="password" name="password_login" required><br>
                    <input type="submit" value="Đăng nhập">
                </form>
            <?php endif; ?>
        </div>

        <div class="exercise">
            <h2>Bài 14: Ghi nhớ tên bằng Cookie (trong 1 giờ)</h2>
            <?php if (isset($_COOKIE['username'])): ?>
                <p>Chào mừng trở lại, <b><?php echo htmlspecialchars($_COOKIE['username']); ?></b>!</p>
                <a href="?action=delete_cookie">Xóa cookie (Quên tôi)</a>
            <?php else: ?>
                 <form action="" method="post">
                    Nhập tên để ghi nhớ: <input type="text" name="username_cookie" required><br>
                    <input type="submit" value="Lưu">
                </form>
            <?php endif; ?>
        </div>
        
        <div class="exercise">
            <h2>Bài 16: Tính tổng các số từ 1 đến N</h2>
            <form action="" method="post">
                Nhập số N: <input type="number" name="number_n" required><br>
                <input type="submit" value="Tính tổng">
            </form>
        </div>

    </div>
</body>
</html>