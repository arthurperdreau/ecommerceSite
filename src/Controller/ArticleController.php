<?php

namespace App\Controller;

use App\Entity\Article;
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
        $repository=$this->getRepository();
        $article = new Article();
        $articleForm = new ArticleType($repository);

        if ($articleForm->isSubmitted()) {
            $id = $articleForm->CreateArticle($article, new Request());
            return $this->redirectToRoute('articles', []);
        }

        return $this->render('article/create', []);
    }
    #[Route(uri:'/article/add', routeName: 'ajoutPanier')]
    public function addPanier(): Response
    {
        //var_dump($_SESSION);
        if (!isset($_SESSION["user"])) {
            return $this->redirectToRoute("profile");
        }

        $id = $this->getRequest()->get(["id" => "number"]);
        if (!$id) {
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
            $panier["{$id}"] = 1;
            \Core\Session\Session::set("panier", $panier);
            return $this->render('article/ajoutPanier', [
                'article' => $article,
            ]);
        }

        $panier["{$id}"] += 1;
        \Core\Session\Session::set("panier", $panier);

        return $this->render('article/ajoutPanier', [
            'article' => $article,
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