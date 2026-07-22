<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 12 - Les Migrations Laravel
----------------------------------------------------------------------------

--- Pourquoi utiliser des migrations ?
Avant Laravel, la structure d'une base de données était généralement créée directement à l'aide de fichiers SQL.

Par exemple :
CREATE TABLE employes (
    id INT AUTO_INCREMENT,
    prenom VARCHAR(50),
    ...
);

Cette méthode fonctionne, mais elle présente plusieurs inconvénients :

il faut partager les scripts SQL avec toute l'équipe ;
il devient difficile de suivre les modifications de la base au fil du temps ;
chaque développeur doit exécuter les scripts dans le bon ordre ;
il est compliqué de revenir en arrière lorsqu'une erreur est commise.

Laravel répond à ce problème grâce aux migrations.

Une migration est un fichier PHP qui décrit les modifications à apporter à la base de données.

On peut les considérer comme un système de gestion de versions pour la base de données, comparable à ce que Git est pour le code source.

--- Qu'est-ce qu'une migration ?
Une migration est une classe PHP contenant les instructions permettant de créer, modifier ou supprimer des tables.

Chaque migration possède deux méthodes :
public function up()
et
public function down()
up() contient les opérations à appliquer.
down() contient les opérations permettant d'annuler ces modifications.

Ainsi, Laravel est capable d'avancer ou de revenir en arrière automatiquement.

--- Créer une migration
Laravel fournit une commande Artisan permettant de créer une migration.
php artisan make:migration create_employes_table
Le fichier est créé dans :
database/
└── migrations/
Chaque migration possède un horodatage dans son nom afin que Laravel connaisse leur ordre d'exécution.

Exemple :
2026_07_10_084512_create_employes_table.php

--- La méthode up()
La méthode up() contient les instructions permettant de créer ou modifier la structure de la base.

Exemple :
public function up(): void
{
    Schema::create('employes', function (Blueprint $table) {
        $table->id();
        $table->string('prenom');
        $table->string('nom');
        $table->enum('sexe', ['m', 'f']);
        $table->string('service');
        $table->date('date_embauche');
        $table->float('salaire');
        $table->timestamps();
    });
}
Laravel traduit automatiquement ces instructions en SQL adapté au moteur de base de données utilisé.

--- La méthode down()
La méthode down() permet d'annuler les modifications réalisées par up().
Dans le cas d'une création de table :
public function down(): void
{
    Schema::dropIfExists('employes');
}
Cette méthode est utilisée lors des opérations de rollback.


--- Les principaux types de colonnes
Laravel fournit de nombreuses méthodes permettant de créer différents types de colonnes.
Les plus courantes sont :
Méthode	Type SQL approximatif
$table->id()	BIGINT AUTO_INCREMENT
$table->string()	VARCHAR
$table->text()	TEXT
$table->integer()	INT
$table->float()	FLOAT
$table->decimal()	DECIMAL
$table->boolean()	BOOLEAN
$table->date()	DATE
$table->datetime()	DATETIME
$table->timestamp()	TIMESTAMP
$table->enum()	ENUM
$table->timestamps()	created_at + updated_at
Laravel se charge ensuite de générer le SQL correspondant.

--- Exécuter les migrations
Pour créer toutes les tables :
php artisan migrate
Laravel exécute uniquement les migrations qui n'ont jamais été lancées.
Les migrations déjà exécutées sont enregistrées dans une table spéciale :
migrations
Cette table permet à Laravel de savoir quelles migrations ont déjà été appliquées.

--- Modifier une table existante
Les migrations permettent également de modifier une table.
Exemple :
php artisan make:migration add_email_to_employes_table
Puis :
Schema::table('employes', function (Blueprint $table) {
    $table->string('email')->nullable();
});
Cette approche évite de modifier une ancienne migration déjà exécutée.

