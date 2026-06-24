<?php


/* 

    Les Exception en PHP 

    Les exceptions en PHP permettent de gérer les erreurs et les conditions anormales de manière contrôlée.
    Contrairement aux fatal error qui arrêtent totalement le script, ainsi que les fonctions die/exit, les exceptions offrent un moyen d'intercepter les erreurs et de les traiter proprement
    On pourra également décider de poursuivre ou pas l'exécution du code 

    Pour ça, on utilisera toujours les exceptions via des blocs try/catch 

    Structure de base de la manipulation d'une exception : 

    try : Bloc où l'on place le code qui peut potentiellement générer une exception 
    throw : Lancement d'une exception 
    catch : Intercepte une exception qui vient d'être "throw" et permet de la traiter (nombreuses informations accessibles à l'intérieur de l'objet Exception)
    finally : Est un bloc que l'on peut rajouter après le try/catch qui s'exécutera quoi qu'il en soit, que l'on soit passé dans le catch ou pas 

*/


// On dev une fonction qui a un cas d'erreur défini
// Si on tombe dans ce cas d'erreur, on lancera une exception ! 

function diviser($a, $b)
{
    // cette fonction va faire une division de a par b
    // On connait un cas d'erreur, celui d'une division par zero impossible ! 

    if ($b == 0) {
        // Si je tombe dans mon cas d'erreur ici, je décide de générer une erreur de type "Exception"
        // Exception fait parti de la famille des throwable 
        // On les instancie d'une manière spécifique, avec throw, cela va permettre de faire fonctionner le try/catch
        throw new Exception("Division par zéro interdite ! ");
    }
    return $a / $b;
}

echo diviser(10, 5); // Ici ok c'est bon
echo "<hr>";
// echo diviser(10, 0); // Ici cas d'erreur division par 0 ! 
// Si je suis dans le global scope, alors, un lancement d'exception = fatal error ! 

// Le but de l'exception pour nous, est d'être géré ! Au travers des bloc try/catch, pour ne pas forcément laisser une fatal error, mais faire apparaitre un message d'erreur plus clair 

// je lance mes blocs try/catch
// Dans le bloc try, je peux éxécuter tout le code que je souhaite, si tout va bien, alors pas de problème, on exécute le bloc try en entier et on poursuit notre script
try {
    echo "<h2>Je suis dans le bloc try ! </h2>";

    echo diviser(10, 5); // Ici ok c'est bon
    echo diviser(10, 2); // Ici ok c'est bon
    echo "<p>Coucou</p>";

    // echo diviser(10, 0); // Cette ligne lance l'exception, comme je suis dans un try/catch, alors je vais atterrir dans le catch ! 

    echo "<hr>";
} catch (Exception $e) {
    // Si j'arrive ici c'est qu'une exception a été throw par une instruction dans le try !
    // Auquel cas je récupère l'objet Exception (ça dépends de ce que j'ai défini en param du bloc catch, ici je défini que j'attrape une Exception classique)

    // Il existe d'autres types d'exception, je peux faire plusieurs catch si nécessaire si je gère ces différents types 

    echo "<h2>Je suis dans le bloc catch ! </h2>";
    // var_dump($e);
    // var_dump(get_class_methods($e));
    echo "Erreur : " . $e->getMessage() . " - déclenchée par : " . $e->getTraceAsString() . "<hr>";
} finally { // Le bloc finally s'exécute quoi qu'il en soit 
    echo "<h2>Je suis le finally ! Je m'exécute quoi qu'il arrive ! </h2>";
}

//  Grace à la bonne gestion de l'exception au travers des blocs try/catch, il m'est possible de poursuivre le code ! Contrairement à un fatal error et une exception non caught qui stoppe directement l'execution du code 
echo "<h2>Je suis après le bloc try/catch ! </h2>";