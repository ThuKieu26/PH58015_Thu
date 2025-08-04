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
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['user'])) {
        // Nếu chưa, lưu lại URL hiện tại và chuyển hướng đến trang đăng nhập
        $_SESSION['redirect_to'] = "index.php?act=products-detail&id=$id";
        header('Location: index.php?act=dangnhap');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $content = $_POST['comment_content'] ?? '';

    if (!empty($content)) {
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
    public function list()
    {
        // Kiểm tra quyền admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php");
            exit;
        }

        $keyword = $_GET['keyword'] ?? '';
        if ($keyword) {
            $data = $this->modelProduct->searchByName($keyword);
        } else {
            $data = $this->modelProduct->getAllProduct();
        }
        require_once './views/products/list.php';
    }

    // PHƯƠNG THỨC MỚI: Thêm sản phẩm
    public function add()
    {
        // Kiểm tra quyền admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php");
            exit;
        }
        
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
            ];
            $this->modelProduct->insertProduct($data);
            header("Location: index.php?act=product-list");
            exit;
        }
        require_once './views/products/add.php';
    }

    // PHƯƠNG THỨC MỚI: Sửa sản phẩm
    public function edit()
    {
        // Kiểm tra quyền admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php");
            exit;
        }
        
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?act=product-list");
            exit;
        }

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();
        $product = $this->modelProduct->getOneProduct($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
            ];
            $this->modelProduct->updateProduct($id, $data);
            header("Location: index.php?act=product-list");
            exit;
        }
        require_once './views/products/edit.php';
    }

    // PHƯƠNG THỨC MỚI: Xóa sản phẩm
    public function delete()
    {
        // Kiểm tra quyền admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php");
            exit;
        }

        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->modelProduct->deleteProduct($id);
        }
        header("Location: index.php?act=product-list");
        exit;
    }
    // PHƯƠNG THỨC MỚI: Chi tiết sản phẩm (Admin)
    public function detail()
    {
        // Kiểm tra quyền admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php");
            exit;
        }

        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?act=product-list");
            exit;
        }
        $product = $this->modelProduct->getOneProduct($id);
        require_once './views/products/detail.php';
    }
}
