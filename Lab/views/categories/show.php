<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #100e84ff;
            color: white;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<?php include './views/layouts/header.php'; ?>
<h2>Tất cả danh mục sản phẩm</h2>
<?php if (!empty($data)): ?>
    <table>
        <thead>
            <tr>
                <th>Danh mục</th>
                <th>Sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <?php if (!empty($item['products'])): ?>
                    <?php foreach ($item['products'] as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['category']['name']) ?></td>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><img src="<?= htmlspecialchars($p['image']) ?>" alt="" width="100px" height="100px"></td>
                            <td><?= number_format($p['price']) ?> VNĐ</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td><?= htmlspecialchars($item['category']['name']) ?></td>
                        <td colspan="2" style="text-align:center;">Không có sản phẩm nào</td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align: center;">Không có danh mục nào để hiển thị.</p>
<?php endif; ?>
<?php include './views/layouts/footer.php'; ?>
    
</body>
</html>



