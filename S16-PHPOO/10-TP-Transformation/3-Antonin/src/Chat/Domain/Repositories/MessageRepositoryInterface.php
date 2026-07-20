<?php
declare(strict_types=1);

namespace App\Chat\Domain\Repositories;

use App\Chat\Domain\Entities\Message;

interface MessageRepositoryInterface
{
    public function save(Message $message): void;

    public function findAll(): array;
}