--- Les rollbacks
L'un des grands avantages des migrations est la possibilité de revenir en arrière.
Annuler la dernière migration exécutée :
php artisan migrate:rollback
Annuler plusieurs migrations :
php artisan migrate:rollback --step=3
Réinitialiser complètement toutes les migrations :
php artisan migrate:reset
Supprimer toutes les tables puis relancer toutes les migrations :
php artisan migrate:fresh
Supprimer toutes les tables, relancer les migrations puis les seeders :
php artisan migrate:fresh --seed
Cette dernière commande est particulièrement utile pendant le développement.

--- Les conventions Laravel
Laravel applique plusieurs conventions automatiquement.
Par exemple :
$table->id();
crée automatiquement une clé primaire nommée :
id
De même,
$table->timestamps();
crée automatiquement les colonnes :
created_at
updated_at
Respecter ces conventions permet de profiter pleinement de la "magie" d'Eloquent.

--- Les bonnes pratiques
Créer une nouvelle migration à chaque modification de la structure de la base.
Ne jamais modifier une ancienne migration déjà utilisée sur un projet partagé.
Utiliser les conventions Laravel (id, timestamps()).
Donner des noms explicites aux migrations (create_employes_table, add_email_to_employes_table, etc.).
Utiliser les rollbacks pendant le développement pour tester rapidement les modifications.

--- Les erreurs fréquentes
Modifier une migration déjà exécutée au lieu d'en créer une nouvelle.
Oublier la méthode down().
Confondre migration et seeder.
Modifier directement la base de données avec phpMyAdmin sans créer de migration correspondante.
Oublier d'exécuter php artisan migrate après avoir créé une migration.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
ce qu'est une migration et pourquoi Laravel les utilise 
créer une migration avec Artisan 
comprendre le rôle des méthodes up() et down() 
créer et modifier des tables à l'aide du Schema Builder 
exécuter, annuler et recréer les migrations 
comprendre que les migrations constituent un véritable système de versionnement de la base de données.


INSERT INTO employes (id, prenom, nom, sexe, service, date_embauche, salaire) VALUES
(350, 'Jean-pierre', 'Laborde', 'm', 'direction', '2010-12-09', 5000),
(388, 'Clement', 'Gallet', 'm', 'commercial', '2010-12-15', 2300),
(415, 'Thomas', 'Winter', 'm', 'commercial', '2011-05-03', 3550),
(417, 'Chloe', 'Dubar', 'f', 'production', '2011-09-05', 1900),
(491, 'Elodie', 'Fellier', 'f', 'secretariat', '2011-11-22', 1600),
(509, 'Fabrice', 'Grand', 'm', 'comptabilite', '2011-12-30', 2900),
(547, 'Melanie', 'Collier', 'f', 'commercial', '2012-01-08', 3100),
(592, 'Laura', 'Blanchet', 'f', 'direction', '2012-05-09', 4500),
(627, 'Guillaume', 'Miller', 'm', 'commercial', '2012-07-02', 1900),
(655, 'Celine', 'Perrin', 'f', 'commercial', '2012-09-10', 2700),
(699, 'Julien', 'Cottet', 'm', 'secretariat', '2013-01-05', 1390),
(701, 'Mathieu', 'Vignal', 'm', 'informatique', '2013-04-03', 2500),
(739, 'Thierry', 'Desprez', 'm', 'secretariat', '2013-07-17', 1500),
(780, 'Amandine', 'Thoyer', 'f', 'communication', '2014-01-23', 2100),
(802, 'Damien', 'Durand', 'm', 'informatique', '2014-07-05', 2250),
(854, 'Daniel', 'Chevel', 'm', 'informatique', '2015-09-28', 3100),
(876, 'Nathalie', 'Martin', 'f', 'juridique', '2016-01-12', 3550),
(900, 'Benoit', 'Lagarde', 'm', 'production', '2016-06-03', 2550),
(933, 'Emilie', 'Sennard', 'f', 'commercial', '2017-01-11', 1800),
(990, 'Stephanie', 'Lafaye', 'f', 'assistant', '2017-03-01', 1775);
*/