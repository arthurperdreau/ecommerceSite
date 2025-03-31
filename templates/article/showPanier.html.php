<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-3">
                <a href="/" class="btn btn-outline-primary fs-4">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h2 class="ms-3">Votre panier</h2>
            </div>

            <?php if (!empty($panierDecompose)) { ?>
                <?php foreach ($panierDecompose as $quantite => $value) { ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1"><?= $value->getTitle() ?></h5>
                                <p class="mb-0 text-muted">Prix unitaire : <?= number_format($value->getPrix(), 2); ?> €</p>
                                <p class="mb-0">Quantité : <strong><?= $quantite; ?></strong></p>
                                <p class="text-success fw-bold">Total : <?= number_format($quantite * $value->getPrix(), 2); ?> €</p>
                            </div>
                            <a href="/panier/delete/?id=<?= $value->getId() ?>" class="text-danger fs-4">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-warning text-center">
                    <h4>Votre panier est vide 🛒</h4>
                </div>
            <?php } ?>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg p-3">
                <div class="card-body">
                    <h3 class="fw-bold mb-3">🛍️ Récapitulatif</h3>

                    <?php $total = 0;
                    if (!empty($panierDecompose)) {
                        foreach ($panierDecompose as $quantite => $value) {
                            $total += floatval($value->getPrix()) * floatval($quantite);
                        }
                    } ?>

                    <h4 class="text-success">Total : <?= number_format($total, 2); ?> €</h4>

                    <div class="d-grid mt-4">
                        <a href="/panier/commande" class="btn btn-primary btn-lg">
                            <i class="bi bi-cart-check"></i> Passer la commande
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
