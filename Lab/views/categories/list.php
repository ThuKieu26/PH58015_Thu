<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h2>Danh sách danh mục</h2>
<a href="index.php?act=category-add">Thêm danh mục</a>
<table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px;">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($data as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td>
                <a href="index.php?act=category-edit&id=<?= $item['id'] ?>">Sửa</a> |
                <a href="index.php?act=category-delete&id=<?= $item['id'] ?>" onclick="return confirm('Xoá?')">Xoá</a> |
                <a href="index.php?act=category&id=<?= $item['id'] ?>">Xem sản phẩm</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
