<div class="d-flex w-100  align-items-center">
    <a href="/" class="btn fs-2"> < </a> <span class="fs-2">Mon compte</span>
</div>
<div class=" ">
    <h3>Mes moyens de paiment</h3>
    <?php if (!empty($moyenPaieement)) { ?>


    <?php } else { ?>
    <h4>Pas de moyen de paiement enregistré</h4>
    <?php } ?>
    <a href="profile/addPaiement" class="btn btn-primary mb-2">ajouter un moyen</a>

    <?php if (!empty($adresseLivraison)) { ?>


    <?php } else { ?>
        <h4>Pas d'adresse de livraison enregistrée</h4>
    <?php } ?>
    <a href="profile/adresse" class="btn btn-primary mb-2">ajouter une adresse</a>

</div>