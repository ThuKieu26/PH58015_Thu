<?php include './views/layouts/header.php'; ?>

<h2>Chi tiết sản phẩm</h2>

<p><strong>Tên:</strong> <?= $product['name'] ?></p>
<p><strong>Giá:</strong> <?= number_format($product['price']) ?> VNĐ</p>
<p><strong>Mô tả:</strong> <?= $product['description'] ?></p>
<p><strong>Danh mục:</strong> <?= $product['category_id'] ?></p>

<a href="index.php?act=product-list">← Quay lại danh sách</a>

<?php include './views/layouts/footer.php'; ?>
