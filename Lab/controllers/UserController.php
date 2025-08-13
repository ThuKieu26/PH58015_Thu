<?php
require_once "./models/UserModel.php";

class UserController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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
            $existingUser = $this->userModel->getUserByEmail($data['email']);
            if ($existingUser) {
                echo "<script>alert('Email đã tồn tại!'); window.location.href='index.php?act=dangky';</script>";
                //return;
                exit();
            }
            
            // Sửa lỗi: Gọi phương thức register() thay vì registerUser()
            // và truyền dữ liệu theo đúng định dạng mảng mà phương thức register() yêu cầu
            $result = $this->userModel->register($data);
            
            if ($result) {
                echo "<script>alert('Đăng ký thành công!'); window.location.href='index.php?act=dangnhap';</script>";
                //header("Location: index.php?act=dangnhap");
                exit();
            } else {
                echo "<script>alert('Đăng ký không thành công.'); window.location.href='index.php?act=dangky';</script>";
                exit();
            }
        }
        require_once "./views/dangky.php";
    }

    public function dangnhap()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;

                // THÊM LOGIC KIỂM TRA ROLE ĐỂ CHUYỂN HƯỚNG
                if ($user['role'] === 'admin') {
                    // Nếu là admin, chuyển hướng đến trang admin
                    header("Location: index.php?act=category-list"); 
                    exit();
                } else {
                    // Nếu là người dùng bình thường, chuyển hướng về trang chủ
                    header("Location: index.php");
                    exit();
                
                }
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
    public function list() {
        $users = $this->userModel->getAllUsers();
        include './views/admin/user/list.php';
    }
    public function showAddForm() {
        include './views/admin/user/adduser.php';
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'     => $_POST['username'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'role'     => $_POST['role'] ?? 'user'
            ];
            $existingUser = $this->userModel->getUserByEmail($data['email']);
            if ($existingUser) {
                echo "<script>alert('Email đã tồn tại!'); window.location.href='index.php?act=user-adduser';</script>";
                exit();
            }
            $result = $this->userModel->register($data);
            if ($result) {
                echo "<script>alert('Thêm người dùng thành công!'); window.location.href='index.php?act=user-list';</script>";
                exit();
            } else {
                echo "<script>alert('Thêm người dùng không thành công.'); window.location.href='index.php?act=user-adduser';</script>";
                exit();
            }
        } else {
            header("Location: index.php?act=user-adduser");
            exit();
        }
    }
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý dữ liệu khi form được gửi đi (POST)
            $id = $_POST['id'];
            $data = [
                'name'  => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'role'  => $_POST['role'] ?? ''
            ];
            // Nếu người dùng nhập mật khẩu mới, thì cập nhật
            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            $result = $this->userModel->updateUser($id, $data);
            if ($result) {
                echo "<script>alert('Cập nhật người dùng thành công!'); window.location.href='index.php?act=user-list';</script>";
                exit();
            } else {
                echo "<script>alert('Cập nhật người dùng không thành công.'); window.location.href='index.php?act=user-edit&id={$id}';</script>";
                exit();
            }
        } else {
            // Hiển thị form chỉnh sửa (GET)
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: index.php?act=user-list");
                exit();
            }
            $user = $this->userModel->getUserById($id);
            if (!$user) {
                echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?act=user-list';</script>";
                exit();
            }
            include './views/admin/user/edit.php';
        }
    }
    public function delete() {
        // Kiểm tra quyền admin trước khi thực hiện hành động
        checkAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "<script>alert('Không tìm thấy ID người dùng để xoá!'); window.location.href='index.php?act=user-list';</script>";
            exit();
        }
        // Không cho phép admin tự xóa chính mình
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id) {
            echo "<script>alert('Không thể tự xoá tài khoản của chính mình!'); window.location.href='index.php?act=user-list';</script>";
            exit();
        }
        $result = $this->userModel->deleteUser($id);
        if ($result) {
            echo "<script>alert('Xoá người dùng thành công!'); window.location.href='index.php?act=user-list';</script>";
            exit();
        } else {
            echo "<script>alert('Xoá người dùng không thành công!'); window.location.href='index.php?act=user-list';</script>";
            exit();
        }
    }
}
?>
