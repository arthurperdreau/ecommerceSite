<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\Commande_article;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Commande::class)]
class CommandeRepository extends Repository
{
    public function saveCommande(Commande $commande):int
    {
        $this->pdo->prepare("INSERT INTO $this->tableName (user_id, card, adresse, prix, date, valider) VALUES (:user_id, :card, :adresse, :prix, :date, :valider)")->execute(["user_id"=>$commande->getUserId(),"card"=>$commande->getCard(),"adresse"=>$commande->getAdresse(),"prix"=>$commande->getPrix(),"date"=>$commande->getDate(), "valider"=>0 ]);
        return $this->pdo->lastInsertId();
    }

    public function findById( int $id): Commande | bool
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE `id` = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Commande_article::class);
        return $query->fetch();
    }

    public function updateCommande(Commande $commande)
    {
        $this->pdo->prepare("UPDATE $this->tableName SET user_id=:user_id, card=:card, adresse=:adresse, prix=:prix, date=:date, valider=:valider WHERE id=:id")->execute([
            "user_id"=>$commande->getUserId(),
            "card"=>$commande->getCard(),
            "adresse"=>$commande->getAdresse(),
            "prix"=>$commande->getPrix(),
            "date"=>$commande->getDate(),
            "id"=>$commande->getId(),
            "valider"=>1
        ]);
        return $this->find($commande->getId());
    }
}