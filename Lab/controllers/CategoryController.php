<?php
require_once "./models/CategoryModel.php";
class CategoryController{
    public $modelProduct;
    public function __construct(){
        $this->modelProduct= new CategoryModel();
    }
    public function Show(){
        $id = $_GET["id"] ?? null;
        if(!$id){
            echo "Không thấy danh mục";
            return; 
        }
        $products = $this->modelProduct->getProductsByCategory($id);
        require "./views/categories/show.php";
    }
}
?>