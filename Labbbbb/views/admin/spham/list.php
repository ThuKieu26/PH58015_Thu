<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h1{
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-link {
            color: red;
            text-decoration: none;
            margin-left: 5px;
        }
        .action-link:hover {
            text-decoration: underline;
        }
        .add-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .add-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
session_start();
include './views/layouts/header.php';
?>

<div class="container">
    <h1>Quản lý Sản phẩm</h1>
    <a href="index.php?act=product-add" class="add-link">Thêm sản phẩm mới</a>

    <?php
    if (isset($_SESSION['message'])): ?>
        <p style="color: green;"><?= $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?= $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><img src="<?= htmlspecialchars($product['image']) ?>" width="100" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                        <td><?= number_format($product['price']) ?> VNĐ</td>
                        <td>
                            <a class="action-link" href="index.php?act=product-edit&id=<?= htmlspecialchars($product['id']) ?>">Sửa</a>
                            <a class="action-link" href="index.php?act=product-delete&id=<?= htmlspecialchars($product['id']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Không có sản phẩm nào để hiển thị.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
include './views/layouts/footer.php';
?>

</body>
</html>