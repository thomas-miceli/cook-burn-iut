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

<?php if ($user['actif'] == 1) {?>
    <img alt="Image cannot be displayed" src="/img/avatars/<?php echo $user['avatar'];?>" class="ui centered medium image circular" style="width: 300px; height: 300px">
    <?php 
} else { ?>
    <img alt="Image cannot be displayed" src="/img/avatars/default.jpg" class="ui centered medium image circular" style="width: 300px; height: 300px">
    <?php 
} ?>

<h2 class="ui center aligned header">
    <?php echo $user['pseudo']; ?>
    <?php if ($user['role'] == 3) {?><div class="ui red horizontal label">Administrateur</div><?php 
    } ?>
    <?php if ($user['role'] == 2) {?><div class="ui purple horizontal label">Modérateur</div><?php 
    } ?>
    <?php if ($user['role'] == 1) {?><div class="ui gray horizontal label">Membre</div><?php 
    } ?>
    <?php if ($user['id'] == $_SESSION['id'] && $user['actif'] == 1) { ?>
        <div class="ui divider"></div>
        <a href="/?p=editprofile"><button class="ui button blue">Editer mes informations</button></a>
        <?php 
    } ?>
</h2>

<div class="ui divider"></div>
<?php if ($user['actif'] == 1) {?>

<div class="ui list">
    <?php if ($user['showNom'] == 1) {?>
    <div class="item">
        <i class="user icon"></i>
        <div class="content">
        <?php echo $user['prenom']; ?> <?php echo $user['nom']; ?>
        </div>
    </div>
    <?php } ?>
    <?php if ($user['showMail'] == 1) {?>
    <div class="item">
        <i class="mail icon"></i>
        <div class="content">
            <a href="mailto:<?php echo $user['mail']; ?>"><?php echo $user['mail']; ?></a>
        </div>
    </div>
    <?php } ?>
    <div class="item">
        <i class="calendar icon"></i>
        <div class="content">
            Inscrit le <?php echo $user['insc']; ?>
        </div>
    </div>
    <div class="item">
        <i class="fire icon"></i>
        <div class="content">
            A obtenu <?php echo $totalBurns[0] ?> Burns
        </div>
    </div>
</div>
<?php } else { ?>
    <p style="color: red;">Cet utilisateur est banni</p>
    <?php 
} ?>
<div class="ui hidden divider"></div>

<h2 class="ui dividing header">Dernières recettes publiques par <?php echo $user['pseudo'];?> :</h2>

    <div class="ui link cards">
<?php

foreach($uRecipes as $recipe) {
    if ($recipe['burns'] < $limit) {
        if (isset($_SESSION['id'])) {
            echo showRecipe($recipe['titre'], $recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);
        
        }
        continue;
    
    }
    echo showRecipe($recipe['titre'], $recipe['img'], $recipe['desc_courte'], $recipe['burns'], $recipe['created_at'], $recipe['id_recette']);

}
?>
    </div>
