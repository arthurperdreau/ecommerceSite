<div class="container my-5">
    <h3 class="text-center mb-4">Connexion</h3>

    <div class="d-flex justify-content-center">
        <form action="" method="post" class="form form-control:post d-flex flex-column col-md-6 col-12">
            <div class="mb-3">
                <label for="username" class="form-label">Identifiant</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Votre identifiant" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Votre mot de passe" required>
            </div>

            <button class="submit btn btn-primary mb-3">Se connecter</button>

            <div class="d-flex justify-content-between">
                <a class="text-muted" href="/register">Vous n'avez pas de compte ?</a>
                <a class="btn btn-secondary btn-sm" href="/">Retour</a>
            </div>
        </form>
    </div>
</div>
