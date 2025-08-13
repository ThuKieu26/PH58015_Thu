<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 0;
}

.product-detail {
    display: flex;
    width: 900px;
    height: auto;
    margin: 30px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

.anh {
    width: 400px;
    height: 450px;
    background-color: #121D4C;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
}

.anh img {
    border-radius: 8px;
    object-fit: cover;
}

.content {
    line-height: 28px;
    padding: 20px;
    flex: 1;
}

.product-title {
    color: #121D4C;
    font-size: 24px;
    margin-bottom: 10px;
}

.product-price {
    color: #ff5722;
    font-size: 20px;
    font-weight: bold;
}

.product-description,
.content p {
    color: #333;
}

button {
    background-color: #121D4C;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background-color: #0d153a;
}

.back-link {
    display: inline-block;
    margin-top: 15px;
    color: #121D4C;
    text-decoration: none;
    font-weight: bold;
}

.back-link:hover {
    text-decoration: underline;
}

.comments-section {
    background: #fff;
    width: 900px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.comments-section h2 {
    color: #121D4C;
}

textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    resize: none;
}

.comments-list h3 {
    color: #121D4C;
    margin-bottom: 10px;
}

.comment {
    border: 1px solid #ddd;
    border-left: 4px solid #121D4C;
    padding: 10px;
    border-radius: 5px;
    background: #f9faff;
}
    </style>
</head>
<body>
    <?php include './views/layouts/header.php'; ?>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='color: green; text-align: center;'>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red; text-align: center;'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    ?>
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
            
                <form action="index.php?act=cart-add" method="post">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                    <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                    <button type="submit">Thêm vào giỏ hàng</button>
                </form>
                <a href="index.php" class="back-link">Quay lại trang chủ</a>
            </div>
    </div>

    <hr>
    <div class="comments-section" style="margin-left: 400px;">
        <h2>Bình luận</h2>
            <form action="index.php?act=comment-add" method="post">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                <textarea name="content" placeholder="Viết bình luận của bạn..." required style="width: 500px; height: 100px;"></textarea><br>
                <button type="submit" name="submit_comment" style="margin-top: 10px;">Gửi bình luận</button>
            </form>

        <div class="comments-list" style="margin-top: 20px;">
            <h3>Các bình luận trước đó</h3>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <strong><?= htmlspecialchars($comment['user_name']) ?>:</strong>
                        <span><?= htmlspecialchars($comment['content']) ?></span>
                        <br>
                        <small>Vào lúc: <?= htmlspecialchars($comment['date']) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có bình luận nào.</p>
            <?php endif; ?>
        </div>
        
    </div>
    
    <?php else: ?>
        <div class="product-detail" style="display: block; text-align: center;">
            <p>Không tìm thấy sản phẩm này.</p>
        </div>
    <?php endif; ?>
    <?php include './views/layouts/footer.php'; ?>
</body>
</html>