<?php include './views/layouts/header.php'; ?>
<h1 style="margin: 10px 600px;" method="post">Đăng nhập</h1>
<form action="index.php?act=dangnhap" style="margin: 10px 600px;">
    <p>Email</p>
    <input type="text" name="email" placeholder="Nhập Email"><br>
    <p>Mật khẩu</p>
    <input type="password" name="password" placeholder="Mật khẩu"><br>
    <button>Đăng nhập</button>
</form>
<?php include './views/layouts/footer.php'; ?>