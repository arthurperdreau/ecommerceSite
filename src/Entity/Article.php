<?php

namespace App\Entity;
use App\Repository\ArticleRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;


#[Table(name: 'article')]
#[TargetRepository(repoName: ArticleRepository::class)]
class Article
{

    private int $id;
    private string $title;
    private float $prix;
    private string $description;
    private int $stock;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description   ;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

}