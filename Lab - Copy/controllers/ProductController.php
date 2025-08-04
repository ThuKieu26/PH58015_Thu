<?php
// có class chứa các function thực thi xử lý logic
require_once './models/CommentModel.php'; 
class ProductController
{
    public $modelProduct;
    public $commentModel;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
        $this->commentModel = new CommentModel();
    }

    public function Home()
    {
        // $title = "Đây là trang chủ nhé hahaa";
        // $thoiTiet = "Hôm nay trời có vẻ là mưa";
        $name = $_GET['search_name'] ?? '';
        if ($name != '') {
            $products = $this->modelProduct->searchByName($name); 
        } else {
            $products = $this->modelProduct->getAllProduct();
        }
        require_once './views/trangchu.php';
    }
    public function ProductDetail()
    {   
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = intval($_GET['id'] ?? 0);
        // Lấy ID sp -> đổi sang số nguyên, mặc định là 0 nếu không có hoặc không hợp lệ
        $product = null;
        $comments = [];//mảng chứa comment
        if ($id > 0) {
            $product = $this->modelProduct->getOneProduct($id);
            //getOneProduct() lấy chi tiết sản phẩm
            
            if($product){
                $comments = $this->commentModel->getCommentsByProductId($id);
            //lấy comment cho sp đó
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
            $userId = $_SESSION['user']['id'];
            $content = $_POST['comment_content'] ?? '';

            if (empty($content)) {
                $this->commentModel->addComment($id, $userId, $content);
                // Chuyển hướng lại trang chi tiết sản phẩm để tránh gửi lại form
                header("Location: index.php?act=products-detail&id=$id");
                exit;
            }
        }
        require_once './views/sanpham.php';
    }
    public function Gioithieu(){
        require_once "./views/gioithieu.php";
    }
    public function Dangnhap(){
        require_once "./views/dangnhap.php";
    }
    public function Dangky(){
        require_once "./views/dangky.php";
    }
    public function Lienhe(){
        require_once "./views/lienhe.php";
    }
}
