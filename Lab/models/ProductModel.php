<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách sản phẩm 
    public function getAllcategories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // lấy tất cả sản phẩm, JOIN với bảng categories để lấy tên danh mục và hỗ trợ tìm kiếm sản phẩm theo tên
    public function getAllWithCategory($name = '')
    {
        $sql = "SELECT p.*, c.name as category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id";
        if ($name) {
            $sql .= " WHERE p.name LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["%$name%"]);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }
    public function getAllProduct() {
    $sql = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    //truy vấn cơ sở dữ liệu để lấy thông tin của một sản phẩm cụ thể
    public function getOneProduct($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function searchByName($name) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name LIKE ?");
        $search = "%" . $name . "%";
        $stmt->execute([$search]); 
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }
    //Thêm sản phẩm
    public function insertProduct($data) {
        $sql = "INSERT INTO products (name, price, description, quantity, view, discount, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['name'], $data['price'], $data['description'], $data['quantity'], $data['view'], $data['discount'], $data['category_id']]);
    }

    //Cập nhật sản phẩm
    public function updateProduct($id, $data) {
        $sql = "UPDATE products SET name = ?, price = ?, image = ?, description = ?, quantity = ?, view = ?, discount = ?, category_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['name'], $data['price'], $data['image'], $data['description'], $data['quantity'], $data['view'], $data['discount'], $data['category_id'], $id]);
    }

    //Xóa sản phẩm
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}