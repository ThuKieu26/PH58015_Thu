<!-- <?php include './views/layouts/header.php'; ?>
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
<?php include './views/layouts/footer.php'; ?> -->

<?php include './views/layouts/header.php'; ?>
<h2 style="text-align: center;">Tất cả danh mục sản phẩm</h2>
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

<?php include './views/layouts/footer.php'; ?>