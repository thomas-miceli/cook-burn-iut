<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/img/site.webmanifest">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#ffc40d">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">

    <title>Cook & Burn</title>

    <link rel="stylesheet" type="text/css" class="ui" href="/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="/css/docs.css">

    <style>

        .hidden.menu {
            display: none;
        }


        .masthead.segment {
            min-height: 700px;
            padding: 1em 0em;
        }
        .masthead .logo.item img {
            margin-right: 1em;
        }
        .masthead .ui.menu .ui.button {
            margin-left: 0.5em;
        }
        .masthead h1.ui.header {
            margin-top: 3em;
            margin-bottom: 0em;
            font-size: 4em;
            font-weight: normal;
        }
        .masthead h2 {
            font-size: 1.7em;
            font-weight: normal;
        }

        .ui.vertical.stripe {
            padding: 8em 0em;
        }
        .ui.vertical.stripe h3 {
            font-size: 2em;
        }
        .ui.vertical.stripe .button + h3,
        .ui.vertical.stripe p + h3 {
            margin-top: 3em;
        }
        .ui.vertical.stripe .floated.image {
            clear: both;
        }
        .ui.vertical.stripe p {
            font-size: 1.33em;
        }
        .ui.vertical.stripe .horizontal.divider {
            margin: 3em 0em;
        }

       
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <!--<script src="/js/highlight.js"></script>
    <script src="/js/highlight.languages.js"></script>
    <script src="/js/history.js"></script>
    <script src="/js/easing.js"></script>
    <script src="/js/tablesort.js"></script>
    <script src="/js/typing.js"></script>-->

    <script src="/dist/semantic.min.js"></script>

    <!--<script src="/js/docs.js"></script>-->

    <script>
        $(document).ready(function() {
            $('.masthead').visibility({
                once: false,
                onBottomPassed: function() {
                    $('.fixed.menu').transition('fade in');
                },
                onBottomPassedReverse: function() {
                    $('.fixed.menu').transition('fade out');
                }
            });

            $('.ui.sidebar').sidebar('attach events', '.toc.item');
        })
    </script>
</head>

<body id="example" class="pushable index">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div class="ui large top fixed menu transition hidden">
        <?php require_once 'menu.php'; ?>
    </div>
    <div class="ui vertical inverted sidebar menu left">

    </div>

    <div class="pusher">
        <div class="full height">
            <!--<script src="/js/home.js"></script>-->
            <link rel="stylesheet" type="text/css" href="/css/home.css">
            <div class="following bar">
                <div class="ui page grid">
                    <div class="column">
                        <div class="ui logo shape">
                            <div class="sides">
                                <div class="active learn side">
                                    <div class="header item">
                                        <img alt="Image cannot be displayed" class="ui image" src="/img/logo.png">
                                    </div>
                                </div>
                                <div class="ui side">
                                    <img alt="Image cannot be displayed" class="ui image" src="/img/logo.png">
                                </div>
                            </div>
                        </div>
                        <div class="ui inverted right floated secondary menu">
                            <?php if (isset($_SESSION['id'])) { ?>
                                <div class="ui combo top right pointing link dropdown item">
                                    <div class="text">
                                        <img alt="Image cannot be displayed"about=""  class="ui avatar image" src="/img/avatars/<?php echo $_SESSION['avatar'] ?>">
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
                                            <a class="item" href="/?p=admin"><i class="user icon"></i><span style="color: #ff0043;">Admin</span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <a href="/?p=login" class="btnlogin ui inverted button">Se connecter</a>
                            <?php } ?>
                        </div>
                        <div class="ui large inverted secondary network menu">
                            <a class="view-ui item" href="/">Accueil</a>
                            <a class="view-ui item" href="/?p=recettes">Recettes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masthead segment">
                <div class="ui page grid">
                    <div class="column">
                        <div class="introduction">
                            <h1 class="ui inverted header">
                                <span class="library">Cook Burn</span>
                            </h1>
                            <div class="ui hidden divider"></div>
                            <a class="ui big basic inverted orange view-ui button" href="/?p=recettes">
                                <i class="sidebar icon"></i>
                                Voir les recettes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui text container" style="right: auto;left: 0px;">
                <div class="ui vertical stripe segment">
                    <div class="ui middle aligned stackable grid container">
                        <div class="row">
                            <div class="wide column">
                                <?php \Core\Flash::showFlash(); ?>
                                <h2 class="ui header">Qu'est-ce que CookBurn ?</h2>
                                <p>Notre entreprise produit des barbecues connectés pour des clients. Grâce à notre site, vous aurez la possibilté de choisir ou d'ajouter les recettes proposées et de les cuisiner grâce à la description précise de chaque recette. Pour cela, vous devrez vous connecter avec vos identifiants CookBurn. Enfin, vous aurez la possibilité de noter la recette par un système de "Burns". La plus populaire apparaitra sur la page d'accueil de notre site.</p>
                                <div class="ui hidden divider"></div>

                                <div class="ui divider"></div>
                                    <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui vertical inverted black footer segment">
        </div>
    </div>
<script>
    $('.ui.dropdown').dropdown();
</script>
</body>
