<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrainement PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Syntaxe PHP</h2>

        <!-- Il est possible d'écrire de l'html dans un fichier.php 
         En revanche, l'inverse n'est pas possible ! -->

        <?php
        // Ouverture de la balise PHP 

        // Ceci est un commentaire sur une ligne
        # Ceci est un commentaire sur une ligne 
        /* 
                Commentaire
                    entre les deux indicateurs 
            */


        // Le documentation officielle : 
        // https://www.php.net/

        // Les bonnes pratiques et conventions d'écriture : 
        // https://phptherightway.com/


        echo "<h2>01 - Instruction d'affichage</h2>";
        // echo est une instruction du langage permettant de générer un affichage 

        // ATTENTION chaque instruction se termine par un point virgule 
        echo "Bonjour";
        echo " à tous";
        echo "<br>";

        print "Nous sommes lundi<br>"; // Autre instruction permettant de générer un affichage, quasi similaire à echo
        // On utilisera toujours echo ! 

        echo "<h2>02 - Variables : déclaration / affectation / type</h2>";

        // En PHP on déclare les variables avec le signe $ 
        // Caractères autorisés : minuscules, majuscules, chiffres, underscore _  
        // PHP est sensible à la casse (une minuscule n'est pas équivalente à une majuscule)

        $a = 123; // Déclaration de la variable nommée "a" et affectation de la valeur numérique 123 
        echo $a;
        echo gettype($a);
        echo "<br>";

        $a = 1.5; // On change la valeur contenue dans la variable $a 
        echo $a;
        echo gettype($a); // double ou float = chiffre décimal
        echo "<br>";

        $a = "Une chaine";
        echo $a;
        echo gettype($a); // string = chaine de caractère
        echo "<br>";

        $a = true;
        echo $a;
        echo gettype($a); // boolean // vrai ou faux // 1 ou 0 
        echo "<br>";

        echo "<h2>03 - Concaténation</h2>";
        // La concaténation consiste à assembler des chaines de caractères (sous forme de texte ou comprisent dans des variables) les uns avec les autres 
        // Caractère de concaténation : le point  .   (il est possible aussi de concaténer avec la virgule, mais on évite ! on préfère le point)

        $x = "Bonjour";
        $y = "tout le monde";

        // Sans concaténation : 
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concaténation 
        echo $x . " " . $y . "<br>";
        echo $x, " ", $y, "<br>";

        // Concaténation lors de l'affectation 
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Cela écrase la valeur précédente
        echo $prenom . "<br>";

        // Pour rajouter sans écraser :
        $prenom = "Pierre";
        $prenom = $prenom . "-Alexandre";
        echo $prenom . "<br>";
        // Raccourci d'écriture
        $prenom = "Pierre";
        $prenom .= "-Alexandre"; // Avec le .= on rajoute sans écraser
        echo $prenom;

        echo "<h2>04 - Guillemets et apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        echo "$x $y <br>"; // Entre les guillemets en PHP, les variables sont interprétées !
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";
        // une constante comme une variable permet de conserver une valeur
        // Cependant, comme son nom l'indique, cette valeur restera... constante ! 
        // Une fois définie, on ne pourra plus changer sa valeur 
        // par convention d'écriture les constantes sont toujours en MAJUSCULE 

        // Declaration d'une constante globale avec define() 

        define("URL", "http://www.monsite.fr");
        echo URL . "<br>";

        // Ici une constante définissant le lien racine de projet, pour travailler en URL absolue
        // Par exemple
        //  <a href="URL/dossier/contact.php">Contact</a>

        // URL = "qqchoz"; // Syntax error
        // define("URL", "coucou"); // Duplicate symbol

        // On ne peut pas changer la valeur d'une constante

        // Constantes magiques 
        // Déjà inscrites au langage 

        echo __FILE__ . "<br>";
        echo __LINE__ . "<br>";
        echo __DIR__ . "<br>";

        echo "<h2>Opérateurs arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition :
        echo $a + $b . "<br>";
        // Soustraction
        echo $a - $b . "<br>";
        // Multiplication
        echo $a * $b . "<br>";
        // Division
        echo $a / $b . "<br>";

        // Modulo : 
        echo $a % $b . "<br>";
        // Puissance : 
        echo $a ** $b . "<br>";

        // Opération / affectation 
        $a += $b; // Equivaut à dire $a = $a + $b;
        $a -= $b; // Equivaut à dire $a = $a - $b;
        $a *= $b; // Equivaut à dire $a = $a * $b;
        $a /= $b; // Equivaut à dire $a = $a / $b;
        $a %= $b; // Equivaut à dire $a = $a % $b;
        $a **= $b; // Equivaut à dire $a = $a ** $b;

        echo "<h2>06 - Conditions & opérateurs de comparaison</h2>";

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // si la valeur de x est strictement supérieure à la valeur de y 
            echo "VRAI, la valeur de x est strictement supérieure à la valeur de y <br>";
        } else {
            echo "FAUX<br>";
        }

        // Plusieurs conditions obligatoires :  AND ou && 
        if ($x > $y && $y > $z) {
            echo "VRAI, les deux conditions sont bonnes !<br>";
        } else {
            echo "FAUX<br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR ou ||
        if ($x > $y || $y < $z) {
            echo "VRAI, au moins une des deux conditions est bonne !<br>";
        } else {
            echo "FAUX<br>";
        }

        // Seulement l'une ou l'autre des conditions, si les deux sont fausses, c'est refusé, si les deux sont vraies, c'est refusé aussi ! Seulement une acceptée ! 
        if ($x < $y xor $y > $z) {
            echo "VRAI, une seule des conditions est bonne !<br>";
        } else {
            echo "FAUX<br>";
        }


        // if / elseif / else 
        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) {
            echo "Réponse A<br>";
        } elseif ($x != 10) {
            echo "Réponse B<br>";
        } elseif ($y == $z) {
            echo "Réponse C<br>";
        } else {
            echo "Réponse D<br>";
        }

        // Comparaison stricte
        $a = 1;
        $b = "1";

        // Comparaison des valeurs uniquement
        if ($a == $b) {
            echo "OK, les deux variables ont la même valeur (peu importe leur type) !<br>";
        } else {
            echo "Non, les deux variables sont différentes<br>";
        }

        // Comparaison stricte valeurs ET type 
        if ($a === $b) {
            echo "OK, les deux variables ont la même valeur ET le meme type !<br>";
        } else {
            echo "Non, les deux variables sont différentes en valeur et/ou en type<br>";
        }

        /*
            Opérateurs de comparaison
            ------------------------------
            =       affectation (ce n'est pas un opérateur de comparaison, c'est une affectation)
            ==      est égal à
            !=      est différent de
            ===     est strictement égal à (valeur et type)
            !==     est strictement différent de (valeur et/ou type différent)
            >       strictement supérieur à
            >=      supérieur ou égal à
            <       strictement inférieur à
            <=      inférieur ou égal

        */

        // Deux outlis de controle que l'on utilise régulièrement avec des if en PHP : 
        // isset() & empty() 
        // isset() permet de savoir si une information/variable/element existe  return true si existe, false si existe pas
        // très régulièrement utilisé pour vérifier que l'on reçoit bien des variables nommées de façon attendu par rapport à notre form et qu'aucune n'est manquante
        // empty() permet de savoir si une information est vide (en même temps de savoir si elle existe) true si vide, false si plein
        // Pour vérifier si un élément à saisi obligatoire est bien saisi

        $psudo = "Bob";
        if (isset($pseudo)) { // Je rentre ici uniquement si la variable $pseudo existe
            echo "La variable pseudo est bien existante !<br>";
        } else {
            echo "La variable pseudo n'existe pas !<br>";
        }

        $prenom = "Piero";

        if (empty($prenom)) {
            echo "Attention, il faut absolument saisir votre prénom !<br>";
        } else {
            echo "Oui ok le prénom est bien saisi <br>";
        }

        $pseudoForm = "Boby";
        // Ci dessous un raccourci d'écriture pour faire un if isset 
        $pseudo = $pseudoForm ?? "Pas de pseudo";

        // Autres possibilités de syntaxe pour les if 

        if ($a === $b) {
            echo "Ok, ces deux variables ont la meme valeur et type <br>";
        } // Si on a pas besoin de traiter le else, on ne l'écrit pas ! 

        // On peut ne pas mettre les accolades mais on est limité à une seule instruction dans le if et une dans le else
        if ($a === $b) echo "Ok, ces deux variables ont la meme valeur et type <br>";
        else echo "Non, les deux variables sont différentes en valeur et/ou en type<br>";


        // Ici on remplace les accolades par des ":" et une instruction "end" ici "endif"  existe aussi pour les boucles avec endfor, endwhile, endforeach
        // On l'utilise régulièrement pour lisibilité lorsque l'on referme php pour faire de gros blocs html et on le reouvre plus bas
        // Il sera plus lisible de lire un endif; plutôt qu'une accolade fermante perdue au milieu du reste 
        if ($a === $b) : ?>
            <ul>
                <li>OK</li>
                <li>Les variables</li>
                <li>ont la meme valeur</li>
                <li>et</li>
                <li>le meme type</li>
            </ul>

        <?php else : ?>
            Non, les deux variables sont différentes en valeur et/ou en type<br>

        <?php
        endif;


        // Ecriture ternaire 
        echo ($a === $b) ? "Ok, ces deux variables ont la meme valeur et type <br>" : "Non, les deux variables sont différentes en valeur et/ou en type<br>";
        // On utilise un if ternaire lorsque les deux cas du if/else partagent la même action, ici c'est un echo d'une phrase ou d'une autre

        echo "<h2>Conditions switch</h2>";
        // Autre outil permettant de mettre en place des conditions 

        // Avec une condition switch on donne un ensemble de cas possibles
        // Se prête uniquement à tester différentes valeurs d'une même variable 

        $couleur = "vert";
        switch ($couleur) {
            case "bleu":
                echo "Vous aimez le bleu<br>";
                break;
            case "rouge":
                echo "Vous aimez le rouge<br>";
                break;
            case "vert":
                echo "Vous aimez le vert<br>";
                break;
            default: // équivalent au else 
                echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
                break;
        }

        // EXERCICE :  Refaire cette condition switch mais en if / elseif / else 

        $couleur = "rouge";

        if ($couleur == "bleu") echo "Vous aimez le bleu<br>";
        elseif ($couleur == "rouge") echo "Vous aimez le rouge<br>";
        elseif ($couleur == "vert") echo "Vous aimez le vert<br>";
        else echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";

        echo "<h2>07 - Fonctions prédéfinies</h2>";

        // Inscrites au langage, le développeur ne fait que les exécuter !
        // Ce qu'on a besoin de savoir ? Le nombre de paramètres et leurs types puis le type du return de la fonction (ce qui sort de la fonction)

        // Fonction date() 
        // Permet d'afficher la date du jour en choisissant un format spécifique
        echo "Nous sommes le : " . date("d/m/Y") . "<hr>";
        // Deuxième param facultatif mais possible à fournir, une date à formater en timestamp (nombre de secondes depuis le 1er janvier 70)
        echo "Une date formatée : " . date("d/m/Y H:i:s", strtotime("2022-05-05")) . "<br>";

        // strlen() / iconv_strlen()
        // Permettent de compter le nombre de caractères dans une chaine 

        echo strlen("Mélanie") . "<br>"; // strlen compte le nombre d'octet, (un caractère spécial vaut plusieurs octets, tout dépends des encodages)
        echo iconv_strlen("Mélanie") . "<br>"; // iconv_strlen compte le nombre réel de charactères


        echo "<h2>08 - Fonctions utilisateurs</h2>";

        // Déclarées et exécutées par le développeur
        // On développe nos propres fonctions ! 

        // Fonction toute simple permettant d'afficher 3 <hr>
        function separateur()
        {
            echo "<hr><hr><hr>";
        }

        separateur();

        // Fonction avec argument (param/paramètre/variable de réception)
        // Fonction pour dire bonjour à un utilisateur saisi
        function dire_bonjour(string $qui): string
        {
            return "Bonjour $qui, bienvenue sur notre site <hr>";
        }

        echo dire_bonjour("Pierra");
        $pseudo = "Bob";
        echo dire_bonjour($pseudo);

        // Fonction permettant de calculer le prix TTC 
        function applique_tva($prix)
        {
            return "Le montant TTC pour le prix $prix est de : " . ($prix * 1.2) . "€<hr>";
        }

        echo applique_tva(100);
        echo applique_tva(500);

        // EXERCICE : Refaire cette fonction mais en permettant de choisir aussi le taux de TVA à appliquer - sous forme d'entier 
        // Une fois cela fait, faire en sorte de rendre ce choix de taux facultatif, auquel cas, le taux par défaut sera celui de 20%

        function apply_and_choose_tva(int $prix, ?int $rate = null): string
        {
            // Ici une fonction déclarée à l'intérieur de l'autre fonction et insérée dans une variable
            // C'est rare et assez particulier 

            $apply_rate_conversion = function (int $prix, ?int $rate = null): float {
                if (empty($rate)) {
                    return $prix * 1.2;
                } else {
                    return $prix + ($prix / 100) * $rate;
                }
            };
            return "Le prix TTC pour le $prix est de " . $apply_rate_conversion($prix, $rate) . "€<hr>";
        }

        echo apply_and_choose_tva(1000);

        function applique_tva_taux(float $prix, ?float $taux = 20): string
        {
            return "Le montant TTC pour le prix $prix au taux de $taux % est de " . ($prix * (1 + ($taux / 100))) . "€<hr>";
        }

        echo applique_tva_taux(2000);
        echo applique_tva_taux(2000, 5.5);

        // function meteo 
        function meteo($saison, $temperature)
        {
            $debut = "Nous sommes en " . $saison;
            $suite = " et il fait " . $temperature . " degré(s)<hr>";

            return $debut . $suite;
        }

        separateur();

        echo meteo("été", 35);
        echo meteo("printemps", 20);
        echo meteo("hiver", 1);
        echo meteo("automne", 12);

        // EXERCICE : Refaire cette fonction en gérant le 'en' printemps qui devrait être 'au' printemps et aussi le pluriel (le s) sur degré, doit il y est quand c'est une température au pluriel, soit il n'y est pas 
        function meteo2($saison, $temperature)
        {
            if ($saison == 'printemps') {
                $debut = 'Nous sommes au ' . $saison;
            } else {
                $debut = 'Nous sommes en ' . $saison;
            }

            // if($temperature == 0 || $temperature == 1 || $temperature == -1) {
            // if (abs($temperature) <= 1) {  // abs nous donne la valeur absolue du nombre fourni en argument
            if ($temperature >= -1 && $temperature <= 1) {
                $suite = ' et il fait ' . $temperature . ' degré<hr>';
            } else {
                $suite = ' et il fait ' . $temperature . ' degrés<hr>';
            }

            return $debut . $suite;
        }


        function new_meteo($saison, $temperature)
        {

            $liaison = ($saison == "printemps") ? "au" : "en";
            $degre = ($temperature > 1 or $temperature < -1) ? " degrés<hr>" : " degré<hr>";

            return "Nous sommes $liaison $saison et il fait $temperature $degre";
        }

        function meteo3($saison, $temperature)
        {
            $art = ($saison == "printemps") ? "au" : "en";
            $s = (abs($temperature) <= 1) ? "" : "s";

            return "Nous sommes $art $saison et il fait $temperature degré$s <hr>";
        }

        function meteo4($saison, $temperature)
        {
            return "Nous sommes "
                . ($saison == "printemps" ? "au" : "en")
                . " $saison et il fait $temperature "
                . ($temperature > 1 || $temperature < -1 ? "degrés" : "degré")
                . "<hr>";
        }


        // ENVIRONNEMENT (scope)
        // Global : le script complet
        // Local : à l'intérieur d'une fonction/classe/méthode

        // L'existence d'une variable dépends de l'environnement dans laquelle on la déclare 
        // Une variable déclarée dans un espace local, n'existe QUE dans cet espace 

        separateur();

        $animal = "chat"; // Variable dans le scope global
        echo $animal . "<hr>";

        function foret(): string
        {
            $animal = "chien"; // Variable dans le scope local, elle n'existe que dans la function
            return $animal; // return uniquement de la valeur de la variable ! La variable locale elle même ne sort pas de la fonction
        }

        echo $animal; // chat 
        foret(); // rien ne se passe, pas d'echo, pas de traitement, rien, un string est return et perdu (non traité)
        echo $animal; // chat
        echo foret(); // chien
        echo $animal; // chat
        $animal = foret(); // Uniquement ici, changement de valeur de la variable $animal globale par la valeur return de la function
        echo $animal; // chien

        separateur();

        $pays = "France"; // Variable dans le scope global

        function affiche_pays()
        {
            global $pays; // Avec global, il est possible de récupérer une variable du scope global pour la manipuler dans la fonction
            $pays = "Japon";
        }

        echo $pays; // France

        affiche_pays(); // En executant cette fonction, je peux changer la valeur de la variable globale 

        echo $pays; // Japon

        separateur();

        // phpinfo();

        // Il est possible de typer les params d'une fonction ainsi que son return 
        function identite(string|null $nom, int|float $age = 0, int $cp = 0): string
        {
            return "$nom a $age ans et habite dans le $cp<br>";
        }

        // Malgré que PHP soit un langage flexible, si je lui fourni des types trop différents, alors j'aurai des erreurs de type !
        echo identite("Pierra", 38, 64);

        // Depuis PHP 9 on peut aussi appeler les arguments par leur nom, ce qui évite de tous les citer (surtout lorsqu'on a de nombreux param facultatifs)
        echo identite(nom: "Lolo", cp: 34000);

        echo "<h2>09 - Structure itérative : Boucles </h2>";

        // Boucle for = boucle avec compteur numérique
        // 3 infos dans la boucle for, initialisation du compteur, condition d'entrée, incrémentation/décrémentation

        for ($i = 0; $i < 10; $i++) {
            echo "$i ";
        }

        for ($i = 0; $i < 10; $i++) :
            echo "$i ";
        endfor;

        separateur();

        // Boucle while = boucle pas forcément avec un compteur numérique

        $i = 0;
        while ($i < 10) {
            echo "$i ";
            $i++;
        }

        $i = 0;
        while ($i < 10) :
            echo "$i ";
            $i++;
        endwhile;

        $i = 0;
        while ($i < 100) {
            echo "$i ";
            if ($i == 20) {
                break; // On sort de la boucle
            }
            $i++;
        }

        separateur();

        // Boucle do while = test de la condition à la fin de la boucle
        // Ce qui veut dire, le code de la boucle s'exécute toujours au moins une fois 
        $i = 10; // i = 10 donc la condition n'est pas respectée mais, on exécute quand meme une fois le do avant de tester la condition
        do {
            echo "$i ";
        } while ($i < 10);


        separateur();
        // EXERCICES : 
        for($i = 0; $i < 10; $i++) {
            echo $i . " - ";
        }

        // 1 - Modificer cette boucle pour ne pas avoir le tiret à la fin du 9 
        // Actuel : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 -
        // Attendu : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9

        // 2 - Afficher des nombres allant de 1 à 100

        // 3 - Afficher des nombres allant de 1 à 100 avec le chiffre 50 en rouge 

        // 4 - Afficher des nombres allant de 2000 à 1930

        // 5 - Afficher le titre suivant "<h2> Je m'affiche pour la Nème fois</h2>"
            // Remplacer le N avec la valeur du tour de boucle pour écrire 1ère 2ème 3ème etc 

        function apply_and_chose_tva(int $prix, ?int $rate = null) : string {
         $applyrateconversion = function(int $prix, ?int $rate = null) : float {
               if (isempty($rate)) {
                  return $prix * 1.2;
              } else { 
                  return $prix + $prix / 100 * $rate;
              }
            };
         return "Le montant TTC pour le prix $prix est de : " . $applyrateconversion($prix, $rate) . "€<hr>";
        }

        function apply_VAT(float $price, ?int $rate = 20) : string {
            return "Le montant TTC pour le prix $price est de : " . ($price * (1 + $rate / 100)) . "€<hr>";
        }

        echo apply_and_chose_tva(200);
        echo apply_and_chose_tva(200, 15);


            // Fermeture de la balise PHP
        ?>
    </div>



</body>

</html>