<?php include './views/layouts/header.php'; ?>
<h2 style="margin: 10px 600px;">Sản phẩm thuộc danh mục: <?= $category['name'] ?? '' ?></h2>
<?php if (!empty($products)): ?>
    <ul style="margin: 10px 600px; list-style-type: none;">
        <?php foreach ($products as $p): ?>
            <li>
                <?= $p['name'] ?> - <?= number_format($p['price']) ?> VNĐ
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Không có sản phẩm nào trong danh mục này.</p>
<?php endif; ?>
<a href="index.php?act=category-list" style="margin: 10px 600px;"> Quay lại danh mục</a>
<?php include './views/layouts/footer.php'; ?>
