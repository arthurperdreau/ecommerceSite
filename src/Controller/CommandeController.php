<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Commande_article;
use App\Repository\ArticleRepository;
use App\Repository\Commande_articleRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use App\Repository\PaiementRepository;
use Attributes\DefaultEntity;
use Attributes\TargetRepository;
use Core\Attributes\Route;
use Core\Controller\Controller;

#[DefaultEntity(entityName: Commande::class)]
#[TargetRepository(repoName: CommandeRepository::class)]
class CommandeController extends Controller
{
    #[Route(uri: '/commandes', routeName: 'showCommandes',)]
    public function showAllCommandes()
    {
        if (!isset($_SESSION["user"]))
        {
            return $this->redirectToRoute("articles");
        }
        if (isset($_SESSION["user"])) {
            $session = $_SESSION["user"];
            if ($session["username"] != "arthur") {
                return $this->redirectToRoute("articles");
        }}

        $commandes = $this->getRepository()->findAll();
        //var_dump($commandes);
        $livraisonRepository = new LivraisonRepository();
        $paiementRepository = new PaiementRepository();
        $commande_articleRepository= new Commande_articleRepository();
        $articleRepository= new ArticleRepository();

        return $this->render("commande/showCommandes",[
            "commandes" => $commandes,
            "livraisonRepository" => $livraisonRepository,
            "paiementRepository" => $paiementRepository,
            "commande_articleRepository" => $commande_articleRepository,
            "articleRepository" => $articleRepository

        ]);
    }

    #[Route(uri: '/validerCommande', routeName: 'validerCommande')]
    public function validerCommande()
    {
        $id = $this->getRequest()->get(["id" => "number"]);
        $commande=$this->getRepository()->find($id);
        $commande->setValider(1);
        $this->getRepository()->updateCommande($commande);
        return $this->redirectToRoute("showCommandes");
    }

    #[Route(uri: '/annulerCommande', routeName: 'annulerCommande')]
    public function annulerCommande()
    {
        $id = $this->getRequest()->get(["id" => "number"]);
        $commande=$this->getRepository()->find($id);
        var_dump($commande);
        $commande_articleRepository= new Commande_articleRepository();
        $articles = $commande_articleRepository->findByCommandeId(intval($id));
        $articleRepository= new ArticleRepository();
        foreach ($articles as $article) {
            $quantite = $article->getQuantite();
            $articleEntier = $articleRepository->find(intval($article->getArticleId()));
            $articleEntier->setStock($articleEntier->getStock() + $quantite);
            $articleRepository->updateArticle($articleEntier);
        }
        $this->getRepository()->delete($commande);
        return $this->redirectToRoute("showCommandes");
    }


}