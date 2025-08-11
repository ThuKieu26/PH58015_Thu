<?php

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

        // Load view để hiển thị danh sách comments
        // Giả định thư mục views/admin/comments/list.php
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
}