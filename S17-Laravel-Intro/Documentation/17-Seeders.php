<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 17 - Seeders
----------------------------------------------------------------------------

--- Pourquoi utiliser un Seeder ?
Une Factory sait créer un objet.
Cependant, il faut encore lui indiquer quand et combien d'objets créer.
C'est précisément le rôle d'un Seeder.
Un Seeder permet de remplir automatiquement la base de données.

--- Qu'est-ce qu'un Seeder ?
Un Seeder est une classe contenant les instructions nécessaires pour insérer des données dans la base.
Il peut :
créer quelques enregistrements (précis)
générer plusieurs centaines d'objets (random) grâce aux Factories 
préparer automatiquement une base de données de développement.

--- Créer un Seeder
Commande Artisan :
php artisan make:seeder EmployeSeeder
Le fichier est créé dans :
database/
└── seeders/

--- Utiliser une Factory dans un Seeder
public function run(): void
{
    Employe::factory()
        ->count(20)
        ->create();
}

--- Exécuter un Seeder spécifique
php artisan db:seed --class=EmployeSeeder
Seul ce Seeder sera exécuté.

--- Le DatabaseSeeder
Laravel possède un Seeder principal :
database/
└── seeders/
    └── DatabaseSeeder.php
Il permet de lancer plusieurs Seeders.
Exemple :
$this->call([
    EmployeSeeder::class,
    ClientSeeder::class,
    ProduitSeeder::class
]);
Le DatabaseSeeder joue le rôle de chef d'orchestre.

--- Exécuter tous les Seeders
php artisan db:seed
Tous les Seeders appelés dans DatabaseSeeder seront exécutés.

--- Recréer entièrement la base
Pendant le développement, il est fréquent de repartir d'une base vide.
Laravel propose une commande très pratique :
php artisan migrate:fresh --seed
Cette commande :
supprime toutes les tables 
rejoue toutes les migrations 
exécute automatiquement les Seeders.
Elle permet de retrouver rapidement une base propre et entièrement remplie.
⚠️ Attention : cette commande supprime toutes les données de la base. Elle est destinée au développement et ne doit jamais être utilisée sur une base de production.

--- Les bonnes pratiques
Utiliser les Factories pour décrire la génération des données.
Utiliser les Seeders pour organiser le remplissage de la base.
Employer DatabaseSeeder comme point d'entrée unique.
Utiliser migrate:fresh --seed uniquement en environnement de développement.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
créer une Factory pour générer des données réalistes avec Faker 
distinguer make() de create() 
créer un Seeder spécifique 
utiliser le DatabaseSeeder pour lancer plusieurs Seeders 
reconstruire entièrement une base de développement avec php artisan migrate:fresh --seed.


*/