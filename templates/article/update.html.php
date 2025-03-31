<h3 class="text-center my-4">Modifier un article</h3>

<div class="container">
    <div class="card shadow p-4">
        <form action="/article/update?id=<?= $article->getId() ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($article->getTitle()) ?>" class="form-control" placeholder="Titre de l'article" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Description de l'article" rows="3" required><?= htmlspecialchars($article->getDescription()) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="prix" class="form-label">Prix (€)</label>
                <input type="number" id="prix" name="prix" value="<?= htmlspecialchars($article->getPrix()) ?>" class="form-control" step="0.01" placeholder="Prix en euros" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($article->getStock()) ?>" class="form-control" placeholder="Stock disponible" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="/articles/admin" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Modifier l'article
                </button>
            </div>
        </form>
    </div>
</div>


