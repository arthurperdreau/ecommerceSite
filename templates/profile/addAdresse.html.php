<div class="container my-5">
    <div class="d-flex align-items-center mb-4">
        <a href="/profile" class="btn btn-outline-primary fs-4 me-3">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="mb-0">Ajouter une adresse</h2>
    </div>

    <div class="card shadow-sm p-4">
        <form method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Nom et prénom</label>
                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Ex: Jean Dupont" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Ex: 123 rue de Paris" required>
            </div>

            <div class="row">
                <div class="col-md-7 mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Ex: Lyon" required>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="postalCode" class="form-label">Code postal</label>
                    <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Ex: 69000" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-plus-lg"></i> Ajouter l'adresse
            </button>
        </form>
    </div>
</div>
