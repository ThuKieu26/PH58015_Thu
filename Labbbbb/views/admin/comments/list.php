<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bình luận</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
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
    </style>
</head>
<body>
<?php 
include './views/layouts/header.php'; 
?>
<div class="container">
    <h1>Quản lý Bình luận</h1>
    <?php 
    // Hiển thị thông báo (nếu có)
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
                <th>Tên Người dùng</th>
                <th>Tên Sản phẩm</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= htmlspecialchars($comment['id']) ?></td>
                        <td><?= htmlspecialchars($comment['user_name']) ?></td>
                        <td><?= htmlspecialchars($comment['product_name']) ?></td>
                        <td><?= htmlspecialchars($comment['content']) ?></td>
                        <td><?= htmlspecialchars($comment['date']) ?></td>
                        <td>
                            <a class="action-link" href="index.php?act=comment-delete&id=<?= htmlspecialchars($comment['id']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Không có bình luận nào để hiển thị.</td>
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