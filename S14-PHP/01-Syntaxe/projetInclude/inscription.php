<?php
require_once("partials/_config.php"); 
require_once("partials/_functions.php");

$msgError = "";

// ICI CODE PROPRE A LA PAGE INSCRIPTION
// TOUJOURS AVANT LES AFFICHAGES
// POURQUOI ? Car certaines instructions PHP ne fonctionnent plus lorsque la page est déjà initialisée
// Ici traitement de la page contact

// Traitement du form, récupération des données
// Vérification des données
// Bonnes saisies, doublons de pseudo, etc 

// password assez long, etc 

// Si pas d'erreur, enregistrement dans la BDD

// Redirection sur une autre page en maintenant la connexion 

$msgError .= "erreur, password trop court";







require_once("partials/_header.php"); // ICI INITIALISATION DE LA PAGE, ENVOIE DES ENTETES HTTP, DEBUT DES AFFICHAGES
require_once("partials/_nav.php");
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Inscrivez vous ! </h1>
        <?= $msgError ?>
        <p class="lead">Inscrivez vous pour profiter de tous les avantages de norte site !</p>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</main>

<?php
require_once("partials/_footer.php");


?>