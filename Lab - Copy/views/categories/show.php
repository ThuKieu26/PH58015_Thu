<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .category-section{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            line-height: 20px;
        }
        h2{
            margin: 30px;
        }
    </style>
</head>
<body>

<?php include './views/layouts/header.php'; ?>
<h2 style="text-align: center;">Tất cả danh mục sản phẩm</h2>
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $item): ?>
            <div class="category-section">
                <h2 class="category-title"><?= htmlspecialchars($item['category']['name']) ?></h2>
                <?php if (!empty($item['products'])): ?>
                    <ul class="product-list">
                        <?php foreach ($item['products'] as $p): ?>
                            <li>
                                <?= htmlspecialchars($p['name']) ?> - <?= number_format($p['price']) ?> VNĐ
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="no-products">Không có sản phẩm nào trong danh mục này.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center;">Không có danh mục nào để hiển thị.</p>
    <?php endif; ?>

<?php include './views/layouts/footer.php'; ?>
    
</body>
</html>