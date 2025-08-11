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
    margin-bottom: 20px;
}
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 0 auto;
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
    box-sizing: border-box; /* Đảm bảo padding không làm tăng chiều rộng */
}
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
button[type="submit"]:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    <?php include './views/layouts/header.php'; ?>

<h1>Chỉnh sửa người dùng</h1>
<form action="index.php?act=user-edit" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

    <label for="username">Tên người dùng:</label><br>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>
    
    <label for="password">Mật khẩu (để trống nếu không đổi):</label><br>
    <input type="password" id="password" name="password"><br><br>
    
    <label for="role">Quyền:</label><br>
    <select id="role" name="role">
        <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>Người dùng</option>
        <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
    </select><br><br>

    <button type="submit">Cập nhật người dùng</button>
</form>

<?php include './views/layouts/footer.php'; ?>
</body>
</html>