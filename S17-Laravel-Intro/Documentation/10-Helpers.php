<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 10 - Helpers
----------------------------------------------------------------------------

--- Pourquoi les helpers existent-ils ?
Lorsque nous développons une application Laravel, certaines opérations reviennent constamment :
générer une URL 
afficher la date 
accéder à un fichier 
récupérer une ancienne valeur de formulaire 
rediriger vers une page.

Nous pourrions écrire nous-mêmes le code nécessaire à chaque fois.
Laravel fournit cependant des fonctions toutes prêtes appelées helpers.
Les helpers sont de petites fonctions globales qui simplifient énormément le développement.
Ils permettent d'écrire un code plus court, plus lisible et plus expressif.

--- Qu'est-ce qu'un helper ?
Un helper est une fonction PHP disponible partout dans Laravel.
Contrairement à une méthode de classe, un helper peut être appelé directement.

Exemple :
route('home')
ou
asset('images/logo.png')

Ils peuvent être utilisés :
dans Blade 
dans les contrôleurs 
dans certaines classes Laravel.

--- Le helper route()
C'est probablement le helper le plus utilisé.
Il permet de générer automatiquement l'URL d'une route nommée.
<a href="{{ route('home') }}">
Accueil
</a>
Au lieu d'écrire :
href="/"
on utilise le nom de la route.
Ainsi, si l'URL change un jour, aucune vue n'a besoin d'être modifiée.
Avec paramètres
route('employes.show',1)
ou
route('employes.show',$id)
Laravel construit automatiquement l'URL.

--- Le helper asset()
Permet de générer l'URL d'un fichier présent dans le dossier public.
Exemple :
<img src="{{ asset('images/logo.png') }}">
Laravel générera automatiquement la bonne URL.

--- Le helper url()
Retourne une URL complète.
{{ url('/') }}
Retourne :
http://localhost:8000

--- Le helper now()
Retourne la date actuelle.
{{ now() }}
ou
{{ now()->format('d/m/Y') }}
Très pratique dans les vues.

--- Le helper old()
Très utilisé avec les formulaires.
Il permet de réafficher une valeur précédemment saisie.
Nous le reverrons pendant la semaine 2.
Exemple :
value="{{ old('nom') }}"

--- Le helper csrf_field()
Laravel protège automatiquement les formulaires.
Ce helper génère le token CSRF.
En Blade, on utilise presque toujours :
@csrf

--- Les fonctions PHP
Blade accepte également les fonctions PHP classiques.
Exemple :
{{ strtoupper($nom) }}
{{ strtolower($nom) }}
{{ ucfirst($nom) }}
{{ count($employes) }}
{{ number_format($salaire,2,","," ") }}
{{ date('d/m/Y') }}
Laravel n'empêche absolument pas d'utiliser les fonctions PHP.

--- Les bonnes pratiques
privilégier les helpers Laravel lorsqu'ils existent ;
utiliser les routes nommées avec route() plutôt que d'écrire les URL à la main ;
éviter les calculs complexes directement dans Blade.

--- Ce qu'il faut retenir
Pendant cette semaine nous utiliserons principalement :
Helper	        Utilité
route()	        Générer une URL
asset()	        Accéder à un fichier public
url()	        URL complète
now()	        Date actuelle
old()	        Ancienne valeur d'un formulaire
@csrf	        Protection des formulaires

*/