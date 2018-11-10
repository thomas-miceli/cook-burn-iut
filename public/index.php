<?php
/**
 * Index.php
 * PHP version 7.1.19
 *
 * Point d'entrée de l'application, ce fichier fait office de front controlleur, c'est ici que notre site
 * s'exécute.
 *
 * @category PHP
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */

define('ROOT', dirname(__DIR__));
define('VALID_CHARS_RECIPE', '. , - É È Ê Ë Ö Ô Ó Ò À Â â é è ê ( / ) ë ù ú Ú Ù : î à ô ö % ° @ " ’ \' ? ! Œ œ');
define('VALID_CHARS_NAME', '- _ é è ê ë à ô ö ù ú Ú Ù Ó ò Â â É È Ê Ë Ö Ô À Œ œ î');
session_start();

require ROOT . '/vendor/autoload.php';

$router = new \Core\Router();
$maintenance = new \Src\Models\Configuration;
$maintenance = $maintenance->getParam('maintenance')->fetch()['value'];

// Si le site en est maintenance, alors on renvoie l'erreur 503
if ($maintenance == 1) {
    $router->error('err503');
}

// Si l'utilisateur est banni, alors on renvoie la page banni ainsi que l'erreur 503, et l'utilisateur ne peut que se
// déconnecter
if ((isset($_SESSION['banned']) ? $_SESSION['banned'] : null) == 1) {
    $router->route('logout', 'user', 'logout');
    $router->error('banned');
}

// Si alors notre routeur n'a pas instancé de controlleur (hors controlleur d'erreur), on test les différentes routes
if ($router->instance == 0) {

    // Si la page cible n'est pas spécifiée, on renvoie directement l'utilisateur à l'accueil
    if (isset($_GET['p'])) {

        // Si la page cible est l'espace d'administration, sinon on ne fait rien et on test les autres routes
        if ($_GET['p'] == 'admin') {

            // Si l'utilisateur est connecté est son niveau de permission est de 3, alors on testera les différentes
            // routes, sinon on renvoie une erreur HTTP 403 forbidden
            if ((isset($_SESSION['role']) ? $_SESSION['role'] : null) == 3) {

                // Si la page cible n'est pas spécifiée, on renvoie directement l'utilisateur à l'accueil, sinon on test
                // les routes
                if (isset($_GET['panel'])) {
                    $router->adminRoute('users', 'users');
                    $router->adminRoute('usercreate', 'createUser');
                    $router->adminRoute('userupdate', 'updateUser');
                    $router->adminRoute('userdelete', 'deleteUser');
                    $router->adminRoute('toggleban', 'toggleBanUser');

                    $router->adminRoute('recipes', 'recipes');
                    $router->adminRoute('newrecipe', 'createRecipe');
                    $router->adminRoute('updaterecipe', 'updateRecipe');
                    $router->adminRoute('deleterecipe', 'deleteRecipe');

                    $router->adminRoute('ingredients', 'ingredients');
                    $router->adminRoute('newingredient', 'createIngredient');
                    $router->adminRoute('updateingredient', 'updateIngredient');
                    $router->adminRoute('deleteingredient', 'deleteIngredient');

                    $router->adminRoute('config', 'config');

                    // Si la page cible est inconnue, on renvoie l'accueil du panneau d'administration
                    if ($router->instance == 0) {
                        $router->defaultAdminRoute();
                    }

                } else {
                    $router->defaultAdminRoute();
                }
            } else {
                $router->error('err403');
            }
        }

        $router->route('login', 'auth', 'login');
        $router->route('logout', 'auth', 'logout');
        $router->route('forgot', 'auth', 'resetMDP');
        $router->route('reset', 'auth', 'setNewMDP');

        $router->route('newrecette', 'recipe', 'createRecipe');
        $router->route('edit', 'recipe', 'editRecipe');
        $router->route('delete', 'recipe', 'deleteRecipe');
        $router->route('query', 'recipe', 'search');
        $router->route('recettes', 'recipe', 'showAll');
        $router->route('recette', 'recipe', 'show');

        $router->route('profile', 'user', 'showProfile');
        $router->route('editprofile', 'user', 'editProfile');
        $router->route('favorites', 'user', 'showFavorites');
        $router->route('myrecipes', 'user', 'showAllUserRecipes');

        // Si la page cible est inconnue, on renvoie une erreur HTTP 404 not found
        if ($router->instance == 0) {
            $router->error('err404');
        }
    } else {
        $router->defaultRoute();
    }
}
