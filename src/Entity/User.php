<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use App\Repository\UserRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;
use Core\Security\UserManagement;

#[Table(name: 'users')]
#[TargetRepository(repoName: UserRepository::class)]
class User extends UserManagement
{

    protected int $id;
    private string $username;
    protected string $password;

    protected string $card;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAuthenticator() : string
    {
        return $this->username;
    }

    public function getCard()
    {
        $paiementRepository = new PaiementRepository();
        return $paiementRepository-> getPaiementByUser($this);

    }
}