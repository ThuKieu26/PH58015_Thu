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

    /**
     * Đăng ký người dùng mới vào cơ sở dữ liệu.
     * Mật khẩu sẽ được mã hóa bằng password_hash() để đảm bảo an toàn.
     *
     * @param array $data Mảng chứa thông tin người dùng (name, email, password, etc.).
     * @return bool Trả về true nếu đăng ký thành công, ngược lại là false.
     */
    public function register($data)
    {
        $sql = "INSERT INTO user (name, email, password, role, active, image)
                VALUES (:name, :email, :password, :role, :active, :image)";
        $stmt = $this->conn->prepare($sql);

        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $hashedPassword,
            'role'     => $data['role'] ?? 'user',
            'active'   => 1,
            'image'    => $data['image'] ?? null // Thêm cột image nếu có
        ]);
    }

    /**
     * Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên email.
     * Phương thức này được sử dụng để kiểm tra đăng nhập và xem email đã tồn tại chưa.
     *
     * @param string $email Email của người dùng.
     * @return array|false Trả về một mảng chứa thông tin người dùng nếu tìm thấy, ngược lại là false.
     */
    public function login($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên email.
     * Đây là một alias cho phương thức login() để tương thích với tên phương thức bạn đã dùng.
     *
     * @param string $email Email của người dùng.
     * @return array|false Trả về một mảng chứa thông tin người dùng nếu tìm thấy, ngược lại là false.
     */
    public function getUserByEmail($email)
    {
        return $this->login($email);
    }

    /**
     * Lấy thông tin người dùng từ cơ sở dữ liệu dựa trên ID.
     *
     * @param int $id ID của người dùng.
     * @return array|false Trả về một mảng chứa thông tin người dùng nếu tìm thấy, ngược lại là false.
     */
    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>