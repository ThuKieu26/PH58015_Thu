<?php
require_once './models/ProductModel.php';

class CartController
{
    public $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        // Khởi động session nếu chưa có
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addToCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?act=dangnhap');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id'] ?? 0);
            $quantity = intval($_POST['quantity'] ?? 1);

            if ($productId > 0 && $quantity > 0) {
                $product = $this->productModel->getOneProduct($productId);

                if ($product) {
                    // Nếu giỏ hàng chưa tồn tại trong session, tạo mới
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] += $quantity;
                    } else {
                        $_SESSION['cart'][$productId] = [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'image' => $product['image'],
                            'quantity' => $quantity,
                        ];
                    }
                }
            }
        }
        // Chuyển hướng người dùng về trang trước đó hoặc trang giỏ hàng
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function listCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?act=dangnhap');
            exit;
        }
        $cart = $_SESSION['cart'] ?? [];
        require_once './views/carts/list.php';
    }

    public function updateCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=dangnhap');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = intval($_POST['product_id'] ?? 0);
            $quantity = intval($_POST['quantity'] ?? 1);

            if ($productId > 0 && $quantity > 0) {
                if (isset($_SESSION['cart'][$productId])) {
                    $_SESSION['cart'][$productId]['quantity'] = $quantity;
                }
            }
        }
        header('Location: index.php?act=cart-list');
        exit;
    }

    public function deleteCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=dangnhap');
            exit;
        }
        
        $productId = intval($_GET['id'] ?? 0);
        if ($productId > 0 && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        header('Location: index.php?act=cart-list');
        exit;
    }
}
?>