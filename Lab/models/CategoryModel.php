<?php
require_once "./commons/function.php";
class CategoryModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAll(){
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getProductsByCategory($id){
        $stmt = $this->conn->prepare("
            SELECT p.*, c.name as category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.category_id = ? 
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}