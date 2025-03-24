<h3 class="text-center my-4">Ajouter un nouvel article</h3>

<div class="container">
    <form action="/create" method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Entrez le titre">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-control" placeholder="Entrez la description">
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" id="prix" name="prix" class="form-control" placeholder="Entrez le prix">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" placeholder="Entrez le stock disponible">
        </div>

        <div class="d-flex justify-content-between">
            <a href="/" class="btn btn-secondary">Retour</a>
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </div>
        
    </form>
</div>

