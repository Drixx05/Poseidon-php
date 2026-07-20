<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 5 — Les Vues
----------------------------------------------------------------------------

--- Pourquoi les vues existent-elles ?
Lorsque nous développons un site web, nous devons produire des pages HTML qui seront affichées dans le navigateur de l'utilisateur.

En PHP natif, il est fréquent d'écrire directement du HTML dans les fichiers PHP.
Exemple :
<?php
echo "<h1>Bonjour</h1>";
?>

Cette méthode fonctionne, mais elle mélange rapidement le code PHP et le code HTML.
Lorsque l'application devient plus importante, il devient difficile de s'y retrouver.

Laravel adopte une autre approche.
Il sépare la logique de l'application de son affichage.
La logique est placée dans les routes ou les contrôleurs, tandis que l'affichage est confié à des vues.
Une vue est donc un fichier dont le rôle est de construire la page HTML envoyée au navigateur.

--- Où sont stockées les vues ?
Toutes les vues d'une application Laravel sont placées dans le dossier :
resources/
└── views/
C'est dans ce dossier que nous créerons toutes les pages de notre site.

Par exemple :
resources/
└── views/
    ├── accueil.blade.php
    ├── presentation.blade.php
    ├── employes.blade.php
    └── contact.blade.php

Chaque fichier représente généralement une page de l'application.

--- L'extension .blade.php
Les vues Laravel possèdent généralement l'extension :
.blade.php
Cette extension indique que le fichier pourra utiliser le moteur de template Blade. (voir jour 2)

--- Afficher une vue
Pour afficher une vue, Laravel fournit le helper view().
Exemple :
Route::get('/', function () {
    return view('accueil');
});
Laravel recherche automatiquement le fichier :
resources/views/accueil.blade.php
Il n'est pas nécessaire de préciser le chemin complet ni l'extension.
Laravel les ajoute automatiquement.

--- Le rôle des vues dans l'architecture MVC
Dans le modèle MVC :
Model : gère les données.
View : affiche les données.
Controller : prépare les données et choisit la vue à afficher.

La vue ne doit pas contenir la logique métier de l'application.
Son rôle est uniquement de présenter les informations à l'utilisateur.
Cette séparation rend le code plus lisible, plus réutilisable et plus facile à maintenir.
*/