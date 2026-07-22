<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 13 - Raw SQL & Query Builder
----------------------------------------------------------------------------

--- Pourquoi plusieurs façons d'interroger une base de données ?
Laravel propose plusieurs méthodes pour communiquer avec une base de données.
Toutes permettent d'obtenir le même résultat, mais elles ne travaillent pas au même niveau d'abstraction.

Nous allons les découvrir dans l'ordre :
le SQL Brut (Raw SQL) ;
le Query Builder ;
puis Eloquent ORM.

L'objectif est de comprendre l'évolution progressive entre une requête SQL classique et les outils proposés par Laravel.

---Le SQL Brut (Raw SQL)
Le SQL Brut consiste à écrire directement des requêtes SQL, exactement comme nous le faisions auparavant avec MySQL.
Laravel ne modifie pas la requête : il se contente de l'envoyer au serveur de base de données.

Exemple :
DB::select("
    SELECT *
    FROM employes
");

On retrouve donc la syntaxe SQL traditionnelle :
SELECT
INSERT
UPDATE
DELETE
WHERE
ORDER BY
GROUP BY
LIMIT
etc.

Le SQL Brut est particulièrement utile lorsqu'une requête est très complexe ou lorsqu'on souhaite utiliser des fonctionnalités spécifiques au moteur de base de données.

--- La façade DB
Toutes les requêtes SQL brutes passent par la façade :

use Illuminate\Support\Facades\DB;
Cette façade représente le point d'entrée vers la base de données.
Elle permet notamment d'exécuter :

DB::select()
DB::insert()
DB::update()
DB::delete()
ou encore
DB::statement()

pour exécuter une instruction SQL quelconque.

--- Les requêtes paramétrées
Lorsque des données proviennent d'un utilisateur, il est fortement déconseillé de les concaténer directement dans une requête SQL.
Par exemple, cette écriture est dangereuse :
DB::select("
SELECT *
FROM employes
WHERE id = $id
");

Elle expose l'application aux injections SQL.
Laravel permet d'utiliser des paramètres liés (Prepared Statements) :
DB::select(
    "SELECT * FROM employes WHERE id = ?",
    [$id]
);
Les valeurs sont automatiquement échappées avant d'être envoyées à la base de données.
Cette approche est beaucoup plus sûre.

--- Les limites du SQL Brut
Le SQL Brut fonctionne parfaitement, mais il présente plusieurs inconvénients.
Les requêtes deviennent rapidement longues.
Le code est moins lisible.
Les fautes de syntaxe SQL sont fréquentes.
Le développeur doit écrire lui-même toutes les requêtes.
Pour simplifier ce travail, Laravel propose le Query Builder.

--- Le Query Builder
Le Query Builder est un constructeur de requêtes.
Au lieu d'écrire du SQL, nous appelons des méthodes PHP.
Laravel se charge ensuite de générer automatiquement la requête SQL correspondante.

Par exemple :
DB::table('employes')->get();
Laravel transforme automatiquement cette instruction en :
SELECT * FROM employes;
Le développeur manipule donc des méthodes PHP plutôt que du SQL.

--- Le principe du chaînage (Method Chaining)
Le Query Builder repose sur le principe du chaînage de méthodes.
Chaque méthode renvoie l'objet Query Builder, ce qui permet d'enchaîner plusieurs opérations.

Par exemple :
DB::table('employes')
    ->where('service', 'Commercial')
    ->orderBy('nom')
    ->limit(5)
    ->get();
Laravel génère automatiquement la requête SQL correspondante.
Cette écriture est généralement plus lisible que le SQL brut.

--- Les méthodes les plus courantes

Le Query Builder possède de nombreuses méthodes.

Les plus utilisées sont :

Méthode	                Rôle
table()	            Choisir la table
select()	        Choisir les colonnes
where()	            Ajouter une condition
orWhere()	        Ajouter une condition OU
orderBy()	        Trier les résultats
groupBy()	        Regrouper les résultats
having()	        Filtrer après un GROUP BY
limit()	            Limiter le nombre de résultats
get()	            Récupérer plusieurs lignes
first()	            Récupérer une seule ligne
find()	            Rechercher par identifiant
insert()	        Ajouter des données
update()	        Modifier des données
delete()	        Supprimer des données
count()	            Compter des lignes
avg()	            Calculer une moyenne
sum()	            Calculer une somme
min()	            Valeur minimale
max()	            Valeur maximale

--- Les résultats obtenus
Les méthodes de récupération ne renvoient pas toutes le même type de résultat.
get()
renvoie une collection contenant plusieurs lignes.
first()
renvoie uniquement le premier résultat.
value()
renvoie directement une seule valeur.
find($id)
renvoie un objet basé sur un id fourni en param
Il est donc important de choisir la méthode adaptée au résultat attendu.

--- Les avantages du Query Builder
Le Query Builder présente plusieurs avantages.
Le code est plus lisible.
Il réduit fortement les erreurs de syntaxe SQL.
Il protège automatiquement contre les injections SQL lors de l'utilisation des méthodes prévues.
Il fonctionne quel que soit le moteur de base de données utilisé par Laravel.
Les requêtes sont plus faciles à maintenir.
Il constitue une excellente transition entre le SQL classique et Eloquent ORM.

--- SQL Brut ou Query Builder ?
Les deux approches sont parfaitement valables.
Le choix dépend du contexte.
Le SQL Brut est souvent utilisé :
pour des requêtes très complexes ;
pour exploiter une fonctionnalité spécifique à MySQL ou PostgreSQL ;
lorsqu'on possède déjà une requête SQL existante.
Le Query Builder est généralement préféré :
pour les opérations courantes ;
pour un code plus lisible ;
pour bénéficier des protections offertes par Laravel ;
pour préparer une transition vers Eloquent.

--- Les bonnes pratiques
Privilégier le Query Builder pour les opérations classiques.
Réserver le SQL Brut aux cas particuliers.
Toujours utiliser des requêtes paramétrées/préparées en SQL Brut.
Éviter la concaténation de variables dans les requêtes SQL.
Organiser les requêtes complexes dans les contrôleurs ou dans des classes dédiées plutôt que directement dans les vues.

--- Les erreurs fréquentes
Confondre SQL Brut et Query Builder.
Concaténer des variables dans une requête SQL.
Oublier d'importer la façade DB.
Utiliser get() alors qu'un seul résultat est attendu (first() ou value() seraient plus adaptés).
Écrire du SQL dans une vue Blade au lieu de le placer dans un contrôleur.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
utiliser le SQL Brut avec Laravel ;
exécuter des requêtes grâce à la façade DB ;
sécuriser les requêtes SQL à l'aide de paramètres liés ;
construire des requêtes avec le Query Builder ;
chaîner plusieurs méthodes pour créer une requête lisible ;
choisir entre SQL Brut et Query Builder selon les besoins.

--- Laravel ne remplace pas SQL, mais propose des niveaux d'abstraction successifs.

Niveau	            Exemple	                            Ce que l'on manipule
SQL Brut	    SELECT * FROM employes	                Le langage SQL directement
Query Builder	DB::table('employes')->get()	        Un constructeur de requêtes en PHP
Eloquent ORM	Employe::all()	                Des objets PHP représentant les lignes de la table

*/