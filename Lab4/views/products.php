<?php include './views/layouts/header.php'; ?>
<h2 style="margin: 10px 600px;">Sản phẩm theo danh mục: <?= $categoryName ?></h2>
<ul>
<?php foreach ($products as $sp): ?>
    <li style="margin: 10px 600px; list-style-type: none"><?= $sp['name'] ?> - <?= number_format($sp['price']) ?> VNĐ</li>
<?php endforeach; ?>
</ul>
<?php include './views/layouts/footer.php'; ?>
