<?php include './views/layouts/header.php'; ?>
<h1 style="margin: 10px 600px;">Đăng ký</h1>
<form action="" style="margin: 10px 600px;">
    <p>Tên người dùng</p>
    <input type="text" required><br>
    <p>Mật khẩu</p>
    <input type="password" required><br>
    <p>Tuổi</p>
    <input type="number" min="16" required><br>
    <p>Nhập email</p>
    <input type="text" required><br>
    <button>Đăng ký</button>
</form>
<?php include './views/layouts/footer.php'; ?>