<?php
// Tệp này giả định rằng bạn có một tệp 'commons/function.php' để xử lý kết nối cơ sở dữ liệu.
require_once 'commons/function.php';

class UserModel
{
    public $conn;

    public function __construct()
    {
        // Khởi tạo kết nối cơ sở dữ liệu
        $this->conn = connectDB();
    }

    public function register($data)
    {
        $sql = "INSERT INTO users (name, email, password, role)
                VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);

        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $hashedPassword,
            'role'     => $data['role'] ?? 'user'
        ]);
    }

    public function login($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    // public function getUserByEmail($email)
    // {
    //     return $this->login($email);
    // }

    // public function findById($id)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = ?");
    //     $stmt->execute([$id]);
    //     return $stmt->fetch();
    // }
}
?>