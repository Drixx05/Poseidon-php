<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Repositories;

use App\Auth\Domain\Entities\User;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Auth\Domain\ValueObjects\HashedPassword;

final class PdoUserRepository implements UserRepositoryInterface
{

    public function __construct(private readonly \PDO $pdo) {}

    public function findByEmail(Email $email): ?User
    {
        $stmt = $this->pdo->prepare('SELECT id, name, email, password FROM users WHERE email = :email');
        $stmt->execute([':email' => $email->value]);
        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return new User($row['id'], $row['name'],  new Email($row['email']), HashedPassword::fromHash($row['password']));
    }


    public function save(User $user): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (id, name, email, password) VALUES (:id, :name, :email, :password)');
        $stmt->execute([
            ':id' => $user->id,
            ':name' => $user->name,
            ':email' => $user->email->value,
            ':password' => $user->password->hash,
        ]);
    }
}
