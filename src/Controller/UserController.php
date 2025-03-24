<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ConnexionType;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: User::class)]
class UserController extends Controller
{
    #[Route(uri: '/register', routeName: 'register', methods: ['post'])]
    public function register():Response
    {
        $registerForm = new ConnexionType();
        if($registerForm->isSubmitted())
        {
            $alreadyTaken = $this->getRepository()->findByUsername($registerForm->getValue('username'));
            if ($alreadyTaken) {
                return $this->render('/register',[]);
            }
            $user = new User();
            $user->setUsername($registerForm->getValue('username'));
            $user->setPassword($registerForm->getValue('password'));
            $this->getRepository()->save($user);
            return $this->redirectToRoute('login');
        };
        return $this->render('user/register', []);
    }

    #[Route(uri: '/login', routeName: 'login', methods: ['POST'])]
    public function login():Response
    {
        \Core\Session\Session::start();
        $registerForm = new ConnexionType();
        if($registerForm->isSubmitted())
        {
            $user = $this->getRepository()->findByUsername($registerForm->getValue('username'));
            if(!$user){return $this->redirectToRoute('login');}
            $id = $user->getId();
            if(!$id){return $this->redirectToRoute('login');}
            $user = $this->getRepository()->find($id);
            if(!$user){return $this->redirectToRoute('login');}

            $connected = $user->logIn($registerForm->getValue('password'));
            if($connected){
                \Core\Session\Session::set("user", ["id" => $user->getId(),"username" => $user->getUsername(),]);}
            if(!\Core\Session\Session::get("panier")) {
                \Core\Session\Session::set("panier",[]);
            }
            return $this->redirectToRoute('articles');
        }
        return $this->render('user/login', []);
    }

    #[Route(uri: '/logout', routeName: 'logout', methods: ['POST'])]
    public function logout():Response
    {
        $user = $this->getUser();
        if($user){
            $user->logOut();
            \Core\Session\Session::remove("panier");
            return $this->redirectToRoute('articles');
        }
        return $this->redirectToRoute('login');
    }


}