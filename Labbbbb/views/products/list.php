<?php include './views/layouts/header.php'; ?>

<h2>Danh sách sản phẩm</h2>

<form method="GET">
    <input type="hidden" name="act" value="product-list">
    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Tìm</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th><th>Tên</th><th>Giá</th><th>Hành động</th>
    </tr>
    <?php foreach ($data as $sp): ?>
    <tr>
        <td><?= $sp['id'] ?></td>
        <td><?= $sp['name'] ?></td>
        <td><?= number_format($sp['price']) ?> VNĐ</td>
        <td>
            <a href="index.php?act=product-edit&id=<?= $sp['id'] ?>">Sửa</a> |
            <a href="index.php?act=product-delete&id=<?= $sp['id'] ?>" onclick="return confirm('Xoá?')">Xoá</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="index.php?act=product-add">+ Thêm mới sản phẩm</a>

<?php include './views/layouts/footer.php'; ?>
