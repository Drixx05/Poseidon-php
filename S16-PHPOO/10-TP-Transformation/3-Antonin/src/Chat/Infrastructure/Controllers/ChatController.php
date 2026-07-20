<?php
declare(strict_types=1);

namespace App\Chat\Infrastructure\Controllers;

use App\Chat\Application\UseCases\PostMessage;
use App\Chat\Domain\Repositories\MessageRepositoryInterface;

final class ChatController
{
    public function __construct(
        private readonly PostMessage $postMessage,
        private readonly MessageRepositoryInterface $messageRepository,
    ) {}

    public function handle(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            return;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? '';

            try {
                $this->postMessage->execute(
                    $_SESSION['user_id'],
                    $_SESSION['user_name'],
                    $content,
                );

                header('Location: /chat');
                return;
            } catch (\InvalidArgumentException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $messages = $this->messageRepository->findAll();

        require __DIR__ . '/../../../../templates/chat/index.php';
    }
}