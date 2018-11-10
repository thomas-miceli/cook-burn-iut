<?php function showRecipe($titre, $img, $desc, $burns, $date, $id)
{

    return '<div class="card">
    <div class="image">
        <img src="/img/recipes/' . $img . '">
    </div>
    <div class="content">
        <a href="?p=recette&r=' . $id . '" class="header">' . $titre . '</a>
        <div class="description">' . $desc . '</div>
    </div>
    <div class="extra content">
        <span class="right floated">' . $date . '</span>
        <span><i class="fire icon"></i>' . $burns .' Burns</span>
    </div>
</div>';
}
?>

<h4>Mes favoris :</h4>
<div class="ui link cards">
    <?php
    foreach($favRecipes as $recipe) {
        echo showRecipe($recipe['titre'], $recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);
    
    }
    ?>
</div>
