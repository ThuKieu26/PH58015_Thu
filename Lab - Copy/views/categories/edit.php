<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>

    h2{
        text-align: center;
        margin: 20px;
    }
    form{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px;
    }
    form button{
        margin: 10px;
    }
</style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
<h2>Sửa danh mục</h2>
<form method="post">
    <input type="text" name="name" value="<?= $category['name'] ?>">
    <button type="submit">Cập nhật</button>
</form>
<a href="index.php?act=category-list">Quay lại</a>
<?php include './views/layouts/footer.php'; ?>    
</body>
</html>
