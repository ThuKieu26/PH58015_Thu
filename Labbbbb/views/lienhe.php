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
    .contact-section {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-top: 4px solid #0b3d91;
    }
    .contact-item {
        margin-bottom: 30px;
        text-align: center;
    }
    .contact-item h2 {
        color: #0b3d91;
        font-size: 18px;
        margin-bottom: 8px;
    }
    .phone {
        font-size: 20px;
        color: #093173;
        font-weight: bold;
        margin: 5px 0;
    }
    p {
        color: #333;
        margin: 3px 0;
    }
</style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h1>Liên hệ</h1>
<div class="contact-section">
    <div class="contact-item">
        <h2>GỌI MUA HÀNG (08:30 - 21:30)</h2>
        <p class="phone">📞 036 866 3456</p>
        <p>Tất cả các ngày trong tuần</p>
    </div>
    <div class="contact-item">
        <h2>GÓP Ý, KHIẾU NẠI (08:30 - 20:30)</h2>
        <p class="phone">📞 036 866 3456</p>
        <p>Các ngày trong tuần (trừ ngày lễ)</p>
    </div>
</div>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
