<?php
require_once "./models/UserModel.php";

class UserController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function dangky()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'  => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];

            // Sửa lỗi: Gọi phương thức login() thay vì getUserByEmail()
            $existingUser = $this->userModel->login($data['email']);
            if ($existingUser) {
                echo "<script>alert('Email đã tồn tại!'); window.location.href='index.php?act=dangky';</script>";
                return;
            }
            
            // Sửa lỗi: Gọi phương thức register() thay vì registerUser()
            // và truyền dữ liệu theo đúng định dạng mảng mà phương thức register() yêu cầu
            $result = $this->userModel->register($data);
            
            if ($result) {
                header("Location: index.php?act=dangnhap");
                exit();
            } else {
                echo "<script>alert('Đăng ký không thành công.'); window.location.href='index.php?act=dangky';</script>";
            }
        }
        require_once "./views/dangky.php";
    }

    public function dangnhap()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Sửa lỗi: Gọi phương thức login() thay vì getUserByEmail()
            $user = $this->userModel->login($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Email hoặc mật khẩu không đúng!'); window.location.href='index.php?act=dangnhap';</script>";
                exit();
            }
        }
        require_once "./views/dangnhap.php";
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
