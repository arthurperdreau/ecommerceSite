<?php

namespace App\Repository;

use App\Entity\Livraison;
use App\Entity\User;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Livraison::class)]
class LivraisonRepository extends Repository
{
    public function getLivraisonByUser(User $user): array
    {
        $query= $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id=:id");
        $query->execute(["id" => $user->getId()]);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
    }


    public function saveLivraison(Livraison $livraison): bool|object
    {
        $session=\Core\Session\Session::get("user");
        $this->pdo->prepare("INSERT INTO $this->tableName (user_id, fullName, address, city, postalCode) VALUES (:user_id, :fullName, :address, :city, :postalCode)")->execute([
            "user_id" => intval($session["id"]),
            "fullName" => $livraison->getFullName(),
            "address" => $livraison->getAddress(),
            "city" => $livraison->getCity(),
            "postalCode" => $livraison->getPostalCode()
        ]);
        return $this->find($this->pdo->lastInsertId());
    }

}