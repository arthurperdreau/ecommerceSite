<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementType;
use App\Repository\UserRepository;
use Attributes\DefaultEntity;
use Core\Attributes\Route;
use Core\Controller\Controller;
use Core\Http\Response;

#[DefaultEntity(entityName: Paiement::class)]
class PaiementController extends Controller
{

    #[Route(uri:'/profile/addPaiement', routeName: 'addPaiement')]
    public function addMoyenPaiment()
    {
        $session=\Core\Session\Session::get("user");
        $id=intval($session["id"]);
        $userRepository=new UserRepository();
        $user=$userRepository->find($id);
        //var_dump($user);
        $PaiementForm = new PaiementType();
        if($PaiementForm->isSubmitted()) {
            $newCard=new Paiement();
            //$test=$session["id"];
            //var_dump($test);
            $newCard->setUserId(intval($session["id"]));
            $newCard->setCardName($PaiementForm->getValue('cardName'));
            $newCard->setCardNumber($PaiementForm->getValue('cardNumber'));
            $newCard->setCardExpiry($PaiementForm->getValue('cardExpiry'));
            $newCard->setCardCvv($PaiementForm->getValue('cardCvv'));

            $this->getRepository()->saveCard($newCard);
            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/addPaiement', []);
    }

    #[Route(uri:'/profile/deletePaiement', routeName: 'deletePaiement')]
    public function removeCard(): Response
    {
        $id = $this->getRequest()->get(["id" => "number"]);
        $card=$this->getRepository()->find($id);
        $this->getRepository()->delete($card);
        return $this->redirectToRoute('profile');
    }

}