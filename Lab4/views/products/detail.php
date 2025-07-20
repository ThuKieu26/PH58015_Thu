<?php include './views/layouts/header.php'; ?>

<h2 style="margin: 10px 600px;">Chi tiết sản phẩm</h2>

<p style="margin: 10px 600px;"><strong>Tên:</strong> <?= $product['name'] ?></p>
<p style="margin: 10px 600px;"><strong>Giá:</strong> <?= number_format($product['price']) ?> VNĐ</p>
<p style="margin: 10px 600px;"><strong>Mô tả:</strong> <?= $product['description'] ?></p>
<p style="margin: 10px 600px;"><strong>Danh mục:</strong> <?= $product['category_id'] ?></p>

<a href="index.php?act=product-list" style="margin: 10px 600px;"> Quay lại danh sách</a>

<?php include './views/layouts/footer.php'; ?>
