<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       
h1 {
    text-align: center;
    color: #121D4C;
    margin-top: 20px;
}
table {
    width: 800px;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    background-color: white;
    border-radius: 6px;
    overflow: hidden;
}
table th {
    background-color: #324ec9ff;
    color: white;
    height: 38px;
    text-align: left;
    padding-left: 10px;
}
table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}
table tr:nth-child(even) {
    background-color: #f7f9fc;
}
table tr:nth-child(odd) {
    background-color: #eef3f9;
}
table tr:hover {
    background-color: #dce4f2;
}
td a {
    background: #ff4d4d;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-decoration: none;
    transition: 0.3s;
}
td a:hover {
    background: #d93636;
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
<a href="index.php?act=category-list" style="margin: 20px 450px;">Quay lại</a><br>
<?php include './views/layouts/footer.php'; ?>
    
</body>
</html>