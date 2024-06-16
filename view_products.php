<?php
global $pdo;
include 'db.php';

try {
    $stmt = $pdo->query('SELECT * FROM products');
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<style>
    body {
        background: url(https://wallscloud.net/img/resize/2160/1350/MM/2023-06-09-elvatis-1-59370.png) no-repeat center center fixed;
        background-size: cover;
    }
    .custom-button {
        background-color: #4CAF50;
        color: white;
    }
    .product-image {
        width: 150px;
        height: 200px;
        margin-right: 10px;
    }
</style>

<div class="container mt-5">
    <a href="index.php" class="btn custom-button mb-4">Back to Dashboard</a>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mt-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top product-image" alt="<?= htmlspecialchars($product['title']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['price']) ?> грн.</p>
                        <button type="button" class="btn custom-button" data-toggle="modal" data-target="#productModal<?= $product['id'] ?>">
                            Детально
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'modal.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

