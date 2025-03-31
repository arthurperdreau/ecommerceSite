<div class="container my-5">
    <div class="d-flex">
        <a href="/" class="btn btn-outline-primary fs-4">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 text-center">
                <h2 class="fw-bold"><?= $article->getTitle() ?></h2>
                <p class="text-muted"><?= $article->getDescription() ?></p>

                <h4 class="text-success"><?= number_format($article->getPrix(), 2); ?> €</h4>

                <p class="<?= $article->getStock() > 0 ? 'text-success' : 'text-danger' ?> fw-bold">
                    Stock : <?= $article->getStock() ?>
                </p>

                <?php if ($article->getStock() > 0) { ?>
                    <form action="/article/add/" method="get" class="mt-3">
                        <input type="hidden" name="id" value="<?= $article->getId() ?>">

                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-bold">Quantité :</label>
                            <input type="number"  name="quantity" class="form-control text-center" value="1" min="1" max="<?= $article->getStock() ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-cart-plus"></i> Ajouter au panier
                        </button>
                    </form>
                <?php } else { ?>
                    <button class="btn btn-secondary btn-lg w-100 disabled">
                        <i class="bi bi-cart-x"></i> Rupture de stock
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
