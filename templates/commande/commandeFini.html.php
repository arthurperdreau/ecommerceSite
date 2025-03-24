<div class="container my-5">
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                <h3 class="fw-bold text-primary">Commande n°<?php echo $commande->getId(); ?></h3>
                <span class="badge bg-success p-2">Commande confirmée ✅</span>
            </div>

            <?php if (!empty($panierAvecBonneQuantite)) { ?>
                <h4 class="mt-4">🛒 Contenu du panier :</h4>
                <?php foreach ($panierAvecBonneQuantite as $quantite => $value) { ?>
                    <div class="border border-secondary rounded p-3 my-2 d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= $value->getTitle(); ?></strong>
                            <p class="mb-0 text-muted">Prix unitaire : <?= number_format($value->getPrix(), 2); ?> €</p>
                        </div>
                        <span class="badge bg-primary p-2">Quantité : <?php echo $quantite; ?></span>
                        <strong class="text-success">Total : <?= number_format($quantite * $value->getPrix(), 2); ?> €</strong>
                    </div>
                <?php } ?>

                <div class="d-flex justify-content-between align-items-center mt-4 p-3 border-top">
                    <h4 class="fw-bold">💰 Total de la commande :</h4>
                    <h4 class="text-success fw-bold"><?= number_format($commande->getPrix(), 2); ?> €</h4>
                </div>

                <div class="mt-4 p-3 border rounded bg-light">
                    <h5 class="fw-bold">📍 Adresse de livraison :</h5>
                    <p class="mb-1"><?= $adresse->getAddress(); ?>, <?= $adresse->getCity(); ?> (<?= $adresse->getPostalCode(); ?>)</p>

                    <h5 class="fw-bold mt-3">💳 Carte de paiement :</h5>
                    <p>**** **** **** <?= substr($card->getCardNumber(), -4); ?></p>
                </div>

                <div class="text-center mt-4">
                    <a href="/" class="btn btn-primary btn-lg">
                        <i class="bi bi-house-door"></i> Retour à l'accueil
                    </a>
                </div>

            <?php } else { ?>
                <h3 class="text-center text-danger mt-4">Votre panier est vide ❌</h3>
            <?php } ?>
        </div>
    </div>
</div>
