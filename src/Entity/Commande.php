<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'commande')]
#[TargetRepository(repoName: CommandeRepository::class)]
class Commande
{
    private int $id;
    private int $user_id;
    private string $card;
    private string $adresse;
    private float $prix;
    private string $date;
    private int $valider;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getCard(): string
    {
        return $this->card;
    }

    public function setCard(string $card): void
    {
        $this->card = $card;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getValider(): int
    {
        return $this->valider;
    }

    public function setValider(int $valider): void
    {
        $this->valider = $valider;
    }

}