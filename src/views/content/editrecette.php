<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=edit&id=<?php echo $recipe['id_recette']?>" enctype="multipart/form-data">
        <h4 class="ui dividing header">Editer ma recette : <?php echo $recipe['titre'] ?></h4>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="titre">Titre</label><input type="text" name="titre" id="titre" value="<?php echo $recipe['titre'] ?>" required><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="nbpers">Nombre de convives</label><input type="number" name="nbpers" id="nbpers" value="<?php echo $recipe['nb_convives'] ?>" required>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="sdesc">Courte description</label><input type="text" name="sdesc" id="sdesc" value="<?php echo $recipe['desc_courte'] ?>" required><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="ldesc">Longue description (introduction)</label><textarea type="text" name="ldesc" id="ldesc" rows="2" cols="50"  required><?php echo $recipe['desc_longue'] ?></textarea><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="etapes">Étapes (une par ligne)</label>
            <textarea type="text" name="etapes" id="etapes" rows="20" cols="50" required><?php foreach ($etapes as $etape) { echo $etape['etape'] . "\n"; 
           } ?></textarea>
            <?php V::formErrorMsg('titre') ?>
        </div>

        <div class="field <?php V::formRedStyle('titre'); ?>">
            <select class="ui fluid dropdown" name="status">
                <option value="2" <?php if($recipe['status'] == 2) {echo 'selected';
               } ?>>Publique</option>
                <option value="1" <?php if($recipe['status'] == 1) {echo 'selected';
               } ?>>Privée</option>
            </select>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <input class="ui olive button" type="submit" name="envoyer" value="Editer">
    </form>
