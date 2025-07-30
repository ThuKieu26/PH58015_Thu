<h2>Thêm sản phẩm</h2>
<form method="post">
    <input type="text" name="name" placeholder="Tên sản phẩm"><br>
    <input type="number" name="price" placeholder="Giá"><br>
    <textarea name="description" placeholder="Mô tả"></textarea><br>

    <select name="category_id">
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Thêm</button>
</form>
