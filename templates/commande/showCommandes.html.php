<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">🛒 Vos Commandes</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($commandes as $commande):
            if ($commande->getValider() == 0):
                $adresse = $livraisonRepository->find(intval($commande->getAdresse()));
                $card = $paiementRepository->find(intval($commande->getCard()));
                $articles = $commande_articleRepository->findByCommandeId(intval($commande->getId()));
                ?>
                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column"> <!-- Flexbox pour aligner les boutons en bas -->
                        <div class="card-body flex-grow-1">
                            <h4 class="card-title text-center"><?= "Commande n°" . htmlspecialchars($commande->getId()) ?></h4>
                            <h5 class="text-success text-center">
                                💰 Prix : <?= number_format($commande->getPrix(), 2) ?> €
                            </h5>

                            <h5 class="fw-bold mt-3">📍 Adresse de livraison :</h5>
                            <p><?= htmlspecialchars($adresse->getAddress()) ?>,
                                <?= htmlspecialchars($adresse->getCity()) ?>
                                (<?= htmlspecialchars($adresse->getPostalCode()) ?>)
                            </p>

                            <h5 class="fw-bold mt-3">💳 Carte de paiement :</h5>
                            <p>**** **** **** <?= substr($card->getCardNumber(), -4); ?></p>

                            <h5 class="fw-bold mt-3">📦 Articles :</h5>
                            <ul class="list-group">
                                <?php if (empty($articles)): ?>
                                    <li class="list-group-item text-muted">Aucun article dans cette commande.</li>
                                <?php else: ?>
                                    <?php foreach ($articles as $article):
                                        $articleEntier = $articleRepository->find(intval($article->getArticleId()));
                                        ?>
                                        <li class="list-group-item">
                                            <strong><?= htmlspecialchars($articleEntier->getTitle()) ?></strong>
                                            <p class="mb-1"><?= htmlspecialchars($articleEntier->getDescription()) ?></p>
                                            <span class="">Quantité : <?= $article->getQuantite() ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between mt-auto">
                            <a class="btn btn-danger w-50" href="/annulerCommande/?id=<?= $commande->getId() ?>">Annuler</a>
                            <a class="btn btn-success w-50 ms-2" href="/validerCommande/?id=<?= $commande->getId() ?>">Valider</a>
                        </div>
                    </div>
                </div>
            <?php
            endif;
        endforeach;
        ?>
    </div>
</div>
