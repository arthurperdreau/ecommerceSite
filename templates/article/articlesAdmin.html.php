<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($articles as $article): ?>
        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4 class="card-title"><?= $article->getTitle() ?></h4>
                    <h5 class="text-success"><?= number_format($article->getPrix(), 2) ?> €</h5>
                    <h6><?= $article->getDescription() ?></h6>
                    <h6>Stock: <?= $article->getStock() ?></h6>
                    <a href="/article/update?id=<?= $article->getId() ?>" class="btn btn-warning w-100 mt-2">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>
                    <?php if($article->getActif()==1){ ?>
                    <a href="/article/retirer?id=<?= $article->getId() ?>" class="btn btn-danger w-100 mt-2">
                        <i class="bi bi-trash"></i> Désactiver
                    </a>
                    <?php }else{ ?>
                    <a href="/article/actif?id=<?= $article->getId() ?>" class="btn btn-success w-100 mt-2">
                        <i class="bi bi-plus-circle"></i> Réactiver
                    </a>
                    <?php }?>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
