<?php http_response_code(403);?>
<span style="color: red;"><code>403 forbidden</code></span>
<p>Vous êtes sur une page qui nécessite de s'authentifier, ou alors vous n'y avez pas accès.</p>
<p>Si vous pensez que c'est une erreur, merci d'envoyer un mail à <a href="mailto:tomus.mic@gmail.com">tomus.mic@gmail.com</a></p>

<?php if (!isset($_SESSION['id'])) {?>
    <a href="/?p=login"><button class="ui button teal">Se connecter</button></a>
<?php } ?>
<a href="/"><button class="ui button green">Revenir à l'accueil</button></a>
