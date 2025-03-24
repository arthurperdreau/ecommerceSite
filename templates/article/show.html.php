<a href="/" class="btn fs-2"> < </a>
<div class="w-100 h-auto d-flex justify-content-center">
<div class="border border-dark justify-content-center d-flex flex-column align-items-center col-auto p-3 rounded">
    <h3><?=  $article->getTitle() ?></h3>
    <p><?=  $article->getDescription() ?></p>
    <p><?=  $article->getPrix() ?>€</p>
    <p>stock : <?=  $article->getStock() ?></p>
    <?php if ($article->getStock() > 0) { ?>
        <a href="/article/add/?id=<?= $article->getId() ?>" class="btn btn-primary">ajouter au panier</a>
    <?php } else { ?>
        <a href="#" class="btn btn-secondary disabled" aria-disabled="true">ajouter au panier</a>
    <?php } ?>


</div>
</div>