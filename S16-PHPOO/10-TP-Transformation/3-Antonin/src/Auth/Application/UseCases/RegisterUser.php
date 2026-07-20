<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\Commands\RegisterUserCommand;
use App\Auth\Domain\Entities\User;
use App\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\HashedPassword;
use App\Auth\Domain\Exceptions\EmailAlreadyExistsException;

final class RegisterUser
{
    public function __construct(private readonly UserRepositoryInterface $userRepository) {}

    public function execute(RegisterUserCommand $command): User
    {
        $email = new Email($command->email);
        if ($this->userRepository->findByEmail($email) !== null) {
            throw EmailAlreadyExistsException::withEmail($email);
        }

        $hashedPassword = HashedPassword::fromPlainText($command->password);
        $id = uniqid('', true);
        $user = new User(
            id: $id,
            name: $command->name,
            email: $email,
            password: $hashedPassword
        );

        $this->userRepository->save($user);
        return $user;
    }
}