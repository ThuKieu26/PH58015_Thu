<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <img src="public/image/logo.jpg" width="60px" height="60px">
        <nav>
            <a href="index.php">Trang chủ</a>
            <a href="index.php?act=dangnhap">Đăng nhập</a>
            <a href="index.php?act=dangky">Đăng ký</a>
            <a href="index.php?act=gioithieu">Giới thiệu</a>
            <a href="index.php?act=lienhe">Liên hệ</a>
            <a href="index.php?act=logout" onclick="return confirm ('Bạn có chắc chắn muốn đăng xuất k')">Đăng xuất</a>
            <?php
// Kiểm tra xem người dùng đã đăng nhập và có quyền admin không
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
?>
    <a href="index.php?act=category-list">Quản lý Danh mục</a>
    <a href="index.php?act=user-list">Quản lý User</a>
    <a href="index.php?act=product-list">Quản lý Sản phẩm</a>
    <a href="index.php?act=comment-list">Quản lý Bình luận</a>

<?php
}
?>
<a href="#" class="cart">
    <img src="public/image/giohang.png" width="60px" height="60px" style="margin-right: 20px;">
</a>
        </nav>
    </header>
<hr>