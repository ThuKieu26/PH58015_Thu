<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
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
        $id = intval($_GET['id'] ?? 0);
        // Lấy ID sp -> đổi sang số nguyên, mặc định là 0 nếu không có hoặc không hợp lệ
        $product = null;
        if ($id > 0) {
            $product = $this->modelProduct->getOneProduct($id);
            //getOneProduct() lấy chi tiết sản phẩm
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
