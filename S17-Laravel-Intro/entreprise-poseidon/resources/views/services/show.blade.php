<h1>Ici c'est le show ! </h1>

<h2>Vous consultez le service numéro : <?= $id ?></h2>

<?php if($service): ?>
<h2><?= $service["nom"] ?></h2>
<h3>Responsable : <?= $service["responsable"] ?></h3>
<h3>Telephone : <?= $service["telephone"] ?></h3>
<?php else: ?>
<p>Service introuvable</p>
<?php endif; ?>

<a href="{{route('services.index')}}">Retour à la liste des services</a>