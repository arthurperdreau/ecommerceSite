<?php

namespace App\Repository;

use App\Entity\Commande_article;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Commande_article::class)]
class Commande_articleRepository extends Repository
{
    public function saveCommande_article(Commande_article $commande_article):int
    {
        $this->pdo->prepare("INSERT INTO $this->tableName (commande_id, article_id, quantite) VALUES (:commande_id, :article_id, :quantite)")->execute(["commande_id" => $commande_article->getCommandeId(), "article_id" => $commande_article->getArticleId(), "quantite" => $commande_article->getQuantite()]);
        return $this->pdo->lastInsertId();
    }

    public function findByCommandeId(int $commande_id)
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE `commande_id` = :commande_id ");
        $query->execute(['commande_id' => $commande_id]);
        $items = $query->fetchAll(\PDO::FETCH_CLASS, Commande_article::class);
        return $items;
    }

}