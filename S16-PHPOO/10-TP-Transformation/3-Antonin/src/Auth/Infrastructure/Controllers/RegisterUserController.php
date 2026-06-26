<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Controllers;

use App\Auth\Application\Commands\RegisterUserCommand;
use App\Auth\Application\UseCases\RegisterUser;
use App\Auth\Domain\Exceptions\EmailAlreadyExistsException;

final class RegisterUserController
{
    public function __construct(private readonly RegisterUser $registerUser) {}

    public function handle(): void
    {
        $errors = [];
        $old    = ['name' => '', 'email' => '']; // saisies à ré-afficher (jamais le mot de passe)

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name            = trim($_POST['name'] ?? '');
            $email           = trim($_POST['email'] ?? '');
            $password        = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            $old = ['name' => $name, 'email' => $email];

            // Règle locale au contrôleur : la confirmation n'est pas du métier
            if ($password !== $passwordConfirm) {
                $errors[] = 'Les deux mots de passe ne correspondent pas.';
            }

            // On n'appelle le use case que si la confirmation est bonne
            if ($errors === []) {
                try {
                    $command = new RegisterUserCommand($name, $email, $password);
                    $this->registerUser->execute($command);

                    header('Location: /login');
                    return;
                } catch (EmailAlreadyExistsException $e) {
                    $errors[] = $e->getMessage();
                } catch (\InvalidArgumentException $e) {
                    $errors[] = $e->getMessage();
                }
            }
        }

        // Un seul point de sortie vers la vue : affichage initial OU réaffichage avec erreurs
        require __DIR__ . '/../../../../templates/auth/register.php';
    }
}
