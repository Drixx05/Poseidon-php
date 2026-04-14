<?php
require_once("partials/_config.php"); 
require_once("partials/_functions.php");


// ICI CODE PROPRE A LA PAGE INDEX
// TOUJOURS AVANT LES AFFICHAGES
// POURQUOI ? Car certaines instructions PHP ne fonctionnent plus lorsque la page est déjà initialisée








require_once("partials/_header.php"); // ICI INITIALISATION DE LA PAGE, ENVOIE DES ENTETES HTTP, DEBUT DES AFFICHAGES
require_once("partials/_nav.php");
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Bienvenue sur notre site </h1>
        <p class="lead">Bienvenue sur notre super site de démonstration des includes</p>
    </div>
</main>

<?php
require_once("partials/_footer.php");