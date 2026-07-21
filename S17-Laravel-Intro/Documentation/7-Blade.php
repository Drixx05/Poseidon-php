<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 7 — Blade
----------------------------------------------------------------------------

--- Pourquoi Blade existe-t-il ?
Lors du chapitre précédent, nous avons découvert les vues Laravel.
Une vue est simplement un fichier chargé de produire le code HTML envoyé au navigateur.
Au départ, nos vues étaient composées uniquement de HTML.

Par exemple :
<h1>Liste des employés</h1>
<p>Bienvenue sur notre site.</p>


Nous avons souvent besoin :
d'afficher des données provenant d'un contrôleur 
de parcourir une liste d'éléments 
d'afficher certaines parties de la page uniquement sous certaines conditions 
de réutiliser des portions de mise en page.

Écrire uniquement du HTML ne suffit donc plus.

Une première idée pourrait être d'écrire directement du PHP dans la vue.

Exemple :
<h1>
<?php echo $titre; ?>
</h1>
ou encore :
<?php
foreach($employes as $employe)
{
    echo $employe["prenom"];
}
?>
Cette solution fonctionne.
Mais très rapidement, le HTML et le PHP deviennent mélangés.
Les vues deviennent difficiles à lire et à maintenir.

Laravel propose alors Blade, son moteur de template.

--- Qu'est-ce que Blade ?
Blade est le moteur de template officiel de Laravel.
Un moteur de template est un outil qui permet d'écrire des vues dynamiques avec une syntaxe plus simple, plus lisible et plus agréable que le PHP traditionnel.

Blade n'est pas un nouveau langage.
Il s'agit simplement d'une syntaxe qui sera automatiquement transformée en PHP par Laravel avant d'être exécutée.

Autrement dit :
Le développeur écrit du Blade.
Laravel le convertit automatiquement en PHP.
Le navigateur reçoit finalement uniquement du HTML.

--- Comment fonctionne Blade ?
Le fonctionnement peut être résumé ainsi :

Contrôleur
↓
Données
↓
Vue Blade (.blade.php)
↓
Compilation automatique
↓
PHP
↓
HTML
↓
Navigateur

Le développeur n'a jamais besoin de compiler Blade lui-même.
Laravel s'en charge automatiquement.

--- Pourquoi utiliser Blade ?
Blade présente de nombreux avantages.

Une syntaxe plus lisible.
Beaucoup moins de code PHP dans les vues.
Une meilleure séparation entre la logique et l'affichage.
Une protection automatique contre les attaques XSS.
Une intégration complète avec Laravel.

Aujourd'hui, Blade est utilisé dans quasiment tous les projets Laravel

--- Où trouve-t-on Blade ?
Toutes les vues Blade sont placées dans :
resources/views
Les fichiers possèdent généralement l'extension :
.blade.php

Exemple :
resources/views
accueil.blade.php
contact.blade.php
employes/index.blade.php
services/show.blade.php

--- Le rôle de Blade dans l'architecture MVC
Dans Laravel :
Le contrôleur prépare les données.
Blade les affiche.
Le contrôleur ne construit jamais le HTML.
Inversement, Blade ne doit jamais contenir de logique métier importante.
Chaque couche possède sa responsabilité.

--- Les variables
Une variable est affichée grâce aux doubles accolades.

Exemple :
{{ $titre }}

Blade remplace automatiquement cette instruction par le contenu de la variable.
Exemple :
$titre = "Liste des employés";

produira :
Liste des employés

--- L'échappement automatique
Par défaut, Blade protège les données affichées.
Exemple :
$titre = "<strong>Bonjour</strong>";

Puis :
{{ $titre }}

Le navigateur affichera :
<strong>Bonjour</strong>
Le HTML n'est pas interprété.
Cette protection évite les attaques XSS.

C'est le comportement recommandé dans la très grande majorité des cas.

--- Afficher du HTML sans échappement
Il est également possible d'afficher directement du HTML.

