<div class="container my-5">
    <div class="d-flex align-items-center mb-4">
        <a href="/profile" class="btn btn-outline-primary fs-4 me-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="mb-0">Ajouter une carte bancaire</h2>
    </div>

    <div class="card shadow-sm p-4">
        <form method="post">
            <div class="mb-3">
                <label for="cardName" class="form-label">Nom du titulaire</label>
                <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Ex: Jean Dupont" required>
            </div>

            <div class="mb-3">
                <label for="cardNumber" class="form-label">Numéro de carte</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                       placeholder="XXXX XXXX XXXX XXXX" required
                       pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cardExpiry" class="form-label">Date d'expiration</label>
                    <input type="text" class="form-control" id="cardExpiry" name="cardExpiry"
                           placeholder="MM/AA" required pattern="\d{2}/\d{2}" maxlength="5">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cardCvv" class="form-label">CVV</label>
                    <input type="password" class="form-control" id="cardCvv" name="cardCvv"
                           placeholder="XXX" required pattern="\d{3}" maxlength="3">
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-credit-card"></i> Ajouter la carte
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('cardNumber').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Supprime les lettres
        value = value.replace(/(\d{4})/g, '$1 ').trim(); // Ajoute un espace tous les 4 chiffres
        e.target.value = value.substring(0, 19); // Limite à 19 caractères (16 + 3 espaces)
    });
</script>
