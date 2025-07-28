<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $model;

    public function __construct()
    {
        $this->model= new ProductModel();
    }

    public function Home()
    {
        $title = "Đây là trang chủ nhé hahaa";
        $thoiTiet = "Hôm nay trời có vẻ là mưa";
        $name = $_GET['name'] ?? '';
        if ($name != '') {
            $products = $this->model->searchByName($name); 
        } else {
            $products = $this->model->getAll();
        }
        //$products = $this->model->getAll();
        require_once './views/trangchu.php';
    }
    public function Detail(){
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "Không tìm thấy sản phẩm";
            return;
        }
        $product = $this->model->getByID($id);
        if(!$product){
            echo "Không tìm thấy sản phẩm";
            return;  
        }
        require_once "./views/products/detail.php";
    }
    public function list()
    {
        $keyword = $_GET['keyword'] ?? '';
        $data = $this->model->getAllWithCategory($keyword); 
        require './views/products/list.php';
    }

    public function add()
    {
        $categories = $this->model->getAllCategories(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->insert(
                $_POST['name'],
                $_POST['price'],
                $_POST['description'],
                $_POST['category_id']
            );
            header("Location: index.php?act=product-list");
        }
        require './views/products/add.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) $this->model->delete($id);
        header("Location: index.php?act=product-list");
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $product = $this->model->getById($id);
        $categories = $this->model->getAllCategories(); // lấy danh sách danh mục
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update(
                $id,
                $_POST['name'],
                $_POST['price'],
                $_POST['description'],
                $_POST['category_id']
            );
            header("Location: index.php?act=product-list");
        }
        require './views/products/edit.php';
    }
}
