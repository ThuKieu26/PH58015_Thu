<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .chitiet{ 
            margin: auto;
        }
        h2{
            color: #666fa0ff;
        }
    </style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
    <div class="chitiet">
        <img src="public/image/spchitiet.jpeg" alt="" style="margin: 10px 350px; width: 1000px; height: 500px" >
        <h2>Chi tiết sản phẩm</h2>

        <p><strong>Tên:</strong> <?= $product['name'] ?></p>
        <p><strong>Giá:</strong> <?= number_format($product['price']) ?> VNĐ</p>
        <p><strong>Mô tả:</strong> <?= $product['description'] ?></p>
        <p><strong>Danh mục:</strong> <?= $product['category_id'] ?></p>

    <a href="index.php?act=product-list">Quay lại danh sách</a>
    </div>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
