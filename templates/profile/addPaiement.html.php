<h3 class="mt-3">Ajouter un moyen de paiement</h3>
<?php var_dump($_SESSION); ?>
<div class="">
    <form method="post" class="form form-control:post">
        <div class="form-group">
            <label for="cardName">Nom du titulaire</label>
            <input type="text" class="form-control"  placeholder="Nom du titulaire" name="cardName">
        </div>

        <div class="form-group">
            <label for="cardNumber">Numéro de carte</label>
            <input type="text" class="form-control"  placeholder="XXXX XXXX XXXX XXXX"  name="cardNumber">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cardExpiry">Date d'expiration</label>
                <input type="text" class="form-control"  placeholder="MM/AA"  name="cardExpiry">
            </div>

            <div class="form-group col-md-6">
                <label for="cardCvv">CVV</label>
                <input type="text" class="form-control"  placeholder="XXX"  name="cardCvv">
            </div>
        </div>

        <button class="btn btn-primary mt-2 submit">Ajouter la carte</button>
    </form>
</div>
