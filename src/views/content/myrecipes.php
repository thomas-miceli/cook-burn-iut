<div class="column" id="content">
    <div class="ui grid">
        <div class="row">
            <h1 class="ui huge header">Mes recettes</h1>
        </div>
        <a href="/?p=newrecette"><button class="ui button teal">Nouveau</button></a>

        <form method="get" action="/?p=myrecipes" enctype="multipart/form-data">
            <input type="hidden" name="p" value="myrecipes">
            <label for="tri">Trier par</label>
            <select name="tri" id="tri">
                <option value="last" <?php if (isset($_GET['tri'])) if ($_GET['tri'] == 'last') echo 'selected'?>>Date</option>
                <option value="name" <?php if (isset($_GET['tri'])) if ($_GET['tri'] == 'name') echo 'selected'?>>Nom</option>
                <option value="burns" <?php if (isset($_GET['tri'])) if ($_GET['tri'] == 'burns') echo 'selected'?>>Burns</option>
            </select>
            <label for="show">Afficher</label>
            <select name="show" id="show">
                <option value="all" <?php if (isset($_GET['show'])) if ($_GET['show'] == 'all') echo 'selected'?>>Tout</option>
                <option value="public" <?php if (isset($_GET['show'])) if ($_GET['show'] == 'public') echo 'selected'?>>Recettes publiques</option>
                <option value="private" <?php if (isset($_GET['show'])) if ($_GET['show'] == 'private') echo 'selected'?>>Recettes privées</option>
                <option value="draft" <?php if (isset($_GET['show'])) if ($_GET['show'] == 'draft') echo 'selected'?>>Brouillon</option>
            </select>
            <input type="submit">

        </form>

        <div class="row">
            <table class="ui single line striped selectable table">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Burns</th>
                    <th>Statut</th>
                    <th>Création</th>
                    <th>Dernière modification</th>
                    <th>Voir</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($recipes as $recipe) { ?>
                <tr>
                    <td><?= $recipe['titre'] ?></td>
                    <td><?= $recipe['burns'] ?></td>
                    <td><?php if ($recipe['status'] == 2) echo 'Publique'; if ($recipe['status'] == 1) echo 'Privée'; if ($recipe['status'] == 0) echo 'Brouillon' ?></td>
                    <td><?= $recipe['created_at'] ?></td>
                    <td><?= $recipe['updated_at'] ?></td>
                    <td><a href="/?p=recette&r=<?= $recipe['id_recette'];?>"><button class="ui button gray">Voir</button></a></td>
                    <td><a href="/?p=edit&id=<?= $recipe['id_recette'];?>"><button class="ui button yellow">Editer</button></a></td>
                    <td><a href="/?p=delete&id=<?= $recipe['id_recette'];?>"><button class="ui button red">Supprimer</button></a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
