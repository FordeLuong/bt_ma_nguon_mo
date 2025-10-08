<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="info"></div>
    <script>
        let name = "An";
        let age = 20;
        console.log(name, age);
        document.getElementById("info").innerHTML = "Name: " + name + ", Age: " + age;
        
    </script>
</body>
</html>
Kiểm tra tuổi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="number" id="age" placeholder="Enter your age">
    <button onclick="checkAge()">Kiểm tra</button>
    <p id="result"></p>
    <script>
        function checkAge(){
            let age = document.getElementById("age").value;
            let result = document.getElementById("result");
            if(age >= 18){
                result.innerHTML = "Bạn đã đủ tuổi";
            } else {
                result.innerHTML = "Bạn chưa đủ tuổi";
            }
        }
    </script>
</body>
</html>