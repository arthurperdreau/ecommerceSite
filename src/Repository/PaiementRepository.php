<?php

namespace App\Repository;

use App\Entity\Paiement;
use App\Entity\User;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Paiement::class)]
class PaiementRepository extends Repository
{
    public function getPaiementByUser(User $user): array
    {
        $query= $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id=:id AND actif=1");
        $query->execute(["id" => $user->getId()]);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
    }

    public function saveCard(Paiement $paiement): bool|object
    {
        $session=\Core\Session\Session::get("user");
        $this->pdo->prepare("INSERT INTO $this->tableName (user_id, cardName, cardNumber, cardExpiry, cardCvv, actif) VALUES (:user_id, :cardName, :cardNumber, :cardExpiry, :cardCvv, :actif)")->execute([
            "user_id" => intval($session["id"]),
            "cardName" => $paiement->getCardName(),
            "cardNumber" => $paiement->getCardNumber(),
            "cardExpiry" => $paiement->getCardExpiry(),
            "cardCvv" => $paiement->getCardCvv(),
            "actif" => 1
        ]);
        return $this->find($this->pdo->lastInsertId());
    }

    public function updatePaiement(Paiement $paiement)
    {
        $this->pdo->prepare("UPDATE $this->tableName SET user_id=:user_id, cardName=:cardName, cardNumber=:cardNumber, cardExpiry=:cardExpiry, cardCvv=:cardCvv, actif=:actif WHERE id=:id")->execute([
            "user_id" => $paiement->getUserId(),
            "cardName" => $paiement->getCardName(),
            "cardNumber" => $paiement->getCardNumber(),
            "cardExpiry" => $paiement->getCardExpiry(),
            "cardCvv" => $paiement->getCardCvv(),
            "actif" => 0,
            "id" => $paiement->getId()
        ]);
        return $this->find($paiement->getId());
    }
}