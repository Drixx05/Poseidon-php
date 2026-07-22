<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 14 - Les Models
----------------------------------------------------------------------------

--- Pourquoi les modèles existent-ils ?
Jusqu'à présent, nous avons manipulé directement notre base de données à l'aide de requêtes SQL ou du Query Builder.
Cette approche fonctionne parfaitement, mais elle reste centrée sur la base de données.
Laravel propose une approche plus orientée objet grâce aux modèles.
Un modèle représente un objet métier de notre application.
Dans notre projet, un employé est représenté par un modèle Employe.
Ainsi, au lieu de manipuler directement une table SQL, nous manipulerons des objets PHP.

--- Qu'est-ce qu'un modèle ?
Un modèle est une classe PHP qui représente une table de la base de données.
Chaque ligne de la table correspond à une instance du modèle.
Par exemple :
Table SQL	Modèle Laravel
employes	Employe
produits	Produit
clients	    Client
Une ligne de la table employes devient donc un objet Employe.

--- Le dossier Models
Tous les modèles sont placés dans :
app/
└── Models/
Chaque modèle est une classe PHP.

--- Créer un modèle
Laravel fournit une commande Artisan permettant de créer automatiquement un modèle.
php artisan make:model Employe
Cette commande crée le fichier :
app/Models/Employe.php

--- Les conventions Laravel
Laravel applique le principe :
Convention plutôt que configuration.
Cela signifie que le framework tente de deviner automatiquement la configuration à partir du nom des classes.
Par exemple :
Employe
sera automatiquement associé à la table :
employes
Aucune configuration supplémentaire n'est nécessaire.
Respecter ces conventions permet de bénéficier pleinement des fonctionnalités automatiques de Laravel.

--- La clé primaire
Par défaut, Laravel suppose que chaque table possède une clé primaire nommée :
id
C'est pourquoi nos migrations utilisent :
$table->id();
Si la clé primaire porte un autre nom (par exemple id_employes), il faut l'indiquer dans le modèle :
protected $primaryKey = 'id_employes';
Dans cette formation, nous respecterons la convention Laravel en utilisant simplement id.

--- Les timestamps
Laravel suppose également que chaque table contient deux colonnes :
created_at
updated_at
Ces colonnes sont créées automatiquement grâce à la méthode :
$table->timestamps();
Elles permettent de connaître la date de création et de dernière modification d'un enregistrement.
Si une table ne possède pas ces colonnes, il est possible de désactiver cette fonctionnalité :
public $timestamps = false;
Cependant, il est conseillé de conserver ces colonnes dans la plupart des projets Laravel.

--- Les attributs fillable
Par mesure de sécurité, Laravel protège automatiquement les insertions et les mises à jour réalisées par affectation de masse (Mass Assignment).
Le tableau $fillable permet de définir les colonnes pouvant être renseignées automatiquement.
Exemple :
protected $fillable = [
    'prenom',
    'nom',
    'sexe',
    'service',
    'date_embauche',
    'salaire'
];
Nous utiliserons cette propriété lors de la création et de la modification d'employés avec Eloquent.

--- Les bonnes pratiques
Créer un modèle pour chaque entité importante de l'application.
Utiliser un nom au singulier (Employe, Produit, Client...).
Respecter les conventions Laravel afin de limiter la configuration.
Utiliser une clé primaire nommée id.
Conserver les colonnes created_at et updated_at lorsque cela est possible.
Déclarer les attributs $fillable pour sécuriser les créations et mises à jour.

--- Les erreurs fréquentes
Donner au modèle un nom au pluriel (Employes).
Utiliser une clé primaire personnalisée sans renseigner $primaryKey.
Oublier de déclarer les attributs autorisés dans $fillable.
Supprimer les colonnes created_at et updated_at alors que l'on souhaite utiliser les fonctionnalités automatiques d'Eloquent.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
ce qu'est un modèle Laravel ;
créer un modèle avec Artisan ;
comprendre le lien entre un modèle et une table ;
connaître les principales conventions d'Eloquent (nom de la table, clé primaire, timestamps) ;
préparer le modèle avec la propriété $fillable.
*/