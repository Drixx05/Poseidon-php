<?php
declare(strict_types=1);

namespace App\Chat\Application\UseCases;

use App\Chat\Domain\Entities\Message;
use App\Chat\Domain\Repositories\MessageRepositoryInterface;

final class PostMessage
{
    public function __construct(private readonly MessageRepositoryInterface $messageRepository) {}

    public function execute(string $authorId, string $authorName, string $content): void
    {
        $message = new Message(
            id: uniqid('', true),
            authorId: $authorId,
            authorName: $authorName,
            content: $content,
            createdAt: date('d-m-Y H:i:s'),
        );

        $this->messageRepository->save($message);
    }
}