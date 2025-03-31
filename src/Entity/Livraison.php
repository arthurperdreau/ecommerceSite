<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;


#[Table(name: 'livraison')]
#[TargetRepository(repoName: LivraisonRepository::class)]
class Livraison
{
    private int $id;
    private int $user_id;
    private string $fullName;
    private string $address;
    private string $city;
    private string $postalCode;
    private int $actif;

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

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
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