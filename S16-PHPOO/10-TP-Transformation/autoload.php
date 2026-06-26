<?php
declare(strict_types=1);

// autoload.php — autoloader PSR-4 manuel
spl_autoload_register(function (string $class): void {
    $prefix  = 'App\\';
    $baseDir = __DIR__ . '/src/';

    // 2. Cette classe ne nous concerne pas → on laisse la main
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    // 3 + 4. On retire le préfixe, on traduit \ en /, on ajoute .php
    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // 5. On charge si le fichier existe
    if (is_file($file)) {
        require $file;
    }
});