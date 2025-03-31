<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonType;
use App\Repository\UserRepository;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: Livraison::class)]
class LivraisonController extends Controller
{

    #[Route(uri:'/profile/addAdresse', routeName: 'addAdresse')]
    public function addAdresseLivraison()
    {
        $session=\Core\Session\Session::get("user");
        $id=intval($session["id"]);
        $userRepository=new UserRepository();
        $user=$userRepository->find($id);
        //var_dump($user);
        $LivraisonForm = new LivraisonType();
        if($LivraisonForm->isSubmitted()) {
            $newAdresse=new Livraison();
            //$test=$session["id"];
            //var_dump($test);
            $newAdresse->setUserId(intval($session["id"]));
            $newAdresse->setFullName($LivraisonForm->getValue('fullName'));
            $newAdresse->setAddress($LivraisonForm->getValue('address'));
            $newAdresse->setCity($LivraisonForm->getValue('city'));
            $newAdresse->setPostalCode($LivraisonForm->getValue('postalCode'));

            $this->getRepository()->saveLivraison($newAdresse);
            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/addAdresse', []);
    }

    #[Route(uri:'/profile/deleteAdresse', routeName: 'deleteAdresse')]
    public function removeAdresse(): Response
    {
        $id = $this->getRequest()->get(["id" => "number"]);
        $adresse=$this->getRepository()->find($id);
        $adresse->setActif(0);
        $this->getRepository()->updateLivraison($adresse);
        return $this->redirectToRoute('profile');
    }

}