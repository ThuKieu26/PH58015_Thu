<?php include './views/layouts/header.php'; ?>
<h1 style="margin: 10px 600px;">Đăng ký</h1>
<form action="index.php?act=dangky" style="margin: 10px 600px;" method="post">
    <p>Tên người dùng</p>
    <input type="text" required name="username"><br>
    <p>Nhập email</p>
    <input type="text" required name="email"><br>
    <p>Mật khẩu</p>
    <input type="password" required name="password"><br>
    <button>Đăng ký</button>
</form>
<?php include './views/layouts/footer.php'; ?>