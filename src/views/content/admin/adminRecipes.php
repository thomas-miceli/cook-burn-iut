<div class="column" id="content">
    <div class="ui grid">
        <div class="row">
            <h1 class="ui huge header">Recettes</h1>
        </div>
        <a href="/?p=admin&panel=newrecipe"><button class="ui button teal">Créer</button></a>
        <div class="row">
            <table class="ui single line striped selectable table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Burns</th>
                    <th>Statut</th>
                    <th>Création</th>
                    <th>Dernière modification</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($recipes as $recipe) { ?>
                <tr>
                    <td><?= $recipe['id_recette'] ?></td>
                    <td><?= $recipe['titre'] ?></td>
                    <td><img src="/img/avatars/<?= $users[$recipe['id_auteur'] - 1]['avatar']; ?>" class="ui avatar image"><a href="/?p=profile&id=<?= $recipe['id_auteur']; ?>"><?= $users[$recipe['id_auteur'] - 1]['pseudo'] ?></a></td>
                    <td><?= $recipe['burns'] ?></td>
                    <td><?php if ($recipe['status'] == 2) echo 'Publique'; if ($recipe['status'] == 1) echo 'Privée'; if ($recipe['status'] == 0) echo 'Brouillon' ?></td>
                    <td><?= $recipe['created_at'] ?></td>
                    <td><?= $recipe['updated_at'] ?></td>
                    <td><a href="/?p=admin&panel=updaterecipe&id=<?= $recipe['id_recette']; ?>"><button class="ui button olive">Editer</button></a></td>
                    <td><a href="/?p=admin&panel=deleterecipe&id=<?= $recipe['id_recette']; ?>"><button class="ui button red">Supprimer</button></a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
