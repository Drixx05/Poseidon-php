<?php

declare(strict_types=1);
session_start();


use App\Shared\Infrastructure\Config;
use App\Shared\Infrastructure\Database\PdoConnection;
use App\Auth\Application\UseCases\RegisterUser;
use App\Auth\Application\UseCases\LoginUser;
use App\Auth\Infrastructure\Repositories\PdoUserRepository;
use App\Auth\Infrastructure\Controllers\LoginUserController;
use \App\Auth\Infrastructure\Controllers\RegisterUserController;
use App\Chat\Infrastructure\Repositories\PdoMessageRepository;
use App\Chat\Application\UseCases\PostMessage;
use App\Chat\Infrastructure\Controllers\ChatController;
use App\Auth\Infrastructure\Controllers\LogoutController;

require __DIR__ . '../../autoload.php';

$config = new Config();
$connection = new PdoConnection($config);
$pdo = $connection->connect();
$repository = new PdoUserRepository($pdo);
$registerUser = new RegisterUser($repository);
$loginUser = new LoginUser($repository);
$loginController = new LoginUserController($loginUser);
$registerController = new RegisterUserController($registerUser);
$messageRepository = new PdoMessageRepository($pdo);
$postMessage       = new PostMessage($messageRepository);
$chatController    = new ChatController($postMessage, $messageRepository);
$logoutController  = new LogoutController();

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = str_replace('/Poseidon-php/S16-PHPOO/10-TP-Transformation/public', '', $route);

match ($route) {
    '/register' => $registerController->handle(),
    '/login'    => $loginController->handle(),
    '/chat'     => $chatController->handle(),
    '/logout'   => $logoutController->handle(),
    default     => http_response_code(404),
};
