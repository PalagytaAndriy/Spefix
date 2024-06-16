<?php global $products;


foreach ($products as $product): ?>

    <div class="modal fade" id="productModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= htmlspecialchars($product['title']) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= htmlspecialchars($product['image']) ?>" class="img-fluid mb-3" alt="<?= htmlspecialchars($product['title']) ?>">
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <p>Price: <?= htmlspecialchars($product['price']) ?> грн.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>



