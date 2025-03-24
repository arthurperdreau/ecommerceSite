<div class="d-flex w-100 justify-content-between align-items-center">
    <a href="/" class="btn fs-2"> < </a>
</div>
<div class="w-100 h-auto d-flex">
<div class="w-75 h-auto d-flex justify-content-center flex-column align-items-center">
    <?php if (!empty($panierDecompose)) { ?>
        <h3>Contenu du panier :</h3><br>
        <?php foreach ($panierDecompose as $quantite => $value) { ?>
            <div class="border border-dark justify-content-center d-flex  align-items-center col-auto p-3 rounded mb-2">
                <span class="me-3"><?= $value->getTitle() ?></span>
                <span class="me-3">Prix : <?= $value->getPrix() . " €" ?></span>
                <span class="">Quantité :<?php echo $quantite; ?></span>
                <?php //var_dump($panierDecompose)?>
                <a href="/panier/delete/?id=<?= $value->getId() ?>" ><i class="bi bi-trash ms-2"></i></a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <h3>Panier vide</h3>
    <?php } ?>
</div>
<div class="w-25">
    <?php if (!empty($panierDecompose)) { ?>
        <h3>Informations sur la commande :</h3><br>
        <?php $total=0;foreach ($panierDecompose as $quantite => $value) {
            $total+=floatval($value->getPrix())*floatval($quantite);
        } ?>
    <?php } else { $total=0; }?>
    <h4>Total : <?= $total ?>€</h4>
    <a href="/panier/commande" class="btn btn-primary "> commander</a>
</div>
</div>
