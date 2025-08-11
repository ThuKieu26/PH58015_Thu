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
    h2{
       margin: 10px 700px; 
    }
    .them{
        margin: 10px 550px;
        text-decoration: none;
    }
    table{
        width: 600px;
        margin-top: 7px;
        border-collapse: collapse;
        margin: 20px 550px;
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
    nav{
        text-align: center;
        margin: 20px;
    }
</style>    
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<div class="bang">
<h1>Chào mừng admin</h1>
<nav>
    <!-- <a href="index.php?act=category-list">Quản lý Danh mục</a> -->
    <a href="index.php?act=product-list">Quản lý Sản phẩm</a>
    <a href="index.php?act=comment-list">Quản lý Comment</a>
    <a href="index.php?act=user-list">Quản lý User</a>
</nav>
<h2>Quản lý danh mục</h2>
<a class="them" href="index.php?act=category-add">Thêm danh mục</a>
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
                <a href="index.php?act=category-delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá không?')">Xoá</a> 
                <!-- <a href="index.php?act=category&id=<?= $item['id'] ?>">Xem sản phẩm</a> -->
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
