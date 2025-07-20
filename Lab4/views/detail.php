
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
</head>
<body>
    <h2><?= $product['name'] ?></h2>
    <p>Giá: <?= number_format($product['price']) ?> VNĐ</p>
    <p>Mô tả: <?= $product['description'] ?></p>
    <a href="index.php"> Quay trở lại</a>
</body>
</html>