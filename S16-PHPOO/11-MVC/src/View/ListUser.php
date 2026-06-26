<?php

/**  @var \App\Chat\Domain\Entities\Message[] $messages */
/**  @var array $errors */
/**  @var array $data */

?>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $employe) : ?>
            <tr>
                <td><?php echo $employe['id_employes']; ?></td>
                <td><?php echo $employe['nom']; ?></td>
                <td><?php echo $employe['prenom']; ?></td>
                <td>
                    Actions
                </td>

            </tr>
        <?php endforeach; ?>
        <?php var_dump($_GET); ?>
    </tbody>
</table>