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
        color: #0b3d91;
    }
    .contact-form-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .contact-form {
        max-width: 500px;
        width: 100%;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-top: 4px solid #0b3d91;
        margin: auto;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #0b3d91;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .form-group button {
        width: 100%;
        padding: 12px;
        background-color: #0b3d91;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    .form-group button:hover {
        background-color: #093173;
    }
    .success-message {
        padding: 15px;
        margin-bottom: 20px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        text-align: center;
    }
</style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h1>Liên hệ</h1>
<form action="index.php?act=lienhe" method="POST" class="contact-form">
        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Nội dung:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" onclick="return confirm('Đã gửi đi')">Gửi</button>
        </div>
    </form>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
