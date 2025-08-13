<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f8fb;
    }
    h1 {
        text-align: center;
        margin-top: 50px;
        color: #0b3d91;
    }
    form {
        background: white;
        max-width: 350px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        border-top: 4px solid #0b3d91;
    }
    p {
        margin: 10px 0 5px;
        color: #0b3d91;
        font-weight: bold;
    }
    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        font-size: 14px;
    }
    input:focus {
        border-color: #0b3d91;
        box-shadow: 0 0 5px rgba(11, 61, 145, 0.5);
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #0b3d91;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
    }
    button:hover {
        background-color: #093173;
    }
</style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h1>Đăng nhập</h1>
<form action="index.php?act=dangnhap"  method="post">
    <p>Email</p>
    <input type="text" name="email" placeholder="Nhập Email"><br>
    <p>Mật khẩu</p>
    <input type="password" name="password" placeholder="Mật khẩu"><br>
    <button>Đăng nhập</button>
</form>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
