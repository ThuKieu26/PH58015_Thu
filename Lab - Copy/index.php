<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/CategoryController.php';
require_once './controllers/UserController.php';
require_once './controllers/CartController.php';
// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/UserModel.php';
require_once './models/CommentModel.php';
// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

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
    'cart-add' => (new CartController())->addToCart(),
    'cart-list' => (new CartController())->listCart(),
    'cart-update' => (new CartController())->updateCart(),
    'cart-delete' => (new CartController())->deleteCart(),
};