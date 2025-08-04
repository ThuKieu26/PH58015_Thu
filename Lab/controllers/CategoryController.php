<?php
require_once "./models/CategoryModel.php";
require_once "./models/ProductModel.php";
class CategoryController{
    public $modelCategory;
    public function __construct(){
        $this->modelCategory= new CategoryModel();
    }
    public function Show(){
        $id = $_GET["id"] ?? null;
        $data = [];
        if($id){ //Hiển thị sản phẩm của một danh mục cụ thể
            $category = $this->modelCategory->getById($id);
            if ($category) {
                $products = $this->modelCategory->getCategorysByCategory($id);
                $data[] = [
                    'category' => $category,
                    'products' => $products
                ];
            }
        } else { //Hiển thị TẤT CẢ danh mục và sản phẩm của chúng
            $categories = $this->modelCategory->getAll();
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $products = $this->modelCategory->getCategorysByCategory($category['id']);
                    $data[] = [
                        'category' => $category,
                        'products' => $products
                    ];
                }
            }
        }
        
        require "./views/categories/show.php";
    }
    //truy xuất và hiển thị danh sách tất cả các danh mục
    public function List(){
        $data = $this->modelCategory->getAll();
        require "./views/categories/list.php";
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->modelCategory->insert($_POST["name"]);
            header("Location: index.php?act=category-list");
        }
        require "./views/categories/add.php";
    }
    public function delete(){
        $id = $_GET["id"] ?? null;
        if($id){
            $this->modelCategory->delete($id);
            header("Location: index.php?act=category-list");
        }
    }
    public function edit(){
        $id = $_GET["id"] ?? null;
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->modelCategory->update($id, $_POST["name"]);
            header("Location: index.php?act=category-list");
        }
        $category = $this->modelCategory->getById($id);
        require "./views/categories/edit.php";
    }
}
?>