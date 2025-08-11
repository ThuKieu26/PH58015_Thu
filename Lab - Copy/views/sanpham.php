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
            <form action="index.php?act=products-detail&id=<?= $product['id'] ?>" method="post">
                <textarea name="content" placeholder="Viết bình luận của bạn..." required style="width: 500px; height: 100px;"></textarea><br>
                <input type="hidden" name="submit_comment" value="1">
                <button type="submit" style="margin-top: 10px;">Gửi bình luận</button>
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