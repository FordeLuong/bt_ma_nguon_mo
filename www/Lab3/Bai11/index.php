<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Tỷ giá ngoại tệ</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 500px; margin: 30px auto; }
    h2 { text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>
  <h2>💱 Tỷ giá ngoại tệ</h2>
  <table id="tbl">
    <tr><th>Tiền tệ</th><th>Tỷ giá (VND)</th></tr>
  </table>

  <script>
    function loadRates() {
      fetch('rates.php')
        .then(res => res.json())
        .then(data => {
          let html = "<tr><th>Tiền tệ</th><th>Tỷ giá (VND)</th></tr>";
          for (let k in data) {
            html += `<tr><td>${k}</td><td>${data[k].toLocaleString()}</td></tr>`;
          }
          document.getElementById("tbl").innerHTML = html;
        })
        .catch(err => console.error("Lỗi:", err));
    }

    // Lần đầu tải
    loadRates();
    // Cập nhật mỗi 10 phút (600000 ms)
    setInterval(loadRates, 600000);
  </script>
</body>
</html>
