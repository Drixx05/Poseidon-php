<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 8 - Heritage de templates - Layouts - Partials
----------------------------------------------------------------------------

--- Pourquoi les layouts existent-ils ?

Lorsqu'une application grandit, toutes les pages partagent une grande partie de leur structure :

la balise <html> 
l'en-tête (<head>) 
les liens vers les feuilles de style 
le menu de navigation 
le pied de page.

Si l'on copie ce code dans chaque vue, on introduit une forte duplication. La moindre modification (ajouter un lien dans le menu, changer le logo, intégrer une feuille de style...) doit être reproduite dans toutes les pages.

Les layouts permettent de centraliser cette structure commune.

--- Qu'est-ce qu'un layout ?
Un layout est une vue servant de modèle aux autres vues.

Il contient le squelette HTML commun à toute l'application :
le <head> 
les ressources CSS et JavaScript 
les éléments communs (navigation, pied de page) 
un ou plusieurs emplacements réservés au contenu des pages.

Les vues n'ont plus qu'à fournir leur contenu spécifique.
@extends
@extends indique qu'une vue hérite d'un layout.

@extends('layouts.app')
Laravel charge d'abord le layout, puis y insère le contenu de la vue.

@section
Une section définit un bloc de contenu destiné à remplacer une zone du layout. (elle définit par @yield)

@section('content')
<h1>Accueil</h1>
@endsection
Une vue peut définir plusieurs sections (title, content, etc.).

@yield
Dans le layout, @yield marque un emplacement qui sera rempli par une section portant le même nom.
<title>@yield('title')</title>
<div class="container">
    @yield('content')
</div>


--- Pourquoi utiliser des partials ?
Même avec un layout, certains éléments restent réutilisables indépendamment.
Le menu de navigation, le footer ou une alerte peuvent être extraits dans des vues dédiées.
Cela évite de les dupliquer et facilite leur maintenance.

@include
La directive @include insère simplement le contenu d'une autre vue.

Exemple :
@include('partials.navbar')
Laravel remplace cette directive par le contenu de resources/views/partials/navbar.blade.php.
Une vue incluse est appelée partial.

--- Les bonnes pratiques
Un seul layout principal pour l'application. (libre à nous d'avoir d'autres layout ensuite)
Des partials pour les éléments réutilisables.
Des vues organisées par fonctionnalité (pages, employes, services, etc.).
Utiliser @extends pour les pages complètes et @include pour les petits morceaux de vue.

--- Les erreurs fréquentes
Oublier @extends.
Définir une section sans @yield correspondant.
Se tromper dans le nom des sections.
Copier le menu dans chaque vue au lieu d'utiliser un partial.
Mélanger le rôle d'un layout et celui d'un partial.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
pourquoi éviter la duplication de HTML 
créer un layout 
utiliser @extends, @section et @yield 
créer des partials 
insérer une vue avec @include.

Les layouts et les partials ont longtemps été la manière standard de construire des interfaces Laravel. Ils restent très utilisés et il est essentiel de les connaître. Cependant, les versions récentes de Laravel encouragent de plus en plus l'utilisation des composants Blade, qui offrent une approche plus moderne, plus réutilisable et plus proche des composants que l'on retrouve dans les frameworks JavaScript.
*/