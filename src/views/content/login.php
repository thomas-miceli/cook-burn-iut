<style>
    body {
        background-color: #DADADA;
    }

    body > .grid {
        height: 100%;
    }

    .image {
        margin-top: -100px;
    }

    .column {
        max-width: 450px;
    }
</style>


<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
            <img src="/img/logo.png" class="image">
            <div class="content">
                Connectez-vous
            </div>
        </h2>
        <form class="ui large form" method="post" action="?p=login" enctype="application/x-www-form-urlencoded">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LcBEDwUAAAAAIioF79QH4f7rME-IRz20fKmgiE-"></div>
                <div class="field">
                    <input class="ui fluid large teal submit button" type="submit" name="login" value="Connexion">
                </div>
                <div class="field">
                    <a href="/?p=forgot" class="ui fluid large gray submit button">Mot de passe oublié</a>
                </div>

            </div>

        </form>
    </div>
</div>