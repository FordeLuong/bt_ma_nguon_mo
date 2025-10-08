<?php
// =================================================================
// PHẦN XỬ LÝ PHP (BACK-END API)
// =================================================================
// Phần này sẽ xử lý các yêu cầu AJAX từ JavaScript.
// Dựa vào tham số 'action' để biết cần làm gì.

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        
        // Bài tập 04: Lấy thời gian server
        case 'get_time':
            echo date("H:i:s");
            exit; // Dừng lại để không in ra phần HTML bên dưới

        // Bài tập 05: Chào hỏi
        case 'say_hello':
            $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Bạn';
            echo "Xin chào, " . $name;
            exit;

        // Bài tập 06: Lấy danh sách sản phẩm từ file JSON
        case 'get_products':
            header('Content-Type: application/json');
            if (file_exists('products.json')) {
                echo file_get_contents('products.json');
            } else {
                echo json_encode([]); // Trả về mảng rỗng nếu file không tồn tại
            }
            exit;
            
        // Bài tập 07: Tìm kiếm sản phẩm
        case 'search_product':
            header('Content-Type: application/json');
            $products = [
                ["name" => "Iphone 15", "price" => 30000000],
                ["name" => "Samsung S24", "price" => 25000000],
                ["name" => "Laptop Dell XPS", "price" => 40000000]
            ];
            $keyword = strtolower($_GET['q'] ?? '');
            $result = [];
            if (!empty($keyword)) {
                $result = array_filter($products, function($p) use ($keyword) {
                    return strpos(strtolower($p['name']), $keyword) !== false;
                });
            }
            echo json_encode(array_values($result));
            exit;

        // Bài tập 08: Ứng dụng chat
        case 'chat':
            header('Content-Type: application/json');
            $file = 'chat.txt';
            // Nếu có tin nhắn gửi lên (POST), thì ghi vào file
            if (isset($_POST['msg'])) {
                file_put_contents($file, $_POST['msg'] . "\n", FILE_APPEND);
            }
            // Luôn trả về toàn bộ lịch sử chat
            $messages = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
            echo json_encode($messages);
            exit;

        // Bài tập 09: Dự báo thời tiết
        case 'get_weather':
            header('Content-Type: application/json');
            $city = strtolower($_GET['city'] ?? '');
            $data = [
                "hanoi" => ["temp" => 30, "desc" => "Nắng đẹp"],
                "danang" => ["temp" => 32, "desc" => "Có mây"],
                "hcm" => ["temp" => 34, "desc" => "Nắng nóng"]
            ];
            echo json_encode($data[$city] ?? ["temp" => 0, "desc" => "Không có dữ liệu"]);
            exit;
    }
}
// Nếu không có 'action' nào phù hợp, PHP sẽ tiếp tục và in ra phần HTML bên dưới.
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 3: JavaScript và AJAX</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        .container { max-width: 900px; margin: auto; }
        .exercise { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        h1, h2, h3 { color: #0056b3; }
        h3 { border-bottom: 2px solid #eee; padding-bottom: 5px; }
        button { cursor: pointer; padding: 5px 10px; margin: 5px 0; }
        input[type="text"], input[type="number"] { padding: 5px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tổng hợp Bài 3: JavaScript và Tương tác với PHP (AJAX)</h1>

        <!-- BÀI TẬP 01: JAVASCRIPT CƠ BẢN -->
        <div class="exercise">
            <h2>Bài tập 01: JavaScript cơ bản</h2>
            <h3 id="msg_hello"></h3>
            <div id="info"></div>
            <hr>
            <input type="number" id="age_input" placeholder="Nhập tuổi">
            <button onclick="checkAge()">Kiểm tra tuổi</button>
            <p id="result_age"></p>
        </div>

        <!-- BÀI TẬP 02: DOM MANIPULATION -->
        <div class="exercise">
            <h2>Bài tập 02: DOM Manipulation</h2>
            <button onclick="changeBg()">Đổi màu nền ngẫu nhiên</button>
            <hr>
            <input type="text" id="txt_input" placeholder="Nhập gì đó...">
            <button onclick="showText()">Hiển thị</button>
            <div id="output_text"></div>
            <hr>
            <input type="text" id="item_input" placeholder="Thêm mục vào danh sách">
            <button onclick="addItem()">Thêm</button>
            <ul id="list"></ul>
        </div>
        
        <!-- BÀI TẬP 03: EVENT HANDLING -->
        <div class="exercise">
            <h2>Bài tập 03: Event Handling</h2>
            <p>Di chuột vào ảnh để đổi ảnh:</p>
            <img id="hover_img" src="https://via.placeholder.com/150/FF0000/FFFFFF?text=Ảnh+1" width="150"
                 onmouseover="this.src='https://via.placeholder.com/150/0000FF/FFFFFF?text=Ảnh+2'"
                 onmouseout="this.src='https://via.placeholder.com/150/FF0000/FFFFFF?text=Ảnh+1'">
            <hr>
            <form onsubmit="return validateEmail()">
                <input type="text" id="email_input" placeholder="Nhập email">
                <button type="submit">Kiểm tra Email</button>
                <p id="msg_email"></p>
            </form>
            <hr>
            <h3>Đồng hồ điện tử:</h3>
            <h2 id="clock"></h2>
        </div>

        <!-- BÀI TẬP 04 & 05: AJAX CƠ BẢN -->
        <div class="exercise">
            <h2>Bài tập 04 & 05: AJAX cơ bản</h2>
            <h3>Thời gian hiện tại của Server (cập nhật mỗi 5 giây):</h3>
            <h2 id="time_server"></h2>
            <hr>
            <input type="text" id="name_ajax" placeholder="Nhập tên của bạn">
            <button onclick="sayHelloAjax()">Gửi lời chào (AJAX)</button>
            <p id="msg_ajax"></p>
        </div>

        <!-- BÀI TẬP 06: AJAX VỚI JSON -->
        <div class="exercise">
            <h2>Bài tập 06: Lấy danh sách sản phẩm từ file JSON</h2>
            <button onclick="getProducts()">Tải danh sách sản phẩm</button>
            <table id="tbl_products"></table>
        </div>

        <!-- BÀI TẬP 07: ỨNG DỤNG KẾT HỢP JS + PHP -->
        <div class="exercise">
            <h2>Bài tập 07: Tìm kiếm sản phẩm (Live Search)</h2>
            <input type="text" id="kw_search" placeholder="Nhập tên sản phẩm để tìm..." onkeyup="searchProduct()">
            <ul id="result_search"></ul>
        </div>

        <!-- BÀI TẬP 08: ỨNG DỤNG CHAT ĐƠN GIẢN -->
        <div class="exercise">
            <h2>Bài tập 08: Ứng dụng Chat đơn giản</h2>
            <textarea id="chat_box" rows="10" cols="50" readonly></textarea><br>
            <input type="text" id="msg_chat" placeholder="Nhập tin nhắn...">
            <button onclick="sendChatMessage()">Gửi</button>
        </div>

        <!-- BÀI TẬP 09: ỨNG DỤNG DỰ BÁO THỜI TIẾT -->
        <div class="exercise">
            <h2>Bài tập 09: Dự báo thời tiết (Fake Data)</h2>
            <input type="text" id="city_weather" placeholder="Nhập tên thành phố (hanoi, danang, hcm)">
            <button onclick="getWeather()">Xem thời tiết</button>
            <div id="weather_info"></div>
        </div>

    </div>

    <script>
    // =================================================================
    // PHẦN XỬ LÝ JAVASCRIPT (FRONT-END)
    // =================================================================

    // --- BÀI TẬP 01 ---
    document.getElementById('msg_hello').innerText = "Hello JavaScript";
    
    let name = "An";
    let age = 20;
    console.log("Bài 01:", name, age); // In ra console
    document.getElementById('info').innerHTML = `Tên: ${name}, Tuổi: ${age}`;

    function checkAge() {
        let ageInput = document.getElementById('age_input').value;
        let resultP = document.getElementById('result_age');
        if (ageInput >= 18) {
            resultP.innerText = "Bạn đã đủ tuổi";
        } else {
            resultP.innerText = "Bạn chưa đủ tuổi";
        }
    }

    // --- BÀI TẬP 02 ---
    function changeBg() {
        // Tạo màu hex ngẫu nhiên
        document.body.style.backgroundColor = '#' + Math.floor(Math.random()*16777215).toString(16);
    }
    
    function showText() {
        let textValue = document.getElementById('txt_input').value;
        document.getElementById('output_text').innerText = textValue;
    }
    
    function addItem() {
        let itemValue = document.getElementById('item_input').value;
        if (itemValue.trim() !== "") {
            let li = document.createElement('li');
            li.innerText = itemValue;
            document.getElementById('list').appendChild(li);
            document.getElementById('item_input').value = ''; // Xóa input sau khi thêm
        }
    }

    // --- BÀI TẬP 03 ---
    function validateEmail() {
        let email = document.getElementById('email_input').value;
        let msgP = document.getElementById('msg_email');
        let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (regex.test(email)) {
            msgP.innerText = "Email hợp lệ";
            msgP.style.color = "green";
        } else {
            msgP.innerText = "Email không hợp lệ";
            msgP.style.color = "red";
        }
        return false; // Ngăn form submit lại trang
    }

    function updateClock() {
        let now = new Date();
        document.getElementById('clock').innerText = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000); // Cập nhật mỗi giây
    updateClock(); // Chạy lần đầu ngay lập tức

    // --- BÀI TẬP 04 ---
    function getTimeFromServer() {
        // Gửi yêu cầu đến chính file này với action là 'get_time'
        fetch('index.php?action=get_time')
            .then(response => response.text())
            .then(data => {
                document.getElementById('time_server').innerText = data;
            });
    }
    setInterval(getTimeFromServer, 5000); // Cập nhật mỗi 5 giây
    getTimeFromServer(); // Lấy lần đầu

    // --- BÀI TẬP 05 ---
    function sayHelloAjax() {
        let name = document.getElementById('name_ajax').value;
        let formData = new FormData();
        formData.append('name', name);
        formData.append('action', 'say_hello');

        fetch('index.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('msg_ajax').innerText = data;
        });
    }

    // --- BÀI TẬP 06 ---
    function getProducts() {
        fetch('index.php?action=get_products')
            .then(response => response.json())
            .then(data => {
                let table = document.getElementById('tbl_products');
                let html = "<tr><th>Tên sản phẩm</th><th>Giá</th></tr>";
                data.forEach(p => {
                    html += `<tr><td>${p.name}</td><td>${p.price}</td></tr>`;
                });
                table.innerHTML = html;
            });
    }

    // --- BÀI TẬP 07 ---
    function searchProduct() {
        let keyword = document.getElementById('kw_search').value;
        fetch(`index.php?action=search_product&q=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(data => {
                let resultUl = document.getElementById('result_search');
                resultUl.innerHTML = data.map(p => `<li>${p.name} - ${p.price} VNĐ</li>`).join('');
            });
    }

    // --- BÀI TẬP 08 ---
    function loadChat() {
        fetch('index.php?action=chat')
            .then(response => response.json())
            .then(data => {
                document.getElementById('chat_box').value = data.join("\n");
                // Tự cuộn xuống dưới
                document.getElementById('chat_box').scrollTop = document.getElementById('chat_box').scrollHeight;
            });
    }

    function sendChatMessage() {
        let msg = document.getElementById('msg_chat').value;
        if (msg.trim() === '') return;
        
        let formData = new FormData();
        formData.append('msg', msg);
        formData.append('action', 'chat');
        
        fetch('index.php', {
            method: 'POST',
            body: formData
        })
        .then(() => {
            document.getElementById('msg_chat').value = ''; // Xóa input
            loadChat(); // Tải lại chat ngay sau khi gửi
        });
    }
    setInterval(loadChat, 3000); // Tự động tải lại chat sau mỗi 3 giây
    loadChat(); // Tải lần đầu

    // --- BÀI TẬP 09 ---
    function getWeather() {
        let city = document.getElementById('city_weather').value;
        fetch(`index.php?action=get_weather&city=${encodeURIComponent(city)}`)
            .then(response => response.json())
            .then(data => {
                let infoDiv = document.getElementById('weather_info');
                infoDiv.innerHTML = `<h3>Thời tiết tại ${city}</h3>
                                     <p>Nhiệt độ: ${data.temp}°C</p>
                                     <p>Mô tả: ${data.desc}</p>`;
            });
    }
    
    </script>
</body>
</html>