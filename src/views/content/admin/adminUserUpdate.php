<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=admin&panel=userupdate&id=<?= $user['id'];?>" enctype="multipart/form-data">
        <h4 class="ui dividing header">Editer l'utilisateur : <?= $user['pseudo'] ?></h4>

        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo" value="<?= $user['pseudo'] ?>"><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="prenom">Prénom</label><input type="text" name="prenom" id="prenom" value="<?= $user['prenom'] ?>"><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="nom">Nom</label><input type="text" name="nom" id="nom" value="<?= $user['nom'] ?>">
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <label for="mail">Mail</label><input type="email" name="mail" id="mail" value="<?= $user['mail'] ?>"><br>
            <?php V::formErrorMsg('titre') ?>
        </div>
        <div class="field <?php V::formRedStyle('titre'); ?>">
            <select class="ui fluid dropdown" name="role">
                <option value="3" <?php if ($user['role'] == 3) echo 'selected'; ?>>Administrateur</option>
                <option value="2" <?php if ($user['role'] == 2) echo 'selected'; ?>>Modérateur</option>
                <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>Membre</option>
            </select>
            <?php V::formErrorMsg('titre') ?>
        </div>

        <input class="ui olive button" type="submit" name="envoyer" value="Envoyer">
    </form>
<?php
