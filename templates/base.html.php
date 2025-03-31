<?php

use Core\Session\Session;

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nozama</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/united/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* Étire le corps de la page pour que le footer soit collé en-bas */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .content-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
    </style>
</head>
<body class="bg-light">

<div class="content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">Nonzama</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/panier">Panier</a>
                    </li>
                    <?php if(isset($_SESSION["user"])){
                        $session = $_SESSION["user"];
                        if ($session["username"] == "arthur"){
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Gestion admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                    <li><a class="dropdown-item" href="/create">Ajouter un article</a></li>
                                    <li><a class="dropdown-item" href="/articles/admin">Modifier un article</a></li>
                                    <li><a class="dropdown-item" href="/commandes">Voir les commandes</a></li>
                                </ul>
                            </li>
                        <?php } }?>
                </ul>
                <ul class="navbar-nav ms-3">
                    <?php if(isset($_SESSION["user"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile"><i class="bi bi-person-circle"></i> Connecté en tant que: <?= htmlspecialchars(Session::get("user")["username"]) ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (!empty($_GET["message"])): ?>
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> <?= htmlspecialchars($_GET["message"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <?= $pageContent ?>
            </div>
        </div>
    </div>

    <footer class="bg-primary text-white text-center py-3 mt-auto">
        <p>&copy; 2025 Nonzama | Tous droits réservés</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
