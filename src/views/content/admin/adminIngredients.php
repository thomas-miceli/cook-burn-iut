<div class="column" id="content">
    <div class="ui grid">
        <div class="row">
            <h1 class="ui huge header">Ingrédients</h1>
        </div>
        <a href="?p=admin&panel=newingredient"><button class="ui button teal">Nouveau</button></a>
        <div class="row">
            <table class="ui single line striped selectable table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ingrédient</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ingredients as $ingredient) { ?>
                <tr>
                    <td><?php echo $ingredient['id_ingredient'] ?></td>
                    <td><?php echo $ingredient['nom'] ?></td>
                    <td><a href="/?p=admin&panel=updateingredient&id=<?php echo $ingredient['id_ingredient'] ?>"><button class="ui button olive">Editer</button></a></td>
                    <td><a href="/?p=admin&panel=deleteingredient&id=<?php echo $ingredient['id_ingredient'] ?>"><button class="ui button red">Supprimer</button></a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
