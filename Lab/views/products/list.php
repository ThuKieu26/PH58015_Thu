<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f8fb;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin: 20px 0;
    color: #0d47a1;
}

form {
    text-align: center;
    margin-bottom: 15px;
}

input[type="text"] {
    padding: 8px;
    width: 250px;
    border: 1px solid #1565c0;
    border-radius: 20px;
    outline: none;
    font-size: 14px;
}

button {
    padding: 8px 14px;
    background-color: #1565c0;
    border: none;
    border-radius: 20px;
    color: #fff;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0d47a1;
}

.btn-add {
    display: inline-block;
    margin-left: 200px;
    margin-bottom: 10px;
    padding: 8px 14px;
    background-color: #0d47a1;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.btn-add:hover {
    background-color: #08306b;
}

table {
    border-collapse: collapse;
    margin: auto;
    width: 90%;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

th, td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #1565c0;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9fbfd;
}

tr:hover {
    background-color: #e3f2fd;
}

img {
    border-radius: 4px;
    object-fit: cover;
}
</style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h2>Danh sách sản phẩm</h2>
<form method="GET">
    <input type="hidden" name="act" value="product-list">
    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Tìm</button>
</form>
<a href="index.php?act=product-add" style="margin-left: 200px;">Thêm sản phẩm mới</a>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th><th>Tên</th><th>Giá</th><th>Ảnh</th><th>Mô tả</th><th>Số lượng</th><Th>Lượt xem</Th><th>Giảm giá</th><th>Hành động</th>
    </tr>
    <?php foreach ($products as $sp): ?>
    <tr>
        <td><?= $sp['id'] ?></td>
        <td><?= $sp['name'] ?></td>
        <td><?= number_format($sp['price']) ?> VNĐ</td>
        <td><img src="<?= htmlspecialchars($sp['image']) ?>" width="100" height="150"></td>
        <td><?= $sp['description'] ?></td>
        <td><?= $sp['quantity'] ?></td>
        <td><?= $sp['view'] ?></td>
        <td><?= $sp['discount'] ?></td>
        <td>
            <a href="index.php?act=product-edit&id=<?= $sp['id'] ?>">Sửa</a> |
            <a href="index.php?act=product-delete&id=<?= $sp['id'] ?>" onclick="return confirm('Xoá?')">Xoá</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
