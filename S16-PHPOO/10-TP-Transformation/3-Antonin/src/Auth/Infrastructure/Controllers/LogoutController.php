<?php
declare(strict_types=1);

namespace App\Auth\Infrastructure\Controllers;

final class LogoutController
{
    public function handle(): void
    {
        // On vide toutes les données de session
        $_SESSION = [];

        // On détruit la session côté serveur
        session_destroy();

        // Retour à la page de connexion
        header('Location: /login');
        return;
    }
}