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
            'password' => $hashedPassword, //$data['password'],
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

    public function getUserByEmail($email)
    {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function findById($id)
    // {
    //     $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = ?");
    //     $stmt->execute([$id]);
    //     return $stmt->fetch();
    // }
    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Cập nhật thông tin người dùng
    public function updateUser($id, $data) {
        $sql = "UPDATE users SET name = :name, email = :email, role = :role";
        $params = [
            'name'  => $data['name'],
            'email' => $data['email'],
            'role'  => $data['role'],
            'id'    => $id
        ];
        
        // Nếu có mật khẩu mới, thêm vào câu lệnh SQL
        if (isset($data['password'])) {
            $sql .= ", password = :password";
            $params['password'] = $data['password'];
        }
        
        $sql .= " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>