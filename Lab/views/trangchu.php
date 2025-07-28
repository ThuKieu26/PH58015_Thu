<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.3/layout/css">
    <style>
        a{
            text-decoration: none;
        }
        .sanpham{
            display: grid;
            /* Thay đổi ở đây: cố định 4 cột với chiều rộng bằng nhau */
            grid-template-columns: repeat(5, 1fr); 
            gap: 20px;/*  Khoảng cách giữa các box */
            /* border: 1px solid black; */
        }
        .spham{
            width: 250px;
            height: 350px;
            border: 1px solid black;
            padding: 20px 30px;
        }
    </style>
</head>
<body>
    <form action="" method="GET">
        <input type="text" name="search_name" placeholder="Tìm kiếm sản phẩm theo tên" required>
        <button type="submit">Tìm kiếm</button>
    </form>
    <h3 style="margin: 10px 600px;">Danh sách sản phẩm:</h3>
    <div class="sanpham">
        <?php foreach ($products as $sp): ?>
            <div class="spham">
                    <a href="index.php?act=products-detail&id=<?= $sp['id'] ?>">
                        
                        <img src="<?= htmlspecialchars($sp['image']) ?>"  width="250px" height="300px"><br>
                        <?= $sp['name'] ?><br>
                        <?= number_format($sp['price']) ?> VNĐ
                    </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>