<?php

namespace App\Repository;

use App\Entity\Article;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Article::class)]
class ArticleRepository extends Repository
{
    public function saveArticle(Article $article):int
    {
        $this->pdo->prepare("INSERT INTO $this->tableName (title, description, prix, stock, actif) VALUES (:title, :description, :prix, :stock, :actif)")->execute(["title" => $article->getTitle(), "description" => $article->getDescription(), "prix" => $article->getPrix(), "stock" => $article->getStock(), "actif" => 1 ]);
        return $this->pdo->lastInsertId();
    }

    public function updateArticle(Article $article)
    {
        $this->pdo->prepare("UPDATE $this->tableName SET title=:title, description=:description, prix=:prix, stock=:stock, actif=:actif WHERE id=:id")->execute([
            "title" => $article->getTitle(),
            "description" => $article->getDescription(),
            "prix" => $article->getPrix(),
            "id" => $article->getId(),
            "stock" => $article->getStock(),
            "actif" => $article->getActif()
        ]);
        return $this->find($article->getId());
    }
}