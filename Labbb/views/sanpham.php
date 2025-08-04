<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .product-detail{
            display: flex;
            width: 900px;
            height: 500px;
            /* border: 1px solid black; */
            margin-left: 400px;
        }
        .anh{
            width: 400px;
            height: 450px;
            border: 1px solid black;
            background-color: #121D4C;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content{
            line-height: 30px;
            margin: 20px;
        }
        p{
            color: #121D4C;
        }
    </style>
</head>
<body>
    <?php include './views/layouts/header.php'; ?>
    <img src="public/image/spchitiet.jpeg" alt="" style="margin: 10px 500px; width: 700px; height: 300px" >
    <div class="product-detail">
        <?php if (isset($product) && $product): // Kiểm tra xem có sản phẩm nào được tìm thấy không ?>
            <div class="anh">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image" width="350px" height="400px">
            </div>
            <div class="content">
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                <p class="product-price">Giá: <?= number_format($product['price']) ?> VNĐ</p>
                <p class="product-description">Mô tả: <?= htmlspecialchars($product['description']) ?></p>
                <p>Số lượng: <?= htmlspecialchars($product['quantity']) ?></p>
                <p>Lượt xem: <?= htmlspecialchars($product['view']) ?></p>
                <?php if (isset($product['discount']) && $product['discount'] > 0): ?>
                    <p>Giảm giá: <?= htmlspecialchars($product['discount']) ?>%</p>
                <?php endif; ?>
                <?php else: ?>
                <p>Không tìm thấy sản phẩm này.</p>
                <?php endif; ?>
                <a href="index.php" class="back-link">Quay lại trang chủ</a>
            </div>
    </div>
    <?php include './views/layouts/footer.php'; ?>
</body>
</html>