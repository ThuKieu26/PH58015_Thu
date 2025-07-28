<?php include './views/layouts/header.php'; ?>

<h1><?= $title ?></h1>
<h2><?= $thoiTiet ?></h2>
<form action="" method="get" style="margin: 10px 500px;">
    <input type="text" name="name" placeholder="Nhập tên sản phẩm" value="<?= isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>">
    <button type="submit">Tìm kiếm</button>
</form>
<h3 style="margin: 10px 600px;">Danh sách sản phẩm:</h3>
<ul style="margin: 10px 500px; list-style-type: none; text-decoration: none;">
    <?php foreach ($products as $sp): ?>

        <li>
            <a href="index.php?act=product-detail&id=<?= $sp['id'] ?>">
                <?= $sp['name'] ?> - <?= number_format($sp['price']) ?> VNĐ 
                - <img src="<?= BASE_URL . $sp['image'] ?>" alt="" width="100px" height="100px">
                <!-- - <img src="<?= BASE_URL . 'public/image/' . $sp['image'] ?>" alt="" width="100px" height="100px"> -->
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include './views/layouts/footer.php'; ?>