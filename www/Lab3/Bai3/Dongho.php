<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 id="clock"></h1>
    <script>
        function updateClock(){
            let now = new Date();
            document.getElementById("clock").innerText = now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock(); 
    </script>
</body>
</html>