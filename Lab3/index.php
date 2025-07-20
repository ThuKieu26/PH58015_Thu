<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/CategoryController.php';
// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
// Route
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

if ($act == '/') {
    (new ProductController())->Home();
} else if ($act == 'detail') {
    (new ProductController())->Detail();
} else if ($act == 'category') {
    (new CategoryController())->Show();
} else if ($act == 'dangky') {
    require './views/dangky.php';
} else if ($act == 'dangnhap') {
    require './views/dangnhap.php';
} else if ($act == 'gioithieu') {
    require './views/gioithieu.php';
} else if ($act == 'lienhe') {
    require './views/lienhe.php';
} else {
    echo "Không tìm thấy trang";
}