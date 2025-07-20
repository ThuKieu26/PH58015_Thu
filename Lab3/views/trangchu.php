<?php include './views/layouts/header.php'; ?>

<h1><?= $title ?></h1>
<h2><?= $thoiTiet ?></h2>

<h3 style="margin: 10px 600px;">Danh sách sản phẩm:</h3>
<ul style="margin: 10px 600px; list-style-type: none;">
    <?php foreach ($products as $sp): ?>
        <li>
            <a href="index.php?act=detail&id=<?= $sp['id'] ?>">
                <?= $sp['name'] ?> - <?= number_format($sp['price']) ?> VNĐ
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include './views/layouts/footer.php'; ?>