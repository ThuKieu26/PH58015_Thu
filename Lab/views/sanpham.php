<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="product-detail-container">
        <?php if (isset($product) && $product): // Kiểm tra xem có sản phẩm nào được tìm thấy không ?>
            <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image" width="350px" height="400px">
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
</body>
</html>