<?php

function showRecipe($titre, $img, $desc, $burns, $date, $id)
{
    return '<div class="card">
                    <div class="image">
                        <img alt="Image cannot be displayed" src="/img/recipes/'. $img  .'">
                    </div>
                    <div class="content">
                        <a href="?p=recette&r=' . $id . '" class="header">'. $titre  .'</a>
                        <div class="description">
                            '. $desc  .'
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="right floated">'. $date  .'</span>
                        <span><i class="thumbs up icon"></i><b>'. $burns  .'</b> burns</span>
                    </div>
                </div>
                ';
}
?>
<h3 class="ui header">Dernière recette à la une</h3>

<?php
if ($lastRecipe) {
    echo '<div class="ui special cards">';
    echo showRecipe($lastRecipe['titre'], $lastRecipe['img'], $lastRecipe['desc_courte'], $lastRecipe['burns'], $lastRecipe['created_at'], $lastRecipe['id_recette']);
    echo '</div>';
}
else {
    echo '<p>Pas encore de recette à la une, peut-être la votre sera la première ?</p>';
}
?>
<div class="ui divider"></div>

<?php if ($currentIngr) {?>
<h3 class="ui header">Ingrédient à la une : <?php echo $currentIngr['nom']; ?></h3>

<div class="ui special cards">
    <?php foreach ($feat3recipe as $recipe) {
        echo showRecipe($recipe['titre'], $recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);
    } ?>
</div>
    <div class="ui divider"></div>
<?php } ?>
<h3 class="ui header" id="recettes">Dernières recettes</h3>
<div class="ui special cards">
<?php foreach ($recipes as $recipe) {
    echo showRecipe($recipe['titre'], $recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);
}?>
</div>
<?php echo $pgnav; ?>

