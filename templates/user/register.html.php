<div class="container my-5">
    <h3 class="text-center mb-4">Inscription</h3>

    <div class="d-flex justify-content-center">
        <form class="form form-control:post d-flex flex-column col-md-6 col-12" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Identifiant</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Votre identifiant" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Votre mot de passe" required>
            </div>

            <button class="submit btn btn-primary mb-3">S'inscrire</button>

            <div class="d-flex justify-content-between">
                <a href="/login" class="text-center mb-3">Vous avez déjà un compte ?</a>
            </div>
            <a class="btn btn-secondary mb-3" href="/">Retour</a>
        </form>
    </div>
</div>
