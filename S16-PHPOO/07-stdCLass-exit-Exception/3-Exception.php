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