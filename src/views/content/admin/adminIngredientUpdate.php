<?php use \Core\Validator as V; ?>
    <form class="ui form" method="post" action="/?p=admin&panel=updateingredient&id=<?php echo $_GET['id'] ?>" enctype="multipart/form-data">
    <h4 class="ui dividing header">Modifier un ingrédient</h4>
    <div class="field <?php V::formRedStyle('nom'); ?>">
        <label for="nom">Nom de l'ingrédient</label><input type="text" name="nom" id="nom" required value="<?php echo $ingredient['nom'];?>"><br>
        <?php V::formErrorMsg('nom') ?>
    </div>

    <input class="ui olive button" type="submit" name="envoyer" value="Modifier">
</form>
<?php
