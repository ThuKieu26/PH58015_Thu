<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        button[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h1>Thêm người dùng mới</h1>
<a href="index.php?act=category-list">Quay lại</a>
<form action="index.php?act=user-add" method="POST">
    <label for="username">Tên người dùng:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="password">Mật khẩu:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="role">Quyền:</label><br>
    <select id="role" name="role">
        <option value="user">Người dùng</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Thêm người dùng</button>
</form>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
