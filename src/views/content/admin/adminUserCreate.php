<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=admin&panel=usercreate" enctype="multipart/form-data">
    <h4 class="ui dividing header">Créer un utilisateur</h4>
    <div class="field <?php V::formRedStyle('pseudo'); ?>">
        <label for="pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo" value="<?php V::formOldInput('pseudo'); ?>" required><br>
        <?php V::formErrorMsg('pseudo') ?>
    </div>
    <div class="field <?php V::formRedStyle('prenom'); ?>">
        <label for="prenom">Prénom</label><input type="text" name="prenom" id="prenom" value="<?php V::formOldInput('prenom'); ?>" required><br>
        <?php V::formErrorMsg('prenom') ?>
    </div>
    <div class="field <?php V::formRedStyle('nom'); ?>">
        <label for="nom">Nom</label><input type="text" name="nom" id="nom"value="<?php V::formOldInput('nom'); ?>" required><br>
        <?php V::formErrorMsg('nom') ?>
    </div>
    <div class="field <?php V::formRedStyle('mail'); ?>">
        <label for="mail">Mail</label><input type="email" name="mail" id="mail" value="<?php V::formOldInput('mail'); ?>" required><br>
        <?php V::formErrorMsg('mail') ?>
    </div>
    <div class="field <?php V::formRedStyle('mdp'); ?>">
        <label for="mdp">Mot de passe</label><input type="password" name="mdp" id="mdp" required><br>
        <?php V::formErrorMsg('mdp') ?>
    </div>
    <div class="field <?php V::formRedStyle('role'); ?>">
        <select class="ui fluid dropdown" name="role">
            <option value="3">Administrateur</option>
            <option value="2">Modérateur</option>
            <option value="1" selected>Membre</option>
        </select>
        <?php V::formErrorMsg('role') ?>
    </div>

    <input class="ui olive button" type="submit" name="envoyer" value="Créer">
</form>
<?php
