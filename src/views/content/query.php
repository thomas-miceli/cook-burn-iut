<?php

function showRecipe($titre, $auteur, $img, $desc, $burns, $date, $id) {
    return '<div class="card">
    			<div class="image">
    				<img src="/img/recipes/' . $img . '">
    			</div>
    			<div class="content">
    				<a href="?p=recette&r=' . $id . '" class="header">' . $titre . '</a>
    				<div class="meta"><a class="name" href="/?p=profile&id=' . $auteur['id'] . '">par '. $auteur['pseudo'] .'</a></div>
    				<div class="description">' . $desc . '</div>
    			</div>
    			<div class="extra content">
    				<span class="right floated">' . $date . '</span>
    				<span><i class="fire icon"></i>' . $burns .' Burns</span>
    			</div>
    		</div>';
} ?>
<form method="get" action="/">
    <input name="p" type="hidden" value="query">
    <div class="ui search">
        <div class="ui icon input">
            <input class="ui input" name="q" type="text" placeholder="Chercher des recettes..." <?php if (isset($_GET['q'])) echo 'value="'. $_GET['q'] . '"'; ?>
        </div>
        <div class="ui field input">
            <select name="type" class="ui selection dropdown">
                <option value="1" <?php if($_GET['type'] == 1) echo 'selected'; ?>>Titre</option>
                <option value="2" <?php if($_GET['type'] == 2) echo 'selected'; ?>>Description</option>
                <option value="3" <?php if($_GET['type'] == 3) echo 'selected'; ?>>Ingrédient</option>
            </select>
        </div>
        <div class="ui icon input">
            <input class="ui button teal" type="submit">
            <i class="search icon"></i>
        </div>
    </div>
</form>
<h1 class="ui header">Résultats de la recherche</h1>
<br>

<div class="ui link cards">
<?php
foreach($recipes as $recipe) {
    if ($recipe['burns'] < $limit) {
        if (isset($_SESSION['id'])) {
            echo showRecipe($recipe['titre'], $users[$recipe['id_auteur'] - 1],$recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);
        }
        continue;
    }
    echo showRecipe($recipe['titre'], $users[$recipe['id_auteur'] - 1], $recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);
}
?>
</div>

