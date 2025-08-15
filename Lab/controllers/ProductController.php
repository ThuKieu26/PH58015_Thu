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
            // Lấy thông tin sản phẩm
            $product = $this->modelProduct->getOneProduct($id);
            //Lấy danh sách bình luận sau khi xử lý POST (nếu có)
            $comments = $this->commentModel->getCommentsByProductId($id);
        }
        require_once './views/sanpham.php';
    }
    public function addComment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;
            $userId = $_SESSION['user']['id'] ?? 0; // Assuming user ID is stored in session
            $content = $_POST['content'] ?? '';

            if ($productId > 0 && $userId > 0 && !empty($content)) {
                $commentAdded = $this->commentModel->addComment($productId, $userId, $content);
                if ($commentAdded) {
                // Hiển thị thông báo thành công nếu thêm thành công
                $_SESSION['message'] = 'Bình luận của bạn đã được thêm.';
            } else {
                // Hiển thị thông báo lỗi nếu có vấn đề
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm bình luận. Vui lòng thử lại.';
            }
            } else {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin bình luận và đảm bảo bạn đã đăng nhập.';
            }
            header('Location: index.php?act=products-detail&id=' . $productId);
            exit();
        }
        require_once "./views/sanpham.php";
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
            $products = $this->modelProduct->searchByName($keyword);
        } else {
            $products = $this->modelProduct->getAllProduct();
        }
        require_once './views/products/list.php';
    }
    public function add()
{
    checkAdmin();
    $categoryModel = new CategoryModel();
    $categories = $categoryModel->getAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = './public/image/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $imagePath = $uploadDir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }

        $data = [
            'name' => $_POST['name'],
            'image' => $imagePath, // Lưu đường dẫn ảnh
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'quantity' => $_POST['quantity'],
            'view' => $_POST['views'],
            'discount' => $_POST['discount']
        ];
        $this->modelProduct->insertProduct($data);
        header("Location: index.php?act=product-list");
        exit;
    }
    require_once './views/products/add.php';
    }
    // Sửa sản phẩm
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
            $imagePath = $product['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload = './public/image';
            if (!is_dir($upload)) {
                mkdir($upload, 0777, true);
            }
            $imagePath = $upload . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'image' => $imagePath,
                'description' => $_POST['description'],
                'quantity' => $_POST['quantity'],
                'view' => $_POST['view'],
                'discount' => $_POST['discount'],
                'category_id' => $_POST['category_id'],
            ];
            $this->modelProduct->updateProduct($id, $data);
            header("Location: index.php?act=product-list");
            exit;
        }
        require_once './views/products/edit.php';
    }

    // Xóa sản phẩm
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
