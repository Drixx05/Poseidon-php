<?php

declare(strict_types=1);

namespace App\Chat\Infrastructure\Repositories;

use App\Chat\Domain\Entities\Message;
use App\Chat\Domain\Repositories\MessageRepositoryInterface;

final class PdoMessageRepository implements MessageRepositoryInterface
{
    public function __construct(private readonly \PDO $pdo) {}

    public function save(Message $message): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO messages (id, author_id, author_name, content, created_at)
             VALUES (:id, :author_id, :author_name, :content, :created_at)'
        );
        $stmt->execute([
            ':id'          => $message->id,
            ':author_id'   => $message->authorId,
            ':author_name' => $message->authorName,
            ':content'     => $message->content,
            ':created_at'  => $message->createdAt,
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT id, author_id, author_name, content, created_at
             FROM messages
             ORDER BY created_at ASC'
        );

        $messages = [];
        foreach ($stmt as $row) {
            $messages[] = new Message(
                $row['id'],
                $row['author_id'],
                $row['author_name'],
                $row['content'],
                $row['created_at'],
            );
        }

        return $messages;
    }
}
