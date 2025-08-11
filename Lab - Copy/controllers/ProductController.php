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
        $product = null;
        $comments = [];

        if ($id > 0) {
            // Xử lý bình luận
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
                if (isset($_SESSION['user'])) {
                    $userId = $_SESSION['user']['id'];
                    $content = $_POST['content'] ?? ''; // Chú ý: tên trường là 'content'
                    if (!empty($content)) {
                        $this->commentModel->addComment($id, $userId, $content);
                    }
                }
                header("Location: index.php?act=products-detail&id=$id");
                exit();
            }

            // Lấy thông tin sản phẩm
            $product = $this->modelProduct->getOneProduct($id);
            
            //Lấy danh sách bình luận sau khi xử lý POST (nếu có)
            $comments = $this->commentModel->getCommentsByProductId($id);
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
    //Chi tiết sản phẩm (Admin)
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
        if (!$product) {
            echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href='index.php?act=product-list';</script>";
            exit;
        }
        require_once './views/products/detail.php';
    }
}
