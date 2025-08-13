<?php
require_once "./models/CommentModel.php";
class CommentController
{
    private $commentModel;

    public function __construct()
    {
        // Khởi tạo CommentModel
        $this->commentModel = new CommentModel();
    }

    public function list()
    {
        // Lấy danh sách tất cả các comments
        $comments = $this->commentModel->getAllComments();
        include 'views/admin/comments/list.php';
    }

    public function delete()
    {
        // Kiểm tra xem ID của comment có tồn tại không
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            try {
                // Gọi phương thức xóa comment từ Model
                $this->commentModel->deleteComment($id);
                // Đặt thông báo thành công
                $_SESSION['message'] = 'Xóa comment thành công.';
            } catch (Exception $e) {
                // Đặt thông báo lỗi nếu có
                $_SESSION['error'] = 'Lỗi: ' . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = 'Không tìm thấy ID comment để xóa.';
        }

        // Chuyển hướng người dùng về trang danh sách comments
        header('Location: index.php?act=comment-list');
        exit();
    }
    public function add() {var_dump($_POST);
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
        $productId = intval($_POST['product_id'] ?? 0);
        $content = trim($_POST['content'] ?? '');

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để bình luận.";
        } else {
            // Đã đăng nhập, tiến hành xử lý bình luận
            $userId = $_SESSION['user']['id'];

            if (!empty($content)) {
                try {
                    // Gọi phương thức addComment để lưu vào CSDL
                    $result = $this->commentModel->addComment($productId, $userId, $content);

                    if ($result) {
                        $_SESSION['message'] = "Bình luận của bạn đã được gửi thành công!";
                    } else {
                        $_SESSION['error'] = "Đã xảy ra lỗi khi gửi bình luận.";
                    }
                } catch (PDOException $e) {
                    $_SESSION['error'] = "Lỗi SQL: " . $e->getMessage();
                }
            } else {
                $_SESSION['error'] = "Bình luận không được để trống.";
            }
        }
        
        // Chuyển hướng người dùng sau khi xử lý xong
        header("Location: index.php?act=products-detail&id=$productId");
        exit();
    }
}}