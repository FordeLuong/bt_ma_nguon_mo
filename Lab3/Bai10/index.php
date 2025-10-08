<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>To-do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 30px auto;
        }

        h2 {
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .completed {
            text-decoration: line-through;
            color: gray;
        }

        form {
            display: flex;
            margin-bottom: 20px;
        }

        input[type=text] {
            flex: 1;
            padding: 8px;
        }

        button {
            padding: 8px 12px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <h2>📋 To-do List</h2>

    <form id="form">
        <input type="text" id="task" placeholder="Nhập công việc..." required>
        <button type="submit">Thêm</button>
    </form>

    <ul id="list"></ul>

    <script>
        const api = 'todos.php';
        const list = document.getElementById("list");

        // Hiển thị danh sách
        function loadTodos() {
            fetch(api)
                .then(res => res.json())
                .then(data => {
                    list.innerHTML = "";
                    data.forEach((todo, i) => {
                        let li = document.createElement("li");
                        li.innerHTML = `
              <span class="${todo.completed ? 'completed' : ''}">${todo.task}</span>
              <span>
                <button onclick="toggle(${i})">✅</button>
                <button onclick="remove(${i})">❌</button>
              </span>`;
                        list.appendChild(li);
                    });
                });
        }

        // Thêm mới
        document.getElementById("form").onsubmit = e => {
            e.preventDefault();
            let formData = new FormData();
            formData.append("task", document.getElementById("task").value);
            fetch(api, { method: "POST", body: formData })
                .then(() => {
                    document.getElementById("task").value = "";
                    loadTodos();
                });
        };

        // Toggle hoàn thành
        function toggle(id) {
            fetch(api, { method: "PUT", body: "id=" + id })
                .then(() => loadTodos());
        }

        // Xóa
        function remove(id) {
            fetch(api, { method: "DELETE", body: "id=" + id })
                .then(() => loadTodos());
        }

        loadTodos();
    </script>
</body>

</html>