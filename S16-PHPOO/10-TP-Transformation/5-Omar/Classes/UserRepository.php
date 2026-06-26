<?php

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function pseudoExists(string $pseudo): bool
    {
        $sql = "
            SELECT id
            FROM users
            WHERE pseudo = :pseudo
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ":pseudo",
            $pseudo,
            PDO::PARAM_STR
        );

        $stmt->execute();

        return $stmt->fetch() !== false;
    }

    public function create(User $user): bool
    {
        $sql = "
            INSERT INTO users
            (
                pseudo,
                email,
                password,
                role
            )
            VALUES
            (
                :pseudo,
                :email,
                :password,
                :role
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ":pseudo",
            $user->getPseudo()
        );

        $stmt->bindValue(
            ":email",
            $user->getEmail()
        );

        $stmt->bindValue(
            ":password",
            $user->getPassword()
        );

        $stmt->bindValue(
            ":role",
            $user->getRole()
        );

        return $stmt->execute();
    }

    public function findByPseudo(
        string $pseudo
    ): array|false {

        $sql = "
            SELECT *
            FROM users
            WHERE pseudo = :pseudo
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ":pseudo",
            $pseudo,
            PDO::PARAM_STR
        );

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}