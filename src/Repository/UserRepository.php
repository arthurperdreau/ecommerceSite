<?php

namespace App\Repository;

use App\Entity\User;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: User::class)]
class UserRepository extends Repository
{
    public function findByUsername(string $username): User | bool
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE `username` = :username");
        $query->execute(['username' => $username]);
        $query->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }

    public function save(User $user): User | bool
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (username, password) VALUES (:username, :password)");
        $query->execute([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
        ]);
        return $this->find($this->pdo->lastInsertId());
    }

    public function update(User $user):bool
    {
        $this->pdo->prepare("UPDATE $this->tableName SET card=:card WHERE id=:id")->execute([
            'id' => $user->getId(),
            'card' => $user->getCard(),
        ]);
        return true;
    }

}