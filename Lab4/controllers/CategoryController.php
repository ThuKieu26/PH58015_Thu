<?php
require_once "./models/CategoryModel.php";
class CategoryController{
    public $model;
    public function __construct(){
        $this->model = new CategoryModel();
    }
    public function Show(){
        $id = $_GET["id"] ?? null;
        if(!$id){
            echo "Không thấy danh mục";
            return; 
        }
        $products = $this->model->getProductsByCategory($id);
        require "./views/categories/show.php";
    }
    public function list(){
        $data = $this->model->getAll();
        require "./views/categories/list.php";
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->model->insert($_POST["name"]);
            header("Location: index.php?act=category-list");
        }
        require "./views/categories/add.php";
    }
    public function delete(){
        $id = $_GET["id"] ?? null;
        if($id){
            $this->model->delete($id);
            header("Location: index.php?act=category-list");
        }
    }
    public function edit(){
        $id = $_GET["id"] ?? null;
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->model->update($id, $_POST["name"]);
            header("Location: index.php?act=category-list");
        }
        $category = $this->model->getById($id);
        require "./views/categories/edit.php";
    }
}
?>