Syntaxe :
{!! $contenu !!}
Cette fois, le navigateur interprétera le code HTML.
Cette syntaxe doit être utilisée avec beaucoup de prudence.
Elle ne doit jamais servir à afficher directement des données saisies par un utilisateur.

--- Les commentaires Blade
Blade possède son propre système de commentaires.

Syntaxe :
{{-- Ceci est un commentaire --}}
Contrairement aux commentaires HTML, ils disparaissent totalement lors du rendu de la page.
Ils ne sont donc jamais visibles dans le code source du navigateur.

--- Les conditions
Blade simplifie énormément les structures conditionnelles.

if :
@if($admin)
<p>Administration</p>
@endif

if / else :
@if($admin)
<p>Administration</p>
@else
<p>Espace public</p>
@endif

elseif :
@if($note >=16)
Très bien
@elseif($note >=10)
Admis
@else
Échec
@endif

unless :
@unless est l'inverse de @if.

@unless($admin)
<p>Accès interdit.</p>
@endunless

Equivalent à :
if(!$admin)

--- Les boucles
foreach
La boucle la plus utilisée.

@foreach($employes as $employe)
<p>
{{ $employe["prenom"] }}
</p>
@endforeach

forelse
Très pratique lorsque le tableau peut être vide.
@forelse($employes as $employe)
<p>{{ $employe["prenom"] }}</p>
@empty
<p>Aucun employé.</p>
@endforelse

for
@for($i=0;$i<5;$i++)
...
@endfor

while
@while($condition)
...
@endwhile

Ces deux directives existent mais sont beaucoup moins utilisées que @foreach.

--- Les helpers et expressions PHP
Les doubles accolades peuvent contenir n'importe quelle expression PHP.
Exemple :
{{ strtoupper($titre) }}
{{ count($employes) }}
{{ date("d/m/Y") }}

Les helpers Laravel peuvent également être utilisés.
Exemple :
{{ route('services.index') }}
ou :
<a href="{{ route('services.show', 1) }}">
    Voir le service
</a>

--- La directive @php
Il est possible d'écrire du PHP directement dans Blade.

Exemple :
@php
$total = count($employes);
@endphp

Cette possibilité existe mais doit rester exceptionnelle.
La logique de calcul doit normalement rester dans le contrôleur.
Une vue ne devrait contenir que du code lié à l'affichage.

--- Autres directives utiles
Blade propose de nombreuses autres directives.

Les plus courantes sont :

@isset()
@endisset
Permet de vérifier qu'une variable existe.

@empty()
@endempty
Permet de vérifier qu'une variable est vide.

@switch()
@case()
@break
@default
@endswitch
Alternative au switch PHP.

--- Les bonnes pratiques
Lorsque vous utilisez Blade :

préparez toujours les données dans le contrôleur ;
utilisez Blade uniquement pour l'affichage ;
laissez l'échappement automatique activé ({{ }}) sauf cas très particuliers ;
évitez d'écrire du PHP directement dans les vues ;
privilégiez @foreach/@forelse pour parcourir les collections/array.

Une vue doit rester simple à lire.

--- Les erreurs fréquentes
Oublier le symbole $ devant une variable.
Confondre {{ }} et {!! !!}.
Écrire une boucle PHP classique alors que Blade propose @foreach.
Réaliser des calculs complexes dans la vue au lieu du contrôleur.
Mélanger logique métier et affichage.
Oublier une directive de fermeture (@endif, @endforeach, etc.).

--- Ce qu'il faut retenir

À l'issue de ce chapitre, nous savons :
comprendre le rôle de Blade ;
afficher des variables ;
utiliser les structures conditionnelles ;
parcourir un tableau avec @foreach ;
utiliser @forelse lorsqu'une liste peut être vide ;
écrire des commentaires Blade ;
appeler des fonctions PHP et des helpers Laravel ;
comprendre les bonnes pratiques d'utilisation de Blade.
*/