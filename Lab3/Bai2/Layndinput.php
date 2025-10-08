
<!-- Lấy nội dung input  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" id="txt" placeholder="Nhập gì đó">
    <button onclick="showText()">Hiển thị</button>
    <div id="output"></div>
    <script>
        function showText() {
            document.getElementById("output").innerText =

                document.getElementById("txt").value;
        }
    </script>
</body>

</html>
