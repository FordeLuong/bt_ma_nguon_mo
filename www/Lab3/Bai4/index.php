<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 id="time"></h1>
    <script>
        function getTime(){
            fetch('time.php')
                .then(res => res.text())
                .then(data => {
                    document.getElementById("time").innerText = data;
                });
        }
        setInterval(getTime, 1000);
        getTime();
    </script>
</body>
</html>