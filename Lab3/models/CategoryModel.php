<?php
require_once "./commons/function.php";
class CategoryModel{
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAllCategories(){
        $sql = "select * from categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getCategoryByID($id){
        $sql = "select * from categories where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function getProductsByCategory($catId){
        $sql = "select * from products where category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$catId]);
        return $stmt->fetchAll();
    }
}

?>