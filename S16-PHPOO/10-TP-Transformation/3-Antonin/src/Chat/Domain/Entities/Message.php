<?php
declare(strict_types=1);

namespace App\Chat\Domain\Entities;

final class Message
{
    public readonly string $id;
    public readonly string $authorId;
    public readonly string $authorName;
    public readonly string $content;
    public readonly string $createdAt;

    public function __construct(
        string $id,
        string $authorId,
        string $authorName,
        string $content,
        string $createdAt
    ) {
        $content = trim($content);

        if ($content === '') {
            throw new \InvalidArgumentException('Le message ne peut pas être vide.');
        }
        if (iconv_strlen($content) > 1000) {
            throw new \InvalidArgumentException('Le message ne peut pas dépasser 1000 caractères.');
        }

        $this->id = $id;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }
}