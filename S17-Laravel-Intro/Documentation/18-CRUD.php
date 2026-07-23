<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 17 - Seeders
----------------------------------------------------------------------------

--- Qu'est-ce qu'un CRUD ?
CRUD est l'acronyme de :

Lettre	Action
C	Create
R	Read
U	Update
D	Delete

Ces quatre opérations représentent les actions les plus courantes réalisées sur une base de données.
Dans Laravel, elles sont organisées selon des conventions précises afin de rendre les contrôleurs homogènes et prévisibles.

--- Les méthodes conventionnelles
Laravel propose sept méthodes standard pour gérer une ressource.

Méthode	        Rôle
index()	        Affiche la liste des éléments
show()	        Affiche un élément
create()	    Affiche le formulaire de création
store()	        Enregistre un nouvel élément
edit()	        Affiche le formulaire de modification
update()	    Met à jour un élément existant
destroy()	    Supprime un élément

Respecter ces noms permet de bénéficier des conventions et des générateurs automatiques de Laravel.

--- Le Route Model Binding
Lorsqu'une route contient un identifiant, Laravel peut automatiquement récupérer le modèle correspondant.

Exemple :
public function show(Employe $employe)
{
    return view('employes.show', compact('employe'));
}

Laravel convertit automatiquement le paramètre de la route en objet Employe. En pratique, cela évite d'écrire manuellement une recherche du type :
$employe = Employe::findOrFail($id);
Le code devient plus court, plus lisible et plus sûr.

--- Les formulaires
Les formulaires HTML utilisent principalement les méthodes GET et POST.
Dans Laravel, chaque formulaire qui modifie des données doit inclure un jeton CSRF afin de protéger l'application contre les attaques de type Cross-Site Request Forgery.
On le rajoute au travers de @csrf

--- Le Method Spoofing
Le langage HTML ne prend en charge que les méthodes HTTP GET et POST.
Pour utiliser les méthodes REST (PUT, PATCH et DELETE), Laravel utilise le Method Spoofing.
Exemple pour une mise à jour :
<form method="POST">
    @csrf
    @method('PUT')
</form>

Exemple pour une suppression :
<form method="POST">
    @csrf
    @method('DELETE')
</form>

Laravel interprète alors correctement la requête comme une requête PUT ou DELETE.

--- Les redirections
Après une création, une modification ou une suppression, il est recommandé de rediriger l'utilisateur plutôt que d'afficher directement une vue.

Exemple :
return redirect()->route('employes.index');
Cette pratique évite les doubles soumissions de formulaire et améliore l'expérience utilisateur.

--- Les bonnes pratiques
Respecter les noms des méthodes CRUD (index, store, update, etc.).
Utiliser le Route Model Binding plutôt que de rechercher manuellement les modèles.
Ajouter @csrf à tous les formulaires de modification.
Utiliser @method('PUT'), @method('PATCH') ou @method('DELETE') lorsque nécessaire.
Rediriger après chaque opération d'écriture.

--- Les erreurs fréquentes
Oublier le jeton @csrf.
Utiliser directement method="PUT" ou method="DELETE" dans le HTML.
Continuer à utiliser find() alors que le Route Model Binding suffit.
Retourner une vue après un enregistrement au lieu d'effectuer une redirection.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
organiser un contrôleur selon les conventions CRUD de Laravel ;
utiliser les sept méthodes standard (index, create, store, show, edit, update, destroy) ;
exploiter le Route Model Binding pour récupérer automatiquement un modèle ;
comprendre le rôle du Method Spoofing ;
réaliser un CRUD complet avec Eloquent ;
préparer le terrain pour les routes ressources et les générateurs automatiques qui concluront cette première semaine.

Dernier point, plutôt que de tout créer à la main, Laravel nous propose via Artisan de créer tout le squelette d'un controller avec les  7 méthodes CRUD déjà défini 
php artisan make:controller ProductController --resource 

Egalement, on sera capable de générer les 7 routes CRUD avec la ligne suivante dans notre web.php 
Route::resource('products', ProductController::class);

On peut verifier les routes avec php artisan route:list

Idem, on peut meme avoir la création automatique d'un Model, de sa migration et du Controller en mode ressource CRUD avec l'instruction 
php artisan make:model Order -mrc       mrc voulant dire, migration, resource, controller 


*/