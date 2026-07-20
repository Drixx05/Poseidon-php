<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 6 — Les Controllers
----------------------------------------------------------------------------


--- Pourquoi les contrôleurs existent-ils ?
Au début d'un projet Laravel, il est tout à fait possible d'écrire le code directement dans les routes.

Exemple :
Route::get('/bonjour', function () {
    return "Bonjour";
});

Cette solution fonctionne parfaitement lorsque l'application contient seulement quelques pages.
Cependant, au fur et à mesure que le projet grandit, le fichier routes/web.php devient rapidement difficile à lire et à maintenir.

Chaque route finit par contenir :
des traitements 
des calculs 
des accès à la base de données 
des appels à des vues.

Toutes ces responsabilités sont mélangées.

Pour résoudre ce problème, Laravel utilise les contrôleurs. Pour respecter l'architecture MVC.
Le rôle d'un contrôleur est de regrouper la logique d'une ou plusieurs pages dans une classe dédiée.
Les routes deviennent alors beaucoup plus simples.

--- Qu'est-ce qu'un contrôleur ?
Un contrôleur est une classe PHP dont le rôle est de traiter une requête avant de renvoyer une réponse.

Cette réponse peut être :
une chaîne de caractères 
une vue 
des données 
plus tard une réponse JSON.

Chaque méthode du contrôleur représente généralement une action de l'application.

Exemple :
afficher la liste des employés 
afficher un employé 
créer un employé 
modifier un employé.

--- Où sont stockés les contrôleurs ?
Tous les contrôleurs sont créés dans le dossier :
app/Http/Controllers
Laravel place automatiquement les nouveaux contrôleurs dans ce répertoire.

--- Créer un contrôleur
Les contrôleurs sont générés grâce à Artisan.
Commande :
php artisan make:controller EmployeController
Cette commande crée automatiquement le fichier :
app/Http/Controllers/EmployeController.php
Le développeur n'a plus qu'à y ajouter ses méthodes.

--- Structure d'un contrôleur
Un contrôleur est une classe PHP classique.

Exemple :
class EmployeController extends Controller
{
    public function accueil()
    {
        return "Bienvenue";
    }
}
Chaque méthode est ensuite appelée par une route.

--- Associer une route à un contrôleur
Une route peut appeler une méthode d'un contrôleur.

Exemple :
use App\Http\Controllers\EmployeController;
Route::get('/', [EmployeController::class, 'accueil']);
Laravel exécute alors la méthode accueil() lorsque l'utilisateur visite la page d'accueil.

--- Retourner une vue
Comme une route, un contrôleur peut retourner une vue.

Exemple :
public function accueil()
{
    return view('accueil');
}

Laravel affichera automatiquement le fichier :
resources/views/accueil.blade.php
Les vues restent donc indépendantes des contrôleurs.

--- Transmettre des données à une vue
Un contrôleur peut préparer des données avant d'afficher une vue.

Exemple :
public function liste()
{
    $employes = [
        [
            "id_employes" => 1,
            "prenom" => "Jean",
            "nom" => "Martin"
        ],
        [
            "id_employes" => 2,
            "prenom" => "Claire",
            "nom" => "Durand"
        ]
    ];

    return view('employes', [
        'employes' => $employes
    ]);
}

La vue reçoit alors automatiquement la variable $employes.
Plus tard, ces données ne proviendront plus d'un tableau PHP, mais d'une base de données via un modèle Eloquent.

--- Les paramètres
Les paramètres définis dans une route sont automatiquement transmis à la méthode du contrôleur.

Route :
Route::get('/employe/{id}', [EmployeController::class, 'fiche']);

Contrôleur :
public function fiche($id)
{
    return "Employé n°".$id;
}
Laravel associe automatiquement le paramètre {id} à la variable $id.

--- Le rôle des contrôleurs dans le modèle MVC
Dans l'architecture MVC :
Model : gère les données.
View : gère l'affichage.
Controller : fait le lien entre les deux.
Le contrôleur reçoit la requête de l'utilisateur, prépare les données nécessaires et choisit la vue à afficher.
Il constitue le point central de la logique de l'application.