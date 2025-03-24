<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'commande_article')]
#[TargetRepository(repoName: Commande_articleRepository::class)]
class Commande_article
{
    private int $id;
    private int $commande_id;
    private int $article_id;
    private int $quantite;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCommandeId(): int
    {
        return $this->commande_id;
    }

    public function setCommandeId(int $commande_id): void
    {
        $this->commande_id = $commande_id;
    }

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    public function setArticleId(int $article_id): void
    {
        $this->article_id = $article_id;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }

}