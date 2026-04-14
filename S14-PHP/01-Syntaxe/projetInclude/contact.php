<?php
require_once("partials/_config.php"); 
require_once("partials/_functions.php");


// ICI CODE PROPRE A LA PAGE CONTACT
// TOUJOURS AVANT LES AFFICHAGES
// POURQUOI ? Car certaines instructions PHP ne fonctionnent plus lorsque la page est déjà initialisée
// Ici traitement de la page contact

// Traitement du form, récupération des données
// Enregistrement en BDD 
// Envoie d'un mail etc 







require_once("partials/_header.php"); // ICI INITIALISATION DE LA PAGE, ENVOIE DES ENTETES HTTP, DEBUT DES AFFICHAGES
require_once("partials/_nav.php");
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Contactez nous ! </h1>
        <p class="lead">Envoyez nous de beaux messagess </p>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Message</label>
                <input type="text" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</main>

<?php
require_once("partials/_footer.php");


?>