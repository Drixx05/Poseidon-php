 
   <?php

/**  @var \App\Chat\Domain\Entities\Message[] $messages */
/**  @var array $errors */
/**  @var array $data */

?> 
<!-- Action "Voir" les informations de l'utilisateur -->
  <ul class="list-group mb-3">
      <li class="list-group-item"><strong>ID : </strong> <?php echo $data['id_employes']; ?></li>
      <li class="list-group-item"><strong>Nom : </strong> <?php echo $data['nom']; ?></li>
      <li class="list-group-item"><strong>Prenom : </strong> <?php echo $data['prenom']; ?></li>
  </ul>