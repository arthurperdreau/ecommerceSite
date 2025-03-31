<div class="container my-5 text-center">
    <a href="/article/show/?id=<?= $article->getId() ?>" class="btn btn-outline-primary fs-4 mb-3">
        <i class="bi bi-arrow-left"></i> Retour au produit
    </a>

    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h2 class="text-success">
                <i class="bi bi-check-circle-fill"></i> Article ajouté au panier !
            </h2>

            <h3 class="mt-3"><?= htmlspecialchars($article->getTitle()) ?></h3>
            <p class="text-muted"><?= htmlspecialchars($article->getDescription()) ?></p>

            <h4 class="fw-bold"><?= number_format($article->getPrix(), 2) ?> € / unité</h4>

            <p class="mt-2 fw-bold">Quantité ajoutée : <span class="text-primary"><?= intval($quantite) ?></span></p>

            <h4 class="text-success fw-bold">
                Total : <?= number_format($article->getPrix() * intval($quantite), 2) ?> €
            </h4>
        </div>
    </div>

    <a href="/" class="btn btn-primary mt-4">
        <i class="bi bi-shop"></i> Continuer mes achats
    </a>
</div>
