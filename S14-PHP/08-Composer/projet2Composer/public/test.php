<?php 


// Importation du package ce qui m'évite de fournir le FQN
use Ramsey\Uuid\Uuid;

// Autoload de composer
require __DIR__ . '/../vendor/autoload.php';

$uniqueId = Uuid::uuid4();

var_dump($uniqueId);
var_dump(get_class_methods($uniqueId));

echo $uniqueId->toString();