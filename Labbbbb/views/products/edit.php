<h2>Sửa sản phẩm</h2>
<form method="post">
    <input type="text" name="name" value="<?= $product['name'] ?>"><br>
    <input type="number" name="price" value="<?= $product['price'] ?>"><br>
    <textarea name="description"><?= $product['description'] ?></textarea><br>

    <select name="category_id">
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Cập nhật</button>
</form>
