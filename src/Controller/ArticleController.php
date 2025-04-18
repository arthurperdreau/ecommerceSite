<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\addPanierType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\LivraisonRepository;
use App\Repository\PaiementRepository;
use App\Repository\UserRepository;
use Attributes\DefaultEntity;
use Attributes\TargetRepository;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Request;
use Core\Http\Response;

#[DefaultEntity(entityName: Article::class)]
#[TargetRepository(repoName: ArticleRepository::class)]
class ArticleController extends Controller
{
    #[Route('/', routeName: 'articles')]
    public function index()
    {
        $articles=$this->getRepository()->findAll();
        return $this->render('article/index', [
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/admin', routeName: 'articlesForAdmin')]
    public function articlesAdmin()
    {
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("articles");
        }
        $session = $_SESSION["user"];
        if ($session["username"] != "arthur") {
            return $this->redirectToRoute("articles");
        }
        $articles=$this->getRepository()->findAll();
        return $this->render('article/articlesAdmin', [
            'articles' => $articles,
        ]);
    }

    #[Route(uri:'/article/show', routeName: 'article')]
    public function show(): Response
    {

        $id=$this->getRequest()->get(["id"=>"number"]);
        if(!$id){
            return $this->redirectToRoute('articles');
        }
        $article=$this->getRepository()->find($id);
        if(!$article){
            return $this->redirectToRoute('articles');
        }
        return $this->render('article/show', [
            'article' => $article,
        ]);
    }

    #[Route(uri:'/create', routeName: 'newArticle')]
    public function create(): Response
    {
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("articles");
        }
        $session = $_SESSION["user"];
        if ($session["username"] != "arthur") {
            return $this->redirectToRoute("articles");
        }
        $repository=$this->getRepository();
        $article = new Article();
        $articleForm = new ArticleType($repository);

        if ($articleForm->isSubmitted()) {
            $id = $articleForm->CreateArticle($article, new Request());
            return $this->redirectToRoute('articles', []);
        }

        return $this->render('article/create', []);
    }

    #[Route(uri:'/article/update', routeName: 'updateArticle')]
    public function update(): Response
    {
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("articles");
        }
        $session = $_SESSION["user"];
        if ($session["username"] != "arthur") {
            return $this->redirectToRoute("articles");
        }
        $repository=$this->getRepository();
        $id = $this->getRequest()->get(["id" => "number"]);
        $article = $this->getRepository()->find($id);
        $updateArticleForm = new ArticleType($repository);

        if ($updateArticleForm->isSubmitted()) {
            $article->setTitle($updateArticleForm->getValue('title'));
            $article->setDescription($updateArticleForm->getValue('description'));
            $article->setPrix($updateArticleForm->getValue('prix'));
            $article->setStock($updateArticleForm->getValue('stock'));
            $article->setActif($article->getActif());
            $this->getRepository()->updateArticle($article);
            return $this->redirectToRoute('articlesForAdmin', []);
        }

        return $this->render('article/update', ["article"=>$article]);
    }

    #[Route(uri:'/article/retirer', routeName: 'removeArticle')]
    public function remove()
    {
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("articles");
        }
        $session = $_SESSION["user"];
        if ($session["username"] != "arthur") {
            return $this->redirectToRoute("articles");
        }
        $id = $this->getRequest()->get(["id" => "number"]);
        $article = $this->getRepository()->find($id);
        $article->setActif(0);
        $this->getRepository()->updateArticle($article);
        if (\Core\Session\Session::get("panier")[$id]){
            $session=\Core\Session\Session::get("panier");
            unset($session[$id]);
            \Core\Session\Session::set("panier",$session);
        }
        return $this->redirectToRoute('articlesForAdmin', []);
    }

    #[Route(uri:'/article/actif', routeName: 'addAgainArticle')]
    public function addAgain()
    {
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("articles");
        }
        $session = $_SESSION["user"];
        if ($session["username"] != "arthur") {
            return $this->redirectToRoute("articles");
        }

        $id = $this->getRequest()->get(["id" => "number"]);
        $article = $this->getRepository()->find($id);
        $article->setActif(1);
        $this->getRepository()->updateArticle($article);
        return $this->redirectToRoute('articlesForAdmin', []);
    }


    #[Route(uri:'/article/add', routeName: 'ajoutPanier')]
    public function addPanier(): Response
    {
        //var_dump($_SESSION);
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("articles");
        }
        $quantite=$this->getRequest()->get(["quantity"=>"number"]);
        $id = $this->getRequest()->get(["id" => "number"]);
        if (!$id || !is_numeric($quantite)) {
            return $this->redirectToRoute('articles');
        }

        $article = $this->getRepository()->find($id);
        if (!$article) {
            return $this->redirectToRoute('articles');
        }

        $panier = \Core\Session\Session::get("panier");

        try {
            if (isset($panier["{$id}"])) {
                $test = $panier["{$id}"];
            } else {
                throw new \Exception("Key not found");
            }
        } catch (\Exception $e) {
            $panier["{$id}"] = $quantite;
            \Core\Session\Session::set("panier", $panier);
            return $this->render('article/ajoutPanier', [
                'article' => $article,
                'quantite' => $quantite,
            ]);
        }

        $panier["{$id}"] += $quantite;
        \Core\Session\Session::set("panier", $panier);

        return $this->render('article/ajoutPanier', [
            'article' => $article,
            'quantite' => $quantite,
        ]);
    }


    #[Route(uri:'/panier', routeName: 'panier')]
    public function showPanier(): Response
    {
        $panier = \Core\Session\Session::get("panier");
        $panierDecompose = [];

        if (!empty($panier)) {
            foreach ($panier as $id => $quantite) {
                $article = $this->getRepository()->find($id);
                if ($article) {
                    $panierDecompose[$quantite] = $article;
                }
            }
        }

        return $this->render('article/showPanier', [
            'panier' => $panier,
            'panierDecompose' => $panierDecompose
        ]);

    }

    #[Route(uri:'/panier/delete', routeName: 'deletePanier')]
    public function deleteItem()
    {
        $id = $this->getRequest()->get(["id" => "number"]);
        //echo " test delete {$id}";
        $panier = \Core\Session\Session::get("panier");

        if (isset($panier[$id])) {
            unset($panier[$id]);
            \Core\Session\Session::set("panier", $panier); //-->Mise à jour de la session
        }
        return $this->redirectToRoute('panier');
    }

    #[Route(uri:'/profile', routeName: 'profile')]
    public function profile()
    {

        if(isset($_SESSION["user"])){
            $session=\Core\Session\Session::get("user");
            $paiementRepository=new PaiementRepository();
            $livraisonRepository=new LivraisonRepository();
            $userRepository=new UserRepository();
            $user = $userRepository->findByUsername($session["username"]);
            $this->render('profile/profile',[
            "paiementRepository"=>$paiementRepository,
            "user"=>$user,
            "livraisonRepository"=>$livraisonRepository,
        ]);}
        $this->render('profile/profile',[]);
    }

}