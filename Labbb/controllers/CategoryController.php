<?php
require_once "./models/CategoryModel.php";
require_once "./models/ProductModel.php";
class CategoryController{
    public $modelProduct;
    public function __construct(){
        $this->modelProduct= new CategoryModel();
    }
    public function Show(){
        $id = $_GET["id"] ?? null;
        if(!$id){
        $category = $this->modelProduct->getById($id);
        $products = $this->modelProduct->getProductsByCategory($id);
        require "./views/categories/show.php";
        }else{
            $categories = $this->modelProduct->getAll(); // Lấy tất cả danh mục
            $data = [];
            foreach ($categories as $category) {
                $products = $this->modelProduct->getProductsByCategory($category['id']);
                $data[] = [
                    'category' => $category,
                    'products' => $products
                ];
            }
            require "./views/categories/show.php";
        }
    }
    //truy xuất và hiển thị danh sách tất cả các danh mục
    public function List(){
        $data = $this->modelProduct->getAll();
        require "./views/categories/list.php";
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->modelProduct->insert($_POST["name"]);
            header("Location: index.php?act=category-list");
        }
        require "./views/categories/add.php";
    }
    public function delete(){
        $id = $_GET["id"] ?? null;
        if($id){
            $this->modelProduct->delete($id);
            header("Location: index.php?act=category-list");
        }
    }
    public function edit(){
        $id = $_GET["id"] ?? null;
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->modelProduct->update($id, $_POST["name"]);
            header("Location: index.php?act=category-list");
        }
        $category = $this->modelProduct->getById($id);
        require "./views/categories/edit.php";
    }
}
?>