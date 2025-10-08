<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form onsubmit="return validateEmail()">
        <input type="text" id="email" placeholder="Enter your email">
        <button type="submit">Kiểm tra</button>
    </form>
    <p id="msg"></p>
    <script>
        function validateEmail(){
            let email = document.getElementById("email").value;
            let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (regex.test(email)){
                document.getElementById("msg").innerText = "Email hợp lệ";
            } else {
                document.getElementById("msg").innerText = "Email không hợp lệ";
            }
            return false; 
        }
    </script>
</body>
</html>