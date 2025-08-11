<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
            text-align: center;
        }
        table{
            width: 800px;
            margin-top: 7px;
            border-collapse: collapse;
            margin: 20px 450px;
        }
        table tr th{
            height: 28px;
            padding-left: 5px;
            color: white;
        }
        table tr td{
            height: 25px;
            padding-left: 20px;
        }
        table tr:nth-child(2n+1){
            background-color: #d2e3f2;
        }
        table tr:nth-child(2n){
            background-color: #f7f7e9;
        }
        table tr:nth-child(1){
            background-color: #387df4;
            height: 38px;
        }
    </style>
</head>
<body>

<?php include './views/layouts/header.php'; ?>
<h1>Quản lý người dùng</h1>
<a href="index.php?act=user-adduser" style="margin: 20px 450px;">Thêm người dùng mới</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên người dùng</th>
        <th>Email</th>
        <th>Quyền</th>
        <th>Hành động</th>
    </tr>
    <?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo htmlspecialchars($user['id']); ?></td>
        <td><?php echo htmlspecialchars($user['name']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo htmlspecialchars($user['role']); ?></td>
        <td>
            <a href="index.php?act=user-edit&id=<?php echo htmlspecialchars($user['id']); ?>">Sửa</a> |
            <a href="index.php?act=user-delete&id=<?php echo htmlspecialchars($user['id']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xoá</a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <tr>
        <td colspan="5">Không có người dùng nào.</td>
    </tr>
    <?php endif; ?>
</table>
<?php include './views/layouts/footer.php'; ?>
    
</body>
</html>