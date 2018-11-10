<h1 class="ui dividing header">
    <?php echo $recipe['titre'];?>
</h1>

<?php if ($myRecipe == 1) { ?>
    <h3>Gérer ma recette :</h3>
    <a href="?p=edit&id=<?php echo $recipe['id_recette'] ?>"><div class="ui yellow button">Editer</div></a>
    <a href="?p=delete&id=<?php echo $recipe['id_recette'] ?>"><div class="ui red button">Supprimer</div></a>
    <br><br>
<?php } ?>

<?php if ($username['pseudo']) {?>
    <a class="ui large image label" href="/?p=profile&id=<?php echo $username['id']; ?>">
        <img alt="Image cannot be displayed" src="/img/avatars/<?php echo $username['avatar']; ?>">
        <?php echo $username['pseudo']; ?>
    </a>
<?php } else {?>
    <p class="ui large image label">
        <img alt="Image cannot be displayed" src="/img/avatars/default.jpg">
        Utilisateur supprimé
    </p>
<?php } ?>


<a class="ui large label">
    <i class="fire icon"></i>
    <?php echo $recipe['burns'];?> Burns
</a>

<a class="ui large label">
    <i class="calendar alternate icon"></i>
    <?php echo $recipe['created_at'];?>
</a>
<?php if (isset($_SESSION['id'])) {?>
    <a class="ui large label">
        <form method="post" action="/?p=recette&r=<?php echo $recipe['id_recette'];?>">
            <i class="calendar alternate icon"></i>
            <?php if ($favCount == 0) {?>
                <input type="submit" value="Ajouter aux favoris" name="addfav">
            <?php } else if ($favCount == 1) {?>
                <input type="submit" value="Retirer des favoris" name="rmfav">
            <?php } ?>
        </form>
    </a>
    <a class="ui large label">
        <form method="post" action="/?p=recette&r=<?php echo $recipe['id_recette'];?>">
            <i class="like alternate icon"></i>
            <?php if ($burnCount == 0) {?>
                <input class="ui labeled icon button" type="submit" value="Like" name="addburn">
            <?php } else if ($burnCount == 1) {?>
                <input class="ui labeled icon button" type="submit" value="Dislike" name="rmburn">
            <?php } ?>
        </form>
    </a>
    <div class="fb-share-button" data-href="http://tomus.alwaysdata.net/?p=recette&amp;r=<?php echo $recipe['id_recette']; ?>" data-layout="box_count" data-size="small" data-mobile-iframe="true">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Ftomus.alwaysdata.net%2F%3Fp%3Drecette%26r%3D<?php echo $recipe['id_recette']; ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
            Partager
        </a>
    </div>
<?php } ?>
<div class="ui hidden divider"></div>
<div class="ui styled accordion">
    <div class="title active">
        <i class="dropdown icon"></i>
        Présentation
    </div>
    <div class="content active">
        <p class="transition visible"><?php echo $recipe['desc_longue'];?></p>
    </div>
    <div class="title ">
        <i class="dropdown icon"></i>
        Ingrédients nécessaires
    </div>
    <div class="content">
        <?php foreach ($ingredients as $ingredient) { ?>
            <li><?php echo $ingredient['nom'] ?></li>
        <?php } ?>    </div>
    <div class="title">
        <i class="dropdown icon"></i>
        Directives
    </div>

    <div class="content">
        <ul class="ui list transition hidden">
            <?php foreach ($etapes as $etape) { ?>
            <li><b><?php echo $etape['nb_etape'], ' : '?></b><?php echo $etape['etape'] ?></li>
            <?php } ?>
        </ul>
    </div>
</div>

<div class="ui hidden divider"></div>
<h3>Images</h3>
<div class="ui hidden divider"></div>
<img alt="Image cannot be displayed" src="/img/recipes/<?php echo $recipe['img'] ?>">