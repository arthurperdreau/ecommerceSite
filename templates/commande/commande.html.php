<h3 class="text-center my-4">Paiement et Livraison</h3>

<div class="container">
    <form action=""  class="card p-4 shadow-sm" method="post">
        <div class="mb-3">
            <label for="credit_card" class="form-label">Sélectionner une carte de crédit</label>
            <select id="credit_card" name="creditCard" class="form-select" required>
                <?php foreach ($paiementRepository->getPaiementByUser($user) as $card) : ?>
                    <option value="<?= $card->getId() ?>">
                        **** **** **** <?= substr($card->getCardNumber(), -4) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="mb-3">
            <label for="address" class="form-label">Sélectionner une adresse de livraison</label>
            <select id="address" name="adresse" class="form-select" required>
                <?php foreach ($livraisonRepository->getLivraisonByUser($user) as $adresse) : ?>
                    <option value="<?= $adresse->getId() ?>">
                        <?= $adresse->getAddress() ?>, <?= $adresse->getCity() ?> (<?= $adresse->getPostalCode() ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="d-flex justify-content-between">
            <a href="/panier" class="btn btn-secondary">Retour</a>
            <button class="btn btn-primary submit">Payer</button>
        </div>
    </form>
</div>
