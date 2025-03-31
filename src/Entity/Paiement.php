<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;


#[Table(name: 'paiement')]
#[TargetRepository(repoName: PaiementRepository::class)]
class Paiement
{
    private int $id;
    private int $user_id;
    private string $cardName;
    private string $cardNumber;
    private string $cardExpiry;
    private string $cardCvv;
    private int $actif;

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function getCardName(): string
    {
        return $this->cardName;
    }

    public function setCardName(string $cardName): void
    {
        $this->cardName = $cardName;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    public function getCardExpiry(): string
    {
        return $this->cardExpiry;
    }

    public function setCardExpiry(string $cardExpiry): void
    {
        $this->cardExpiry = $cardExpiry;
    }

    public function getCardCvv(): string
    {
        return $this->cardCvv;
    }

    public function setCardCvv(string $cardCvv): void
    {
        $this->cardCvv = $cardCvv;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getActif(): int
    {
        return $this->actif;
    }

    public function setActif(int $actif): void
    {
        $this->actif = $actif;
    }
}