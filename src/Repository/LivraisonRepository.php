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
        $query= $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id=:id AND actif=1");
        $query->execute(["id" => $user->getId()]);
        return $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
    }


    public function saveLivraison(Livraison $livraison): bool|object
    {
        $session=\Core\Session\Session::get("user");
        $this->pdo->prepare("INSERT INTO $this->tableName (user_id, fullName, address, city, postalCode, actif) VALUES (:user_id, :fullName, :address, :city, :postalCode, :actif)")->execute([
            "user_id" => intval($session["id"]),
            "fullName" => $livraison->getFullName(),
            "address" => $livraison->getAddress(),
            "city" => $livraison->getCity(),
            "postalCode" => $livraison->getPostalCode(),
            "actif" => 1,

        ]);
        return $this->find($this->pdo->lastInsertId());
    }

    public function updateLivraison(Livraison $livraison)
    {
        $this->pdo->prepare("UPDATE $this->tableName SET user_id=:user_id, fullName=:fullName, address=:address, city=:city, postalCode=:postalCode, actif=:actif WHERE id=:id")->execute([
            "user_id" => $livraison->getUserId(),
            "fullName" => $livraison->getFullName(),
            "address" => $livraison->getAddress(),
            "city" => $livraison->getCity(),
            "postalCode" => $livraison->getPostalCode(),
            "actif" => 0,
            "id" => $livraison->getId(),
        ]);
        return $this->find($livraison->getId());
    }

}