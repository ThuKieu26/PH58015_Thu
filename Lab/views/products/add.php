<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f8fb;
    color: #333;
}

h2 {
    text-align: center;
    margin: 20px 0;
    color: #0d47a1;
}

form {
    max-width: 500px;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #1565c0;
    border-radius: 4px;
    font-size: 14px;
}

textarea {
    height: 100px;
    resize: vertical;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #1565c0;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0d47a1;
}
    </style>
</head>
<body>
    <?php include './views/layouts/header.php'; ?>
    <h2>Thêm sản phẩm</h2>
    <form method="post">
        <label for="name">Tên sản phẩm</label>
        <input type="text" name="name" placeholder="Tên sản phẩm"><br>
        
        <label for="price">Giá</label>
        <input type="number" name="price" placeholder="Giá"><br>

        <label for="image">Ảnh sản phẩm</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        
        <label for="description">Mô tả</label>
        <textarea name="description" placeholder="Mô tả"></textarea><br>
        
        <label for="quantity">Số lượng</label>
        <input type="number" id="quantity" name="quantity" placeholder="Nhập số lượng" required>

        <label for="views">Lượt xem</label>
        <input type="number" id="views" name="views" placeholder="Nhập lượt xem" value="0" required>

        <label for="discount">Giảm giá (%)</label>
        <input type="number" id="discount" name="discount" placeholder="Nhập giảm giá" value="0" required>
            <select name="category_id">
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Thêm</button>
    </form>
</body>
</html>
