<div class="container my-5">
    <div class="d-flex align-items-center mb-4">
        <a href="/" class="btn btn-outline-primary fs-4 me-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="mb-0">Mon compte</h2>
    </div>

    <?php if(isset($_SESSION["user"])): ?>
        <div class="row">
            <div class="col-md-6">
                <h3>💳 Mes moyens de paiement</h3>
                <?php foreach ($paiementRepository->getPaiementByUser($user) as $card): ?>
                    <div class="card shadow-sm p-3 mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?= $card->getCardName() ?></p>
                                <p class="text-muted mb-1">**** **** **** <?= substr($card->getCardNumber(), -4) ?></p>
                                <p class="text-muted">Expire le <?= $card->getCardExpiry() ?></p>
                            </div>
                            <a href="/profile/deletePaiement/?id=<?= $card->getId() ?>" class="text-danger">
                                <i class="bi bi-trash fs-4"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <a href="/profile/addPaiement" class="btn btn-success mt-2">
                    <i class="bi bi-plus-lg"></i> Ajouter un moyen
                </a>
            </div>

            <div class="col-md-6">
                <h3>📦 Mes adresses de livraison</h3>
                <?php foreach ($livraisonRepository->getLivraisonByUser($user) as $adresse): ?>
                    <div class="card shadow-sm p-3 mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?= $adresse->getFullName() ?></p>
                                <p class="text-muted mb-1"><?= $adresse->getAddress() ?>, <?= $adresse->getCity() ?></p>
                                <p class="text-muted">Code postal : <?= $adresse->getPostalCode() ?></p>
                            </div>
                            <a href="/profile/deleteAdresse/?id=<?= $adresse->getId() ?>" class="text-danger">
                                <i class="bi bi-trash fs-4"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <a href="/profile/addAdresse" class="btn btn-success mt-2">
                    <i class="bi bi-plus-lg"></i> Ajouter une adresse
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center">
            <h3>🚪 Vous devez être connecté.</h3>
            <a href="/login" class="btn btn-primary mt-3">
                <i class="bi bi-box-arrow-in-right"></i> Se connecter
            </a>
        </div>
    <?php endif; ?>
</div>
