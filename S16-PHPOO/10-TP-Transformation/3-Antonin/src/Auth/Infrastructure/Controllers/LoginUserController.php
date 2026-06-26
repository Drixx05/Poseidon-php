<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Controllers;

use App\Auth\Application\Commands\LoginUserCommand;
use App\Auth\Application\UseCases\LoginUser;
use App\Auth\Domain\Exceptions\InvalidCredentialsException;

final class LoginUserController
{
    public function __construct(private readonly LoginUser $loginUser) {}

    public function handle(): void
    {
        $errors = [];
        $old    = ['email' => '']; // saisies à ré-afficher (jamais le mot de passe)

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $old = ['email' => $email];

            try {
                $command = new LoginUserCommand($email, $password);
                $user = $this->loginUser->execute($command);
                
                session_regenerate_id(true); // Regénère l'ID de session pour éviter les attaques de fixation de session

                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;

                header('Location: /chat');
                return;
            } catch (InvalidCredentialsException $e) {
                $errors[] = 'Identifiants invalides.';
            }
        }

        require __DIR__ . '/../../../../templates/auth/login.php';
    }
}
