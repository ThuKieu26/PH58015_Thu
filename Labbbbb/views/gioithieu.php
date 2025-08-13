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
        margin-top: 40px;
        color: #0b3d91; 
    }
    .about-container {
        max-width: 1000px;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-top: 4px solid #0b3d91;
    }
    .about-container img {
        display: block;
        margin: 0 auto 20px auto;
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    .about-container p {
        line-height: 1.8;
        color: #333;
        font-size: 16px;
        text-align: justify;
    }
</style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h1>Giới thiệu về cửa hàng</h1>
<div class="about-container">
    <img src="public/image/spchitiet.jpeg" alt="Cửa hàng HAPAS">
    <p>
        Hành trình từ cửa hàng túi xách tới thương hiệu có tiếng.<br><br>
        Trước khi được biết với tên thương hiệu mới, HAPAS đã từng là một trong những địa điểm mua sắm túi xách & phụ kiện có tiếng tại Hà Nội dưới tên gọi HÀ TÚI. Không muốn đi lại con đường cũ của các cửa hàng thời trang bấy giờ, HAPAS quyết định chuyển mình, thay đổi tên thương hiệu mới, định vị mới, mang trong mình sứ mệnh & nguồn cảm hứng mới.<br><br>
        Giữa hàng ngàn thương hiệu thời trang trên thị trường, HAPAS lựa chọn cách tiếp cận mới mẻ nhưng thân thuộc với khách hàng. Không phô trương hay cầu kỳ vào hình thức, HAPAS chọn mang tới "điều bình thường tươi đẹp" thông qua mỗi sản phẩm, để khách hàng dễ dàng cảm nhận được sự giản đơn nhưng không nhàm chán, để mỗi ngày thường trôi qua không nhạt nhòa.
    </p>
</div>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
