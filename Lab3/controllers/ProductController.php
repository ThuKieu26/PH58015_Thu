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
        $title = "Đây là trang chủ nhé hahaa";
        $thoiTiet = "Hôm nay trời có vẻ là mưa";
        $products = $this->modelProduct->getAllProducts();
        require_once './views/trangchu.php';
    }
    public function Detail(){
        $id = $_GET['id'] ?? null;
        if($id){
            $product = $this->modelProduct->getProductByID($id);
            if($product){
                require_once "./views/detail.php";
            }else{
                require_once "Sản phẩm không tồn tại";
            }
        }else{
            echo"Không có ID sản phẩm này";
        }
    }
}
