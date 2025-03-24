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
        $query= $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id=:id");
        $query->execute(["id" => $user->getId()]);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
    }

    public function saveCard(Paiement $paiement): bool|object
    {
        $session=\Core\Session\Session::get("user");
        $this->pdo->prepare("INSERT INTO $this->tableName (user_id, cardName, cardNumber, cardExpiry, cardCvv) VALUES (:user_id, :cardName, :cardNumber, :cardExpiry, :cardCvv)")->execute([
            "user_id" => intval($session["id"]),
            "cardName" => $paiement->getCardName(),
            "cardNumber" => $paiement->getCardNumber(),
            "cardExpiry" => $paiement->getCardExpiry(),
            "cardCvv" => $paiement->getCardCvv()
        ]);
        return $this->find($this->pdo->lastInsertId());
    }

}