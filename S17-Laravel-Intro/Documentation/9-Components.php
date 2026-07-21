<?php 
/* 
----------------------------------------------------------------------------
----------------------------------------------------------------------------
----------------------------------------------------------------------------
Chapitre 9 - Components
----------------------------------------------------------------------------


--- Pourquoi les composants existent-ils ?
Les layouts permettent d'éviter de répéter la structure générale d'une page.
Les partials permettent de réutiliser de petits morceaux de vues, comme un menu ou un pied de page.
Cependant, ils présentent une limite : ils ne sont pas pensés pour créer des éléments d'interface réutilisables avec leur propre logique et leurs propres données.
Prenons l'exemple d'une carte Bootstrap affichant les informations d'un employé.
Si cette carte est utilisée à plusieurs endroits de l'application, copier son code HTML dans chaque vue devient rapidement difficile à maintenir.
Les composants Blade répondent à ce besoin. Ils permettent de créer des éléments d'interface autonomes, réutilisables et personnalisables.

--- Qu'est-ce qu'un composant Blade ?
Un composant Blade est un élément d'interface réutilisable composé :
d'une vue Blade ;
éventuellement d'une classe PHP.
Il encapsule une portion de l'interface que l'on souhaite réutiliser plusieurs fois dans une application.
Un composant peut recevoir des données (appelées props) et afficher un contenu variable grâce aux slots.
Les composants favorisent une architecture plus modulaire et plus lisible.


--- Comment fonctionne un composant ?
Le développeur crée un composant une seule fois.
Il peut ensuite l'utiliser partout dans l'application grâce à une balise Blade.
Exemple :
<x-alert>
    Bienvenue !
</x-alert>
Laravel remplace automatiquement cette balise par le contenu du composant.


--- Créer un composant
Les composants sont générés avec Artisan :
php artisan make:component Alert
Laravel crée automatiquement :
app/
└── View/
    └── Components/
        └── Alert.php

resources/
└── views/
    └── components/
        └── alert.blade.php

La classe contient la logique éventuelle du composant, tandis que la vue définit son affichage.

--- Utiliser un composant
Une fois créé, le composant s'utilise avec la syntaxe <x-...> :
<x-alert>
    Bienvenue sur notre site !
</x-alert>
Cette syntaxe est propre à Blade et rend le code très lisible.

--- Les props
Un composant peut recevoir des données grâce à des attributs.
Par exemple, un composant EmployeCard peut recevoir le prénom, le nom, le service et le salaire d'un employé.
<x-employe-card
    :prenom="$employe['prenom']"
    :nom="$employe['nom']"
    :service="$employe['service']"
    :salaire="$employe['salaire']"
/>
Ces valeurs deviennent automatiquement accessibles dans la vue du composant.
(pour ça il faudra aussi les définir dans la classe du composant, et également dans le constructeur)

--- Le slot
Le slot représente le contenu placé entre les balises du composant.
Exemple :
<x-alert>
    Employé créé avec succès !
</x-alert>

Dans le composant :
<div class="alert alert-success">
    {{ $slot }}
</div>

Laravel remplace {{ $slot }} par le contenu fourni lors de l'appel du composant.
Le slot est particulièrement utile pour créer des éléments génériques comme des alertes, des panneaux ou des cartes.

--- Components ou Includes ?

Les deux mécanismes permettent de réutiliser du code, mais ils n'ont pas le même objectif.
Include	                                    Component
Réutilise une vue	                        Réutilise un élément d'interface
Pas de classe dédiée	                    Classe PHP possible
Peu de personnalisation	                    Props et slots
Idéal pour une navbar ou un footer	        Idéal pour une carte, une alerte, un bouton, une modale…

En pratique, on utilise souvent les deux dans un même projet.

--- Les bonnes pratiques
Créer un composant lorsqu'un même bloc HTML est répété plusieurs fois.
Donner un nom explicite au composant (EmployeCard, Alert, Badge…).
Limiter le composant à une responsabilité précise.
Préférer les composants aux includes lorsque des données doivent être transmises.
Garder les traitements complexes dans les contrôleurs ou les classes du composant.

--- Les erreurs fréquentes
Confondre @include et un composant.
Oublier de transmettre les données nécessaires au composant.
Écrire toute la logique métier directement dans le composant.
Créer un composant pour un élément qui ne sera utilisé qu'une seule fois.

--- Ce qu'il faut retenir
À l'issue de ce chapitre, nous savons :
créer un composant avec Artisan ;
comprendre la différence entre un include et un composant ;
utiliser un composant avec la syntaxe <x-...> ;
transmettre des données grâce aux props ;
utiliser un slot simple ;
créer des composants réutilisables pour construire des interfaces propres et modulaires.
*/

