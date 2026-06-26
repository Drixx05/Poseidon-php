<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCases;

use App\Auth\Application\Commands\LoginUserCommand;
use App\Auth\Domain\Entities\User;
use App\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\Exceptions\InvalidCredentialsException;

final class LoginUser
{
    public function __construct(private readonly UserRepositoryInterface $userRepository) {}

    public function execute(LoginUserCommand $command): User
    {
        $email = new Email($command->email);

        $user = $this->userRepository->findByEmail($email);

        if ($user === null || !$user->password->verify($command->password)) {
            throw InvalidCredentialsException::create();
        }

        return $user;
    }
}
