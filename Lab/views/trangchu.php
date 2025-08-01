<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a{
            text-decoration: none;
        }
        .sanpham{
            width: 1450px;
            display: grid;
            /* Thay đổi ở đây: cố định 4 cột với chiều rộng bằng nhau */
            grid-template-columns: repeat(5, 1fr); 
            gap: -30px;/*  Khoảng cách giữa các box */
            margin: 20px 50px;
        }
        .spham{
            width: 265px;
            height: 350px;
            border: 1px solid black;
            padding: 20px;
            border: 1px solid black;
            margin-bottom: 20px;
            margin-left: 40px;
        }
        .spham a{
            color: #1A2A80;
        }
        form{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: aqua;
        }
        input{
            width: 900px;
            height: 40px;
        }
        button{
            width: 100px;
            height: 40px;
            margin: 10px;
        }
    </style>
</head>
<body>
<?php include './views/layouts/header.php'; ?>
    <form action="" method="GET">
        <input type="text" name="search_name" placeholder="Tìm kiếm sản phẩm theo tên" required>
        <button type="submit">Tìm kiếm</button>
    </form>
    <h1 style="margin: 10px 755px;">Sản phẩm</h1>
    <div class="sanpham">
        <?php foreach ($products as $sp): ?>
            <div class="spham">
                    <a href="index.php?act=products-detail&id=<?= $sp['id'] ?>">
                        
                        <img src="<?= htmlspecialchars($sp['image']) ?>"  width="220px" height="270px"><br>
                        <?= $sp['name'] ?><br>
                        <?= number_format($sp['price']) ?> VNĐ
                    </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php include './views/layouts/footer.php'; ?>
</body>
</html>