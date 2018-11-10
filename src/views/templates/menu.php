<div class="ui large inverted borderless top fixed hidden menu">
    <div class="ui container">
        <a href="/" class="header item">
            <img alt="Image cannot be displayed" src="/img/logo.png">
        </a>
        <a href="/" class="btnhome active item">Accueil</a>
        <a href="/?p=recettes" class="btnrecipes item">Recettes</a>
        <a href="/?p=newrecette" class="btnnrecipe item">Envoyer sa recette</a>
        <div class="right menu">
            <div class="item">
                <?php if (isset($_SESSION['id'])) { ?>
                    <div class="ui combo top right pointing link dropdown">
                        <div class="text">
                            <img class="ui avatar image" src="/img/avatars/<?php echo $_SESSION['avatar'] ?>">
                            <?php echo $_SESSION['pseudo'] ?>
                        </div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="/?p=profile&id=<?php echo $_SESSION['id'] ?>"><i class="user icon"></i>Mon profil</a>
                            <a class="item" href="/?p=myrecipes"><i class="file alternate outline icon"></i>Mes recettes</a>
                            <a class="item" href="/?p=favorites"><i class="star icon"></i>Mes favoris</a>
                            <a class="item" href="/?p=logout"><i class="sign-out icon"></i>Se déconnecter</a>
                            <?php if ($_SESSION['role'] == 3) {?>
                                <div class="divider"></div>
                                <a class="item" href="/?p=admin"><i class="key icon"></i><span style="color: #ff0043;">Admin</span></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else {?>
                    <a href="/?p=login" class="btnlogin ui button">Se connecter</a>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<div class="ui vertical inverted sidebar menu">
    <a href="/" class="header item">
        <img alt="Image cannot be displayed" class="logo" src="/img/logo.png">
    </a>
    <a href="/" class="btnhome active item">Accueil</a>
    <a href="/?p=recettes" class="btnrecipes item">Recettes</a>

    <?php if (isset($_SESSION['id'])) { ?>
        <div class="ui combo top right pointing link dropdown">
            <div class="text">
                <img alt="Image cannot be displayed" class="ui avatar image" src="/img/avatars/<?php echo $_SESSION['avatar'] ?>">
                <?php echo $_SESSION['pseudo'] ?>
            </div>
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="/?p=profile&id=<?php echo $_SESSION['id'] ?>">Mon profil</a>
                <a class="item" href="/?p=logout"><i class="sign-out icon"></i>Se déconnecter</a>
                <?php if ($_SESSION['role'] == 3) {?>
                <div class="divider"></div>
                <a class="item" href="/?p=admin"><i class="key icon"></i><span style="color: #ff0043;">Admin</span></a>
                <?php } ?>
            </div>
        </div>
    <?php } else {?>
        <a href="/?p=login" class="btnlogin item">Se connecter</a>
    <?php }?>
</div>
