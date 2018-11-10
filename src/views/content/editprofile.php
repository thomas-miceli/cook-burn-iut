<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=editprofile" enctype="multipart/form-data">
        <h4 class="ui dividing header">Editer mon profil : <?= $user['pseudo'] ?></h4>

        <div class="field <?php V::formRedStyle('prenom'); ?>">
            <label for="prenom">Prénom</label><input type="text" name="prenom" id="prenom" value="<?= $user['prenom'] ?>"><br>
            <?php V::formErrorMsg('prenom') ?>
        </div>
        <div class="field <?php V::formRedStyle('nom'); ?>">
            <label for="nom">Nom</label><input type="text" name="nom" id="nom" value="<?= $user['nom'] ?>">
            <?php V::formErrorMsg('nom') ?>
        </div>

        <div class="ui divider"></div>

        <div class="field <?php V::formRedStyle('mail'); ?>">
            <label for="mail">Mail</label><input type="email" name="mail" id="mail" value="<?= $user['mail'] ?>"><br>
            <?php V::formErrorMsg('mail') ?>
        </div>

        <div class="ui divider"></div>

        <div class="field <?php V::formRedStyle('avatar'); ?>">
            <label for="avatar">Avatar</label><input type="file" name="avatar" id="avatar"><br>
            <?php V::formErrorMsg('avatar') ?>
        </div>

        <h4 class="ui dividing header">Changer mon mot de passe</h4>

        <div class="field <?php V::formRedStyle('oldmdp'); ?>">
            <label for="oldmdp">Ancien mot de passe</label><input type="password" name="oldmdp" id="oldmdp"><br>
            <?php V::formErrorMsg('oldmdp') ?>
        </div>
        <div class="field <?php V::formRedStyle('newmdp'); ?>">
            <label for="newmdp">Nouveau mot de passe</label><input type="password" name="newmdp" id="newmdp"><br>
            <?php V::formErrorMsg('newmdp') ?>
        </div>
        <div class="field <?php V::formRedStyle('newmdp2'); ?>">
            <label for="newmdp2">Retaper nouveau mot de passe</label><input type="password" name="newmdp2" id="newmdp2"><br>
            <?php V::formErrorMsg('newmdp2') ?>
        </div>

        <h4 class="ui dividing header">Confidentialité</h4>

        <div class="field <?php V::formRedStyle('confn'); ?>">
            <label for="confn">Afficher mon nom en public</label><input type="checkbox" name="confn" id="confn" <?php if ($user['showNom'] == 1) echo 'checked'; ?>><br>
            <?php V::formErrorMsg('confn') ?>
        </div>
        <div class="field <?php V::formRedStyle('confm'); ?>">
            <label for="confm">Afficher mon mail en public</label><input type="checkbox" name="confm" id="confm" <?php if ($user['showMail'] == 1) echo 'checked'; ?>><br>
            <?php V::formErrorMsg('confm') ?>
        </div>
        <input class="ui olive button" type="submit" name="envoyer" value="Envoyer">
        <a class="ui button" href="/?p=profile&id=<?= $_SESSION['id'] ?>">Annuler</a>
    </form>
<?php
