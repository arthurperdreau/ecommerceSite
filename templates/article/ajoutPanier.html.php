<a href="/article/show/?id=<?= $article->getId() ?>" class="btn fs-2"> < </a>
<div class="w-100 h-auto d-flex justify-content-center">
<div class="border border-dark justify-content-center d-flex flex-column align-items-center col-auto p-3 rounded">
    <h2>Article bien ajouté au panier</h2>
    <h3><?=  $article->getTitle() ?></h3>
    <p><?=  $article->getDescription() ?></p>
    <p><?=  $article->getPrix() ?>€</p>
</div>
</div>