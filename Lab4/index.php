<?php
require_once './commons/env.php';
require_once './commons/function.php';

// Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';

// Controllers
require_once './controllers/ProductController.php';
require_once './controllers/CategoryController.php';

// Route
$act = $_GET['act'] ?? '/';

$controllerProduct = new ProductController();
$controllerCategory = new CategoryController();

switch ($act) {
    case '/':
        $controllerProduct->Home();
        break;

    case 'product-detail':
        $controllerProduct->Detail();
        break;

    case 'category':
        $controllerCategory->show();
        break;

    case 'gioithieu':
    case 'lienhe':
    case 'dangky':
    case 'dangnhap':
        require "./views/{$act}.php";
        break;

    case 'category-list':
        $controllerCategory->list();
        break;
    case 'category-add':
        $controllerCategory->add();
        break;
    case 'category-edit':
        $controllerCategory->edit();
        break;
    case 'category-delete':
        $controllerCategory->delete();
        break;

    case 'product-list':
        $controllerProduct->list();
        break;
    case 'product-add':
        $controllerProduct->add();
        break;
    case 'product-edit':
        $controllerProduct->edit();
        break;
    case 'product-delete':
        $controllerProduct->delete();
        break;

    default:
        echo "Không tìm thấy trang";
        break;
}
