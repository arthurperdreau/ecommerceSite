<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Commande_article;
use App\Form\CommandeType;
use App\Repository\ArticleRepository;
use App\Repository\Commande_articleRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use App\Repository\PaiementRepository;
use App\Repository\UserRepository;
use Attributes\DefaultEntity;
use Attributes\TargetRepository;
use Core\Attributes\Route;
use Core\Controller\Controller;

#[DefaultEntity(entityName: Commande_article::class)]
#[TargetRepository(repoName: Commande_articleRepository::class)]
class Commande_articleController extends Controller
{
    #[Route(uri: '/panier/commande',routeName: "formCommande")]
    public function commander()
    {
        $panier=\Core\Session\Session::get("panier");
        //var_dump($panier);
        if($panier===[]){
            return $this->redirectToRoute("panier");
        }
        $userRepository=new UserRepository();
        $session=\Core\Session\Session::get("user");
        $user = $userRepository->findByUsername($session["username"]);
        //var_dump($user);
        $paiementRepository=new PaiementRepository();
        $livraisonRepository= new LivraisonRepository();
        $commandeForm = new CommandeType();
        if($commandeForm->isSubmitted()) {
            $newCommande=new Commande();
            //$test=$session["id"];
            //var_dump($test);
            $panierFinal = \Core\Session\Session::get("panier");
            $panierDecompose = [];
            $articleRepository= new ArticleRepository();
            if (!empty($panierFinal)) {
                foreach ($panierFinal as $id => $quantite) {
                    $article =$articleRepository ->find($id);
                    if ($article) {
                        $panierDecompose[$quantite] = $article;
                    }
                }
            }
            $total=0;
            foreach ($panierDecompose as $quantite => $value) {
                if($value->getStock() > $quantite) {
                    $total += floatval($value->getPrix()) * floatval($quantite);
                }else{
                    $total += floatval($value->getPrix()) * floatval($value->getStock());
                }
            }
            $newCommande->setUserId(intval(\Core\Session\Session::get("user")["id"]));
            $newCommande->setCard($commandeForm->getValue('creditCard'));
            $newCommande->setAdresse($commandeForm->getValue('adresse'));
            $newCommande->setPrix($total);
            $newCommande->setDate(date("Y-m-d"));
            $newCommande->setValider(0);
            $commandeRepository=new CommandeRepository();
            $idCommande=$commandeRepository->saveCommande($newCommande);
            $panierAvecBonneQuantite=[];
            $articleManquant=[];
            foreach ($panierDecompose as $quantite => $articleCommande) {
                $newCommandeArticle=new Commande_article();
                $newCommandeArticle->setCommandeId($idCommande);
                $newCommandeArticle->setArticleId($articleCommande->getId());
                if ($articleCommande->getStock()<$quantite) {
                    $newCommandeArticle->setQuantite($articleCommande->getStock());
                    $articleCommande->setStock(0);
                    $articleManquant[] = $articleCommande->getTitle();
                }else{
                    $newCommandeArticle->setQuantite($quantite);
                    $articleCommande->setStock($articleCommande->getStock() - $quantite);
                }
                $commandeArticleRepository=new Commande_articleRepository();
                $commandeArticleRepository->saveCommande_article($newCommandeArticle);
                $articleRepository=new ArticleRepository();
                $articleRepository->updateArticle($articleCommande);
                $panierAvecBonneQuantite[$newCommandeArticle->getQuantite()]=$articleCommande;
            }
            \Core\Session\Session::set("panier", []);
            $livraisonRepository= new LivraisonRepository();
            $paiementRepository= new PaiementRepository();
            $commande=$commandeRepository->find($idCommande);
            $adresse=$livraisonRepository->find($commande->getAdresse());
            $card=$paiementRepository->find($commande->getCard());
            return $this->render('commande/commandeFini',[
                    "articleRepository" => $articleRepository,
                    "commandeRepository" => $commandeRepository,
                    "livraisonRepository" => $livraisonRepository,
                    "paiementRepository" => $paiementRepository,
                    "commande" => $commande,
                    "panierAvecBonneQuantite" => $panierAvecBonneQuantite,
                    "adresse" => $adresse,
                    "card" => $card,
                    "articleManquant" => $articleManquant,
                ]);
        }
        return $this->render('commande/commande',["user"=>$user,"paiementRepository"=>$paiementRepository, "livraisonRepository"=>$livraisonRepository]);
    }

}