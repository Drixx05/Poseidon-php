<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 15 - Eloquent ORM
----------------------------------------------------------------------------

--- Pourquoi Eloquent existe-t-il ?
Jusqu'à présent, nous avons manipulé notre base de données à l'aide du SQL brut puis du Query Builder.
Ces deux approches permettent d'exécuter efficacement des requêtes, mais elles restent centrées sur la base de données.
Laravel propose une approche encore plus orientée objet grâce à Eloquent, son ORM (Object Relational Mapping).
Avec Eloquent, nous ne manipulons plus directement des tables ou des requêtes SQL. Nous manipulons des objets PHP représentant les données de notre application.
Dans notre projet, chaque employé est représenté par un objet de la classe Employe.

--- Qu'est-ce qu'un ORM ?
ORM signifie Object Relational Mapping, que l'on peut traduire par mapping objet-relationnel.
Le rôle d'un ORM est de faire le lien entre une base de données relationnelle et des objets PHP.

Par exemple :
Base de données	        Objet PHP
Table employes	        Classe Employe
Ligne de la table	    Objet Employe
Colonne nom	            Propriété nom
Enregistrement	        Instance du modèle

Ainsi, lorsqu'une ligne est récupérée dans la base de données, Laravel crée automatiquement un objet Employe contenant toutes les informations correspondantes.

--- Le modèle au cœur d'Eloquent
Chaque modèle Eloquent est associé à une table de la base de données.

Dans notre projet :
le modèle Employe est associé à la table employes ;
chaque enregistrement devient un objet Employe.

Toutes les opérations de lecture, de création, de modification et de suppression passent par ce modèle.

--- Lire des données
Pour récupérer tous les employés :
$employes = Employe::all();
Pour récupérer un employé grâce à sa clé primaire :
$employe = Employe::find(1);
Pour récupérer uniquement le premier résultat d'une recherche :
$employe = Employe::where('service', 'informatique')->first();

--- Construire des requêtes
Eloquent reprend la syntaxe fluide du Query Builder.
Exemple :
$employes = Employe::where('service', 'RH')
    ->where('salaire', '>', 2200)
    ->orderBy('nom')
    ->get();
Cette syntaxe permet de construire des requêtes complexes tout en restant très lisible.

--- Créer un nouvel objet
Il est possible de créer un nouvel employé comme n'importe quel objet PHP.
$employe = new Employe();
$employe->prenom = 'Jean';
$employe->nom = 'Martin';
$employe->save();
La méthode save() enregistre automatiquement l'objet dans la base de données.

--- La création par affectation de masse
Lorsque les propriétés $fillable sont correctement définies dans le modèle, il est possible d'utiliser :
Employe::create([
    'prenom' => 'Julie',
    'nom' => 'Bernard',
    'service' => 'Marketing'
]);
Cette méthode permet de créer rapidement un nouvel enregistrement à partir d'un tableau associatif.

--- Modifier un objet
Pour modifier un employé existant :
$employe = Employe::find(1);
$employe->salaire = 3200;
$employe->save();
La méthode save() détecte automatiquement qu'il s'agit d'une modification.

--- Supprimer un objet
Deux approches sont possibles.
Supprimer un objet déjà chargé :
$employe = Employe::find(1);
$employe->delete();
Ou supprimer directement par identifiant :
Employe::destroy(1);

--- Les principales méthodes Eloquent
Méthode	            Description
all()	            Récupère tous les enregistrements
find()	            Recherche par clé primaire
first()	            Retourne le premier résultat
where()	            Ajoute une condition
orderBy()	        Trie les résultats
get()	            Exécute la requête
create()	        Crée un nouvel enregistrement
save()	            Enregistre un objet
delete()	        Supprime un objet
destroy()	        Supprime par identifiant
count()	            Compte les enregistrements
latest()	        Trie par date de création décroissante

--- Les bonnes pratiques
Créer un modèle pour chaque entité importante de l'application.
Respecter les conventions Laravel afin de bénéficier de la configuration automatique.
Définir les attributs $fillable avant d'utiliser create().
Utiliser Eloquent pour les opérations courantes et réserver le SQL brut aux requêtes très spécifiques.

--- Les erreurs fréquentes
Oublier d'importer le modèle avec use App\Models\Employe;.
Oublier de déclarer les attributs $fillable avant d'utiliser create().
Confondre first() (un seul objet) et get() (une collection).
Modifier un objet sans appeler save(), ce qui empêche l'enregistrement des changements.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
ce qu'est Eloquent et le rôle d'un ORM ;
utiliser un modèle pour interroger la base de données ;
lire, créer, modifier et supprimer des enregistrements ;
construire des requêtes grâce à une syntaxe fluide ;
comprendre que nous manipulons désormais des objets PHP plutôt que des requêtes SQL.
*/