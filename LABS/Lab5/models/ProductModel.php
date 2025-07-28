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
    public function getAllWithCategory($keyword = '')
    {
        $sql = "SELECT p.*, c.name as category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id";
        if ($keyword) {
            $sql .= " WHERE p.name LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["%$keyword%"]);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }

    public function getAll($keyword = '')
    {
        if ($keyword) {
            $stmt = $this->conn->prepare("
            SELECT * FROM products 
            WHERE name LIKE ? 
            OR id = ? 
            OR price LIKE ?
        ");
            $stmt->execute(['%' . $keyword . '%', $keyword, '%' . $keyword . '%']);
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM products");
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }


    public function insert($name, $price, $desc, $catId)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (name, price, description, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $price, $desc, $catId]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $name, $price, $desc, $catId)
    {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, price = ?, description = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $desc, $catId, $id]);
    }
}
