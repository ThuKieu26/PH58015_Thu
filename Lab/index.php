<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/CategoryController.php';
require_once './controllers/UserController.php';
require_once './controllers/CommentController.php';
// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/UserModel.php';
require_once './models/CommentModel.php';
// Kiểm tra quyền admin cho các trang quản trị
function checkAdmin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: index.php?act=dangnhap");
        exit();
    }
}
// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    // Trang chủ
    '/'=>(new ProductController())->Home(),
    'products-detail'=>(new ProductController())->ProductDetail(),
    'gioithieu'=>(new ProductController())->Gioithieu(),
    'lienhe'=>(new ProductController())->lienhe(),
    //Đăng nhập, đăng ký
    'dangnhap'=>(new UserController())->dangnhap(),
    'dangky'=>(new UserController())->dangky(),
    'logout'=>(new UserController())->logout(),
    //Danh mục
    'categories'=>(new CategoryController())->Show(),
    'category-list'=>(new CategoryController())->list(),
    'category-add'=>(new CategoryController())->add(),
    'category-edit'=>(new CategoryController())->edit(),
    'category-delete'=>(new CategoryController())->delete(),
    // Giỏ hang
    // 'cart-add' => (new CartController())->addToCart(),
    // 'cart-list' => (new CartController())->listCart(),
    // 'cart-update' => (new CartController())->updateCart(),
    // 'cart-delete' => (new CartController())->deleteCart(),
    // quản lý sản phẩm
    'product-list'      => (new ProductController())->list(),
    'product-add'       => (new ProductController())->add(),
    'product-edit'      => (new ProductController())->edit(),
    'product-delete'    => (new ProductController())->delete(),
    'product-detail'    => (new ProductController())->detail(),
    // Quản lý comment
    'comment-list'    => (new CommentController())->list(), 
    'comment-delete'  => (new CommentController())->delete(),
    'comment-add'      => (new ProductController())->addComment(),
    //quản lý ng dùng
    'user-list'    => (new UserController())->list(), 
    'user-adduser' => (new UserController())->showAddForm(),
    'user-add'     => (new UserController())->add(),
    'user-edit'    => (new UserController())->edit(),
    'user-delete'  => (new UserController())->delete(),  
};