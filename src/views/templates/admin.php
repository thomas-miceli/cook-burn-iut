<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/dist/semantic.min.css">

    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/img/site.webmanifest">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#ffc40d">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">

    <title>Administration | Cook & Burn</title>

    <style type="text/css">

        .main.container {
            margin-top: 6em;
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

        .quote.stripe.segment {
            padding: 0em;
        }
        .quote.stripe.segment .grid .column {
            padding-top: 5em;
            padding-bottom: 5em;
        }

        .footer.segment {
            padding: 5em 0em;
        }

        @media only screen and (max-width: 700px) {
            .ui.fixed.menu {
                display: none !important;
            }
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/dist/semantic.min.js"></script>

    <script>
        $(document)
            .ready(function() {

                // create sidebar and attach to menu open
                $('.ui.sidebar')
                    .sidebar('attach events', '.toc.item')
                ;
            })
        ;
    </script>

</head>
<body>
<div class="ui left fixed vertical menu inverted">
    <div class="item">
        <img alt="Image cannot be displayed" class="ui mini image" src="/img/logo.png"><span class="ui">Administration</span>
        <div class="ui inverted divider"></div>
        <p><?php echo $_SESSION['pseudo']; ?></p>
    </div>
    <a class="item" href="/?p=admin">Accueil</a>
    <a class="item" href="/?p=admin&panel=users">Utilisateurs</a>
    <a class="item" href="/?p=admin&panel=recipes">Recettes</a>
    <a class="item" href="/?p=admin&panel=ingredients">Ingredients</a>
    <a class="item" href="/?p=admin&panel=config">Configuration</a>
    <a class="item" href="/">Retour au site</a>
</div>

<div class="ui main text container">
    <?php \Core\Flash::showFlash(); ?>
    <?php echo $content; ?>
</div>
</body>
<script>
    $('.ui.accordion').accordion();
    $('.ui.dropdown').dropdown();
</script>
</body>
</html>