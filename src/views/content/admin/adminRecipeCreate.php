<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=admin&panel=newrecipe" enctype="multipart/form-data">
    <h4 class="ui dividing header">Ajouter une recette</h4>

    <div class="field">
        <label for="auteur">Auteur</label>
        <select class="ui search dropdown" name="auteur" id="auteur">
            <option value="">Auteur</option>
            <?php foreach($users as $user) { ?>
            <option value="<?php echo $user['id']; ?>"><?php echo $user['pseudo']; ?> [<?php echo $user['id'] ?>] </option>
            <?php } ?>
        </select>
    </div>

    <div class="field <?php V::formRedStyle('titre'); ?>">
        <label for="titre">Titre</label><input type="text" name="titre" id="titre" value="<?php V::formOldInput('titre'); ?>" required><br>
        <?php V::formErrorMsg('titre') ?>
    </div>
    <div class="field <?php V::formRedStyle('img'); ?>">
        <label for="img">Image</label><input type="file" name="img" id="img" required><br>
        <?php V::formErrorMsg('img') ?>
    </div>
    <div class="field <?php V::formRedStyle('nbpers'); ?>">
        <label for="nbpers">Nombre de convives</label><input type="number" name="nbpers" id="nbpers" value="<?php V::formOldInput('nbpers'); ?>" required>
        <?php V::formErrorMsg('nbpers') ?>
    </div>
    <div class="field <?php V::formRedStyle('sdesc'); ?>">
        <label for="sdesc">Courte description</label><input type="text" name="sdesc" id="sdesc" value="<?php V::formOldInput('sdesc'); ?>" required><br>
        <?php V::formErrorMsg('sdesc') ?>
    </div>
    <div class="field <?php V::formRedStyle('ldesc'); ?>">
        <label for="ldesc">Longue description (introduction)</label><textarea type="text" name="ldesc" id="ldesc" rows="2" cols="50" required><?php V::formOldInput('ldesc'); ?></textarea><br>
        <?php V::formErrorMsg('ldesc') ?>
    </div>
    <div class="field <?php V::formRedStyle('etapes'); ?>">
        <label for="etapes">Étapes (une par ligne)</label><textarea type="text" name="etapes" id="etapes" rows="20" cols="50" required><?php V::formOldInput('etapes'); ?></textarea>
        <?php V::formErrorMsg('etapes') ?>
    </div>


    <div class="field">
        <label for="ingr">Ingrédients</label>
        <div class="ui fluid normal dropdown selection multiple">
            <select multiple name="ingredients[]" id="ingr">
                <option value>Ingrédients</option>
                <?php foreach ($ingredients as $ingredient) {?>
                    <option value="<?php echo $ingredient['id_ingredient'] ?>"><?php echo $ingredient['nom']; ?></option>
                <?php } ?>
            </select>
            <i class="dropdown icon"></i>
            <div class="default text">Ingrédients</div>
            <div class="menu transition hidden">
                <?php foreach ($ingredients as $ingredient) {?>
                    <div class="item" data-value="<?php echo $ingredient['id_ingredient'] ?>"><?php echo $ingredient['nom']; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="field">
        <select class="ui fluid dropdown" name="status">
            <option value="2">Publique</option>
            <option value="1">Privée</option>
            <option value="0">Brouillon</option>
        </select>
    </div>

    <input class="ui olive button" type="submit" name="envoyer" value="Publier">
</form>
<?php
