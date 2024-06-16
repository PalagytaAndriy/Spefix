<?php
global $pdo;
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $stmt = $pdo->prepare('INSERT INTO products (title, description, price, image) VALUES (?, ?, ?, ?)');
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['price'], $_POST['image']]);
    } elseif (isset($_POST['delete_product'])) {
        $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$_POST['id']]);
    }
}

$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('https://wallscloud.net/img/resize/2160/1350/MM/2023-06-09-elvatis-1-59370.png') no-repeat center center fixed;
            background-size: cover;
        }
        .custom-button {
            background-color: #4CAF50;
            color: white;
        }
        .product-image {
            width: 50px;
            height: 75px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Product Dashboard</h1>

    <button type="button" class="btn custom-button mb-4" data-toggle="modal" data-target="#addProductModal">
        Add New Product
    </button>

    <a href="view_products.php" class="btn custom-button mb-4">View Products</a>

    <h2>Existing Products</h2>
    <ul class="list-group mb-4">
        <?php foreach ($products as $product): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="product-image">
                <?= htmlspecialchars($product['title']) ?>
                <form method="post" class="mb-0">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button type="submit" name="delete_product" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="modal" id="addProductModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Add New Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image URL</label>
                        <input type="text" class="form-control" id="image" name="image" required>
                    </div>
                    <button type="submit" name="add_product" class="btn custom-button">Add Product</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
