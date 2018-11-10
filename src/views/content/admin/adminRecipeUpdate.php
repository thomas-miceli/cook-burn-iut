<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=admin&panel=updaterecipe&id=<?= $recipe['id_recette']?>" enctype="multipart/form-data">
        <h4 class="ui dividing header">Editer la recette : <?= $recipe['titre'] ?></h4>
        <div class="field <?php V::formRedStyle('auteur'); ?> ">
            <label for="auteur">Auteur</label>
            <select class="ui search dropdown" name="auteur" id="auteur">
                <?php foreach($users as $user) { ?>
                    <option value="<?= $user['id']; ?>" <?php if($user['id'] == $recipe['id_auteur']) echo 'active selected'; ?>><?= $user['pseudo']; ?> [<?= $user['id'] ?>] </option>
                <?php } ?>
            </select>
            <?php V::formErrorMsg('auteur') ?>

        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="titre">Titre</label><input type="text" name="titre" id="titre" value="<?= $recipe['titre'] ?>" required><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('nbpers'); ?>">
            <label for="nbpers">Nombre de convives</label><input type="number" name="nbpers" id="nbpers" value="<?= $recipe['nb_convives'] ?>" required>
            <?php V::formErrorMsg('nbpers') ?>
        </div>
        <div class="field <?php V::formRedStyle('sdesc'); ?>">
            <label for="sdesc">Courte description</label><input type="text" name="sdesc" id="sdesc" value="<?= $recipe['desc_courte'] ?>" required><br>
            <?php V::formErrorMsg('sdesc') ?>
        </div>
        <div class="field <?php V::formRedStyle('ldesc'); ?>">
            <label for="ldesc">Longue description (introduction)</label><textarea type="text" name="ldesc" id="ldesc" rows="2" cols="50"  required><?= $recipe['desc_longue'] ?></textarea><br>
            <?php V::formErrorMsg('ldesc') ?>
        </div>
        <div class="field <?php V::formRedStyle('etapes'); ?>">
            <label for="etapes">Étapes (une par ligne)</label>
            <textarea type="text" name="etapes" id="etapes" rows="20" cols="50" required><?php foreach ($etapes as $etape) { echo $etape['etape'] . "\n"; } ?></textarea>
            <?php V::formErrorMsg('etapes') ?>
        </div>

        <div class="field <?php V::formRedStyle('status'); ?>">
            <select class="ui fluid dropdown" name="status">
                <option value="2" <?php if($recipe['status'] == 2) {echo 'selected';} ?>>Publique</option>
                <option value="1" <?php if($recipe['status'] == 1) {echo 'selected';} ?>>Privée</option>
                <option value="0" <?php if($recipe['status'] == 0) {echo 'selected';} ?>>Brouillon</option>
            </select>
            <?php V::formErrorMsg('status') ?>
        </div>
        <input class="ui olive button" type="submit" name="envoyer" value="Editer">
    </form>
<?php
