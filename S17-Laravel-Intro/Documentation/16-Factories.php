<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 16 - Factories
----------------------------------------------------------------------------

--- Pourquoi utiliser une Factory ?
Lors du développement d'une application, il est souvent nécessaire de remplir rapidement la base de données avec de nombreuses informations.
Créer manuellement plusieurs dizaines ou centaines d'enregistrements serait long, répétitif et peu intéressant.
Les Factories permettent de générer automatiquement des objets contenant des données réalistes.
Elles sont principalement utilisées pendant le développement et les tests.

--- Qu'est-ce qu'une Factory ?
Une Factory est une classe qui décrit comment créer automatiquement une instance d'un modèle.
Chaque propriété est remplie grâce à des données générées aléatoirement.
Dans notre projet, la EmployeFactory permet de créer automatiquement des employés.

--- Créer une Factory
Laravel fournit une commande Artisan :
php artisan make:factory EmployeFactory --model=Employe
La Factory est créée dans :
database/
└── factories/

--- Faker
Laravel intègre automatiquement la bibliothèque FakerPHP.
Cette bibliothèque permet de générer des données réalistes.
Quelques exemples :
fake()->firstName()
fake()->lastName()
fake()->email()
fake()->company()
fake()->city()
fake()->phoneNumber()
fake()->date()
Grâce à Faker, il est possible de remplir rapidement une base de données de test avec des informations crédibles.

--- Les principales méthodes
Créer un objet sans l'enregistrer :
Employe::factory()->make();
Créer un objet et l'enregistrer :
Employe::factory()->create();
Créer plusieurs objets :
Employe::factory()
    ->count(20)
    ->create();

    --- make() ou create() ?
Méthode	        Effet
make()	        Crée un objet en mémoire uniquement
create()	    Crée l'objet et l'enregistre dans la base de données

Cette différence est importante.

--- Les bonnes pratiques
Utiliser Faker pour produire des données réalistes.
Centraliser toute la génération de données dans les Factories.
Éviter de créer manuellement de grandes quantités de données de test.

--- Ce qu'il faut retenir
Les Factories permettent de créer rapidement des objets de test avec des données cohérentes et réalistes.
*/