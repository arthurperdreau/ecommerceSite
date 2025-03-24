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
        $this->pdo->prepare("INSERT INTO $this->tableName (title, description, prix, stock) VALUES (:title, :description, :prix, :stock)")->execute(["title" => $article->getTitle(), "description" => $article->getDescription(), "prix" => $article->getPrix(), "stock" => $article->getStock() ]);
        return $this->pdo->lastInsertId();
    }

    public function updateArticle(Article $article)
    {
        $this->pdo->prepare("UPDATE $this->tableName SET title=:title, description=:description, prix=:prix, stock=:stock WHERE id=:id")->execute([
            "title" => $article->getTitle(),
            "description" => $article->getDescription(),
            "prix" => $article->getPrix(),
            "id" => $article->getId(),
            "stock" => $article->getStock()
        ]);
        return $this->find($article->getId());
    }
}