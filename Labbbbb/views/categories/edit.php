<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin: 20px;
    color: #121D4C;
}

form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px;
    gap: 10px;
    flex-wrap: wrap;
}

input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 250px;
    font-size: 14px;
}

input[type="text"]:focus {
    border-color: #121D4C;
    outline: none;
    box-shadow: 0 0 5px rgba(18, 29, 76, 0.5);
}

button {
    padding: 10px 20px;
    background-color: #121D4C;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background-color: #0d153a;
}

a {
    display: inline-block;
    margin: 20px 50px;
    color: #121D4C;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
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
