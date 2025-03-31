<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">🛒 Nos Articles</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($articles as $article){
            if($article->getActif()==1){?>
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h4 class="card-title"><?= $article->getTitle() ?></h4>
                            <h5 class="text-success"><?= number_format($article->getPrix(), 2) ?> €</h5>
                            <a href="/article/show?id=<?= $article->getId() ?>" class="btn btn-primary w-100">
                                <i class="bi bi-eye"></i> Voir le produit
                            </a>
                        </div>
                    </div>
                </div>
        <?php }}; ?>
    </div>
</div>
