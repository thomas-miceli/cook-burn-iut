<?php
/**
 * AdminController.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
namespace Src\Controllers;

use Core\Controller;

use Core\Flash;
use Core\Validator;
use Src\Models\Configuration;
use Src\Models\Ingredients;
use Src\Models\Recipes;
use Src\Models\Themes;
use Src\Models\User;

use \Respect\Validation\Validator as v;

/**
 * Class AdminController
 * 
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
class AdminController extends Controller
{

    /**
     * Affiche l'accueil de l'espace d'administration
     *
     * @return mixed
     */
    public function index()
    {
        $r = new Recipes();
        $u = new User();
        $i = new Ingredients();
        $nbusers = $u->getAllUsers()->rowCount();
        $nbrecettes = $r->getAllRecipes()->rowCount();
        $nbingred = $i->getIngredients()->rowCount();
        return $this->render('admin', 'admin/adminIndex', '', compact('nbusers', 'nbrecettes', 'nbingred'));

    }

    /**
     * Affiche la liste de tous les utilisateurs
     *
     * @return mixed
     */
    public function users()
    {
        $u = new User();
        $users = $u->getAllUsers()->fetchAll();
        return $this->render('admin', 'admin/adminUsers', '', compact('users'));
    }

    /**
     * Affiche la page de création d'utilisateur et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function createUser()
    {
        $u = new User();

        if (isset($_POST['envoyer'])) {
            $validator = new Validator();
            $validator->validate(
                $_POST, [
                'pseudo' => v::alnum('- _')->notEmpty()->noWhitespace()->length(3, 16),
                'prenom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 25),
                'nom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 50),
                'mail' => v::email()->notEmpty()->noWhitespace(),
                'mdp' => v::notEmpty()->length(6, 30),
                'role' => v::intVal()->digit()->between(1, 3)
                ]
            );

            if ($validator->success()) {
                $u->createUser($_POST['pseudo'], $_POST['prenom'], $_POST['nom'], $_POST['mail'], hash('sha256', $_POST['mdp']), $_POST['role']);
                Flash::setFlash('Utilisateur créé', 'L\'utilisateur <b>' . $_POST['pseudo'] . '</b> a bien été créé', 'success');
                return header('Location: /?p=admin&panel=users');
            }
        }
        return $this->render('admin', 'admin/adminUserCreate', '');
    }

    /**
     * Affiche la page d'édition d'utilisateur et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function updateUser()
    {
        $u = new User();
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $user = $u->getUser($_GET['id'])->fetch();

            if (isset($_POST['envoyer'])) {
                $validator = new Validator();
                $validator->validate(
                    $_POST, [
                    'pseudo' => v::alnum('- _')->notEmpty()->noWhitespace()->length(3, 16),
                    'prenom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 25),
                    'nom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 50),
                    'mail' => v::email()->notEmpty()->noWhitespace(),
                    'role' =>  v::intVal()->digit()->between(1, 3),
                    ]
                );
                if ($validator->success()) {
                    $u->updateUser($_GET['id'], $_POST['pseudo'], $_POST['prenom'], $_POST['nom'], $_POST['mail'], $_POST['role']);
                    Flash::setFlash('Utilisateur modifié', 'L\'utilisateur <b>' . $_POST['pseudo'] . '</b> a bien été modifié', 'success');
                    return header('Location: /?p=admin&panel=users');
                }
            }
            return $this->render('admin', 'admin/adminUserUpdate', '', compact('user'));
        }
        Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        return header('Location: /?p=admin&panel=users');
    }

    /**
     * Banni/débanni un utilisateur
     *
     * @return mixed
     */
    public function toggleBanUser()
    {
        $u = new User();
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $user = $u->getUser($_GET['id'])->fetch();
            if ($user['role'] < $_SESSION['role']) {

                if ($user['actif'] == 0) {
                    $u->toggleBan($_GET['id'], 1);
                    Flash::setFlash('Utilisateur débanni', 'L\'utilisateur <b>' . $u->getUser($_GET['id'])->fetch()['pseudo'] . '</b> a bien été débanni', 'success');
                }
                if ($user['actif'] == 1) {
                    $u->toggleBan($_GET['id'], 0);
                    Flash::setFlash('Utilisateur banni', 'L\'utilisateur <b>' . $u->getUser($_GET['id'])->fetch()['pseudo'] . '</b> a bien été banni', 'success');
                }
                return header('Location: /?p=admin&panel=users');
            }
            Flash::setFlash('Erreur', 'Vous ne pouvez pas bannir cet utilisateur', 'error');
        } else {
            Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        }
        return header('Location: /?p=admin&panel=users');

    }

    /**
     * Supprime un utilisateur
     *
     * @return mixed
     */
    public function deleteUser()
    {
        $u = new User();
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $user = $u->getUser($_GET['id'])->fetch();
            if ($user['role'] < $_SESSION['role']) {
                $u->deleteUser($_GET['id']);
                unlink('img/avatars/' . $user['avatar']);
                Flash::setFlash('Utilisateur supprimé', 'L\'utilisateur <b>' . $user['pseudo'] . '</b> a bien été supprimé', 'success');
                return header('Location: /?p=admin&panel=users');
            }
            Flash::setFlash('Erreur', 'Vous ne pouvez pas supprimer cet utilisateur', 'error');
        }
        Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        return header('Location: /?p=admin&panel=users');
    }

    /**
     * Affiche la liste de toutes les recettes
     *
     * @return mixed
     */
    public function recipes()
    {
        $r = new Recipes();
        $u = new User();
        $users = $u->getAllUsers()->fetchAll();
        $recipes = $r->getAllRecipes()->fetchAll();
        return $this->render('admin', 'admin/adminRecipes', '', compact('recipes', 'users'));
    }

    /**
     * Affiche la page de création de recette et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function createRecipe()
    {
        $i = new Ingredients();
        $ingredients = $i->getIngredients()->fetchAll();

        $u = new User();
        $users = $u->getAllUsers()->fetchAll();

        if (isset($_POST['envoyer'])) {
            $validator = new Validator();
            $validator->validate(
                $_POST, [
                'auteur' => v::intVal()->notEmpty(),
                'titre' => v::alpha(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                'nbpers' => v::intVal()->digit()->notEmpty()->positive(),
                'sdesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                'ldesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 500),
                'etapes' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 1500),
                'status' => v::intVal()->digit()->between(0, 2)
                ]
            );

            if ($validator->success() && ($_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png') && $_FILES['img']['size'] < 30001) {
                $r = new Recipes();
                $dirname = 'img/recipes/';
                $filename = uniqid($_SESSION['id'] . '-') . '.jpg';

                if (!is_dir($dirname)) {
                    mkdir($dirname, 0777, true);
                }

                $id = $r->createRecipe($_POST['auteur'], $_POST['titre'], $_POST['nbpers'], $filename, $_POST['sdesc'], $_POST['ldesc'], $_POST['status']);

                $etapeList = explode(PHP_EOL, $_POST['etapes']);

                $i = 0;

                foreach ($_POST['ingredients'] as $ingredient) {
                    if (v::intVal()->notEmpty()->validate($ingredient)) {
                        $r->setIngredient($id, $ingredient);
                    }
                }

                foreach ($etapeList as $etape) {
                    if (v::notEmpty()->validate($etape)) {
                        $r->setEtape($id, ++$i, $etape);
                    }
                }

                move_uploaded_file($_FILES['img']['tmp_name'], $dirname . $filename);
                Flash::setFlash('Recette créée', 'La recette a bien été créée', 'success');
                return header('Location: /?p=admin&panel=recipes');
            }
        }
        return $this->render('admin', 'admin/adminRecipeCreate', '', compact('recipe', 'ingredients', 'users'));
    }

    /**
     * Affiche la page d'édition de recette et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function updateRecipe()
    {
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $u = new User();
            $users = $u->getAllUsers()->fetchAll();

            $r = new Recipes();
            $recipe = $r->getRecipe($_GET['id'])->fetch();

            $etapes = $r->getEtape($_GET['id'])->fetchAll();

            if (isset($_POST['envoyer'])) {
                $validator = new Validator();
                $validator->validate(
                    $_POST, [
                    'auteur' => v::intVal()->notEmpty(),
                    'titre' => v::alpha(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                    'nbpers' => v::intVal()->digit()->notEmpty()->positive(),
                    'sdesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                    'ldesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 500),
                    'etapes' =>v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 1500),
                    'status' => v::intVal()->digit()->between(0, 2)
                    ]
                );

                if ($validator->success()) {
                    $r->updateRecipe($_GET['id'], $_POST['titre'], $_POST['nbpers'], $_POST['sdesc'], $_POST['ldesc'], $_POST['status']);
                    $r->updateAuthor($_GET['id'], $_POST['auteur']);
                    $etapeList = explode(PHP_EOL, $_POST['etapes']);

                    $i = 0;
                    foreach ($etapeList as $etape) {
                        if (v::notEmpty()->validate($etape)) {
                            $r->setEtape($_GET['id'], ++$i, $etape);
                        }
                    }
                    // Permet de retirer les étapes en trop, les dernières de la liste qui sont supprimées lors de l'edition
                    $r->removeLasts($_GET['id'], $i);
                    Flash::setFlash('Recette modifiée', 'Votre recette a bien été modifiée', 'success');
                    return header('Location: /?p=admin&panel=recipes');
                }
            }
            return $this->render('admin', 'admin/adminRecipeUpdate', '', compact('recipe', 'users', 'etapes'));
        }
        Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        return header('Location: /?p=admin&panel=recipes');
    }

    /**
     * Supprime une recette
     *
     * @return mixed
     */
    public function deleteRecipe()
    {
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $r = new Recipes();
            $r->deleteRecipe($_GET['id']);
            $rec = $r->getRecipe($_GET['id'])->fetch();
            unlink('img/recipes/' . $rec['img']);
            Flash::setFlash('Recette supprimée', 'Votre recette a bien été supprimée', 'success');
            return header('Location: /?p=admin&panel=recipes');
        }
        Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        return header('Location: /?p=admin&panel=recipes');
    }

    /**
     * Affiche la liste de tous les ingrédients
     *
     * @return mixed
     */
    public function ingredients()
    {
        $i = new Ingredients();
        $ingredients = $i->getIngredients()->fetchAll();
        return $this->render('admin', 'admin/adminIngredients', '', compact('ingredients'));

    }

    /**
     * Affiche la page de création d'ingrédient et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function createIngredient()
    {
        $i = new Ingredients();

        if (isset($_POST['envoyer'])) {
            $validator = new Validator();
            $validator->validate(
                $_POST, [
                'nom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 50)
                ]
            );

            if ($validator->success()) {
                $i->createIngredient($_POST['nom']);
                Flash::setFlash('Ingrédient créé', 'L\'ingrédient <b>' . $_POST['nom'] . '</b> a bien été créé', 'success');
                return header('Location: /?p=admin&panel=ingredients');
            }
        }
        return $this->render('admin', 'admin/adminIngredientCreate', '');
    }

    /**
     * Affiche la page d'édition d'ingrédient et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function updateIngredient()
    {
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {

            $i = new Ingredients();
            $ingredient = $i->getIngredient($_GET['id'])->fetch();
            if (isset($_POST['envoyer'])) {
                $validator = new Validator();
                $validator->validate(
                    $_POST, [
                    'nom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 50)
                    ]
                );

                if ($validator->success()) {
                    $i->updateIngredient($_GET['id'], $_POST['nom']);
                    Flash::setFlash('Ingrédient modifié', 'L\'ingrédient <b>' . $ingredient['nom'] . '</b> a bien été modifié', 'success');
                    return header('Location: /?p=admin&panel=ingredients');
                }
            }
            return $this->render('admin', 'admin/adminIngredientUpdate', '', compact('ingredient'));
        }
        Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        return header('Location: /?p=admin&panel=ingredients');
    }

    /**
     * Supprime un ingrédient
     *
     * @return mixed
     */
    public function deleteIngredient()
    {
        $i = new Ingredients();
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $ing = $i->getIngredient($_GET['id'])->fetch();
            $i->deleteIngredient($_GET['id']);
            Flash::setFlash('Ingrédient supprimé', 'L\'ingrédient <b>' . $ing['nom'] . '</b> a bien été supprimé', 'success');
        } else {
            Flash::setFlash('Erreur', 'Erreur lors de la requête', 'error');
        }
        return header('Location: /?p=admin&panel=ingredients');
    }

    /**
     * Affiche la page de d'édition des configurations et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function config()
    {
        $i = new Ingredients();
        $c = new Configuration();
        $t = new Themes();

        if (isset($_POST['envoyer'])) {
            if (isset($_POST['theme']) && v::intVal()->digit()->between(1, 4)->validate($_POST['theme'])) {
                $c->setParam('theme', $_POST['theme']);
            }

            if (isset($_POST['feat']) && v::intVal()->digit()->validate($_POST['feat'])) {
                $c->setParam('featured_ingredient', $_POST['feat']);
            }

            if (isset($_POST['pagi']) && v::intVal()->digit()->between(1, 4)->validate($_POST['pagi'])) {
                $c->setParam('pagination', $_POST['pagi']);
            }
            Flash::setFlash('Mis à jour', 'Configurations mises à jour', 'success');
        }


        $ingredients = $i->getIngredients()->fetchAll();
        $themes = $t->getThemes()->fetchAll();
        $currentIngr = $i->getIngredient($c->getParam('featured_ingredient')->fetch()[0])->fetch();
        $currentTheme = $t->getTheme($c->getParam('theme')->fetch()[0])->fetch();
        $currentPagi = $c->getParam('pagination')->fetch()[0];

        return $this->render('admin', 'admin/adminConfig', '', compact('ingredients', 'themes', 'currentIngr', 'currentTheme', 'currentPagi'));
    }

}
