<h1>Les articles</h1>
<div class="d-flex flex-wrap justify-content-center">
<?php foreach ($articles as $article): ?>
    <div class="border border-dark col-3 m-2 p-2 rounded">
        <h3><?=  $article->getTitle() ?></h3>
        <p><?=  $article->getPrix() ?>€</p>
        <a href="/article/show?id=<?= $article->getId() ?>" class="btn btn-primary">Voir</a>

    </div>
<?php endforeach; ?>
</div>
