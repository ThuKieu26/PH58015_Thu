<?php
require_once 'commons/function.php';

class CommentModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Thêm bình luận mới vào cơ sở dữ liệu
    public function addComment($productId, $userId, $content)
    {
        $currentDate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO comments (product_id, user_id, content, date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$productId, $userId, $content, $currentDate]);
    }

    // Lấy tất cả bình luận cho một sản phẩm cụ thể
    public function getCommentsByProductId($productId)
    {
        // Sử dụng JOIN để lấy tên người dùng cùng với nội dung bình luận
        $sql = "SELECT c.*, u.name as user_name 
                FROM comments c
                JOIN users u ON c.user_id = u.id
                WHERE c.product_id = ?
                ORDER BY c.date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Bổ sung: Lấy tất cả bình luận từ cơ sở dữ liệu
    public function getAllComments()
    {
        $sql = "SELECT c.*, p.name as product_name, u.name as user_name
                FROM comments c
                JOIN products p ON c.product_id = p.id
                JOIN users u ON c.user_id = u.id
                ORDER BY c.date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Bổ sung: Xóa một bình luận dựa trên ID
    public function deleteComment($id)
    {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}