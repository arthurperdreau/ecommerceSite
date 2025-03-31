<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">🛒 Vos Commandes</h2>
        <form action="/commandes" method="post" class="d-flex align-items-center">
            <label for="toutesCommandes" class="me-2">Toutes les commandes</label>
            <input type="checkbox" name="toutesCommandes" class="form-check-input"
                <?php echo $isChecked ? 'checked' : '';//-->pour cocher la check box ?>>
            <button class="submit btn btn-primary ms-2">Filtrer</button>
        </form>
    </div>
    <div class="w-100 d-flex justify-content-center align-items-center mb-4">
        <div class="card text-center shadow-sm w-50">
            <div class="card-body">
                <h3 class="card-title text-success fw-bold">
                    <i class="bi bi-wallet2 me-2"></i>Revenue Total: <?= number_format($chiffreAffaire, 2, ',', ' ') ?> €
                </h3>
                <p class="text-muted">Voici votre chiffre d'affaire total à ce jour</p>
            </div>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-2 g-4">

        <?php
        if(!$isChecked){
            foreach ($commandes as $commande) {
                if ($commande->getValider() == 0) {
                    $adresse = $livraisonRepository->find(intval($commande->getAdresse()));
                    $card = $paiementRepository->find(intval($commande->getCard()));
                    $articles = $commande_articleRepository->findByCommandeId(intval($commande->getId()));
                    ?>
                    <div class="col">
                        <div class="card shadow-sm h-100 d-flex flex-column">
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
                                    <?php
                                    if (empty($articles)) {
                                        ?>
                                        <li class="list-group-item text-muted">Aucun article dans cette commande.</li>
                                        <?php
                                    } else {
                                        foreach ($articles as $article) {
                                            $articleEntier = $articleRepository->find(intval($article->getArticleId()));
                                            ?>
                                            <li class="list-group-item">
                                                <strong><?= htmlspecialchars($articleEntier->getTitle()) ?></strong>
                                                <p class="mb-1"><?= htmlspecialchars($articleEntier->getDescription()) ?></p>
                                                <span class="">Quantité : <?= $article->getQuantite() ?></span>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="card-footer bg-white border-0 d-flex justify-content-between mt-auto">
                                <a class="btn btn-danger w-50" href="/annulerCommande/?id=<?= $commande->getId() ?>">Annuler</a>
                                <a class="btn btn-success w-50 ms-2" href="/validerCommande/?id=<?= $commande->getId() ?>">Valider</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        } else {
            foreach ($commandes as $commande) {
                if ($commande->getValider() == 0) {
                    $adresse = $livraisonRepository->find(intval($commande->getAdresse()));
                    $card = $paiementRepository->find(intval($commande->getCard()));
                    $articles = $commande_articleRepository->findByCommandeId(intval($commande->getId()));
                    ?>
                    <div class="col">
                        <div class="card shadow-sm h-100 d-flex flex-column">
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
                                    <?php
                                    if (empty($articles)) {
                                        ?>
                                        <li class="list-group-item text-muted">Aucun article dans cette commande.</li>
                                        <?php
                                    } else {
                                        foreach ($articles as $article) {
                                            $articleEntier = $articleRepository->find(intval($article->getArticleId()));
                                            ?>
                                            <li class="list-group-item">
                                                <strong><?= htmlspecialchars($articleEntier->getTitle()) ?></strong>
                                                <p class="mb-1"><?= htmlspecialchars($articleEntier->getDescription()) ?></p>
                                                <span class="">Quantité : <?= $article->getQuantite() ?></span>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="card-footer bg-white border-0 d-flex justify-content-between mt-auto">
                                <a class="btn btn-danger w-50" href="/annulerCommande/?id=<?= $commande->getId() ?>">Annuler</a>
                                <a class="btn btn-success w-50 ms-2" href="/validerCommande/?id=<?= $commande->getId() ?>">Valider</a>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $adresse = $livraisonRepository->find(intval($commande->getAdresse()));
                    $card = $paiementRepository->find(intval($commande->getCard()));
                    $articles = $commande_articleRepository->findByCommandeId(intval($commande->getId()));
                    ?>
                    <div class="col">
                        <div class="card shadow-sm h-100 d-flex flex-column bg-light text-muted" style="opacity: 0.6; filter: grayscale(100%);">
                            <div class="card-body flex-grow-1">
                                <h4 class="card-title text-center"><?= "Commande n°" . htmlspecialchars($commande->getId()) ?></h4>
                                <h5 class="text-success text-center">
                                    💰 Prix : <?= number_format($commande->getPrix(), 2) ?> €
                                </h5>

                                <div class="text-center my-2">
                                    <span class="badge bg-success fs-6">✅ Commande Validée</span>
                                </div>

                                <h5 class="fw-bold mt-3">📍 Adresse de livraison :</h5>
                                <p><?= htmlspecialchars($adresse->getAddress()) ?>,
                                    <?= htmlspecialchars($adresse->getCity()) ?>
                                    (<?= htmlspecialchars($adresse->getPostalCode()) ?>)
                                </p>

                                <h5 class="fw-bold mt-3">💳 Carte de paiement :</h5>
                                <p>**** **** **** <?= substr($card->getCardNumber(), -4); ?></p>

                                <h5 class="fw-bold mt-3">📦 Articles :</h5>
                                <ul class="list-group">
                                    <?php
                                    if (empty($articles)) {
                                        ?>
                                        <li class="list-group-item text-muted">Aucun article dans cette commande.</li>
                                        <?php
                                    } else {
                                        foreach ($articles as $article) {
                                            $articleEntier = $articleRepository->find(intval($article->getArticleId()));
                                            ?>
                                            <li class="list-group-item bg-light text-muted">
                                                <strong><?= htmlspecialchars($articleEntier->getTitle()) ?></strong>
                                                <p class="mb-1"><?= htmlspecialchars($articleEntier->getDescription()) ?></p>
                                                <span class="">Quantité : <?= $article->getQuantite() ?></span>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="card-footer bg-white border-0 d-flex justify-content-center mt-auto">
                                <a class="btn btn-danger w-100" href="/annulerCommande/?id=<?= $commande->getId() ?>">Annuler</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>
