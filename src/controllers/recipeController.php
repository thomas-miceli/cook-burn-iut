<?php
/**
 * RecipeController.php
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
use Src\Models\Ingredients;
use Src\Models\Recipes;
use Src\Models\User;

use Respect\Validation\Validator as v;

/**
 * Class RecipeController
 *
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
class RecipeController extends Controller
{

    /**
     * Affiche toutes les recettes publiques et leur auteur
     *
     * @return void
     */
    public function showAll()
    {
        $r = new Recipes();
        $recipes = $r->getRecipes()->fetchAll();
        $u = new User();
        $users = $u->getAllUsers()->fetchAll();
        $limit = 10;
        $this->render('page', 'recettes', 'Toutes les recettes', compact('recipes', 'users', 'limit'));
    }

    /**
     * Affiche une recette selon l'id fournie
     *
     * @return mixed|void
     */
    public function show()
    {
        if (filter_var($_GET['r'], FILTER_VALIDATE_INT)) {
            $r = new Recipes();
            $u = new User();

            $exist = $r->getRecipe($_GET['r'])->rowCount();
            if ($exist == 1) {
                $isAvailable = $r->getRecipe($_GET['r']);
                $isAvailable = $isAvailable->fetch();
                if (($isAvailable['burns'] < 10 && !isset($_SESSION['id'])) || $isAvailable['status'] != 2  ) {
                    return $this->render('page', 'errors/403');

                } else if (isset($_SESSION['id']) || $isAvailable['burns'] >= 10 && !isset($_SESSION['id'])) {
                    $rrecipe = $r->getRecipe($_GET['r']);
                    $recipe = $rrecipe->fetch();

                    $etapes = $r->getEtape($_GET['r']);
                    $etapes = $etapes->fetchAll();

                    $ingredients = $r->getIngredients($_GET['r']);
                    $ingredients = $ingredients->fetchAll();

                    $username = $u->getUser($recipe['id_auteur']);
                    $username = $username->fetch();
                    $myRecipe = 0;

                    if (isset($_SESSION['id'])) {
                        $isFavorite = $r->isFavorite($_SESSION['id'], $_GET['r']);
                        $favCount = $isFavorite->rowCount();

                        $isLiked = $r->isLiked($_SESSION['id'], $_GET['r']);
                        $burnCount = $isLiked->rowCount();

                        if (isset($_POST['addfav']) && $favCount == 0) {
                            $r->addFavorite($_SESSION['id'], $_GET['r']);
                        }

                        if (isset($_POST['rmfav']) && $favCount == 1) {
                            $r->removeFavorite($_SESSION['id'], $_GET['r']);
                        }

                        if (isset($_POST['addburn']) && $burnCount == 0) {
                            $r->addBurn($_SESSION['id'], $_GET['r']);
                        }

                        if (isset($_POST['rmburn']) && $burnCount == 1) {
                            $r->removeBurn($_SESSION['id'], $_GET['r']);
                        }

                        //Actualisation du rowCount après l'ajout ou le retrait du favori
                        $isFavorite = $r->isFavorite($_SESSION['id'], $_GET['r']);
                        $favCount = $isFavorite->rowCount();

                        $isLiked = $r->isLiked($_SESSION['id'], $_GET['r']);
                        $burnCount = $isLiked->rowCount();

                        $rrecipe = $r->getRecipe($_GET['r']);
                        $recipe = $rrecipe->fetch();

                        if ($_SESSION['id'] == $recipe['id_auteur']) {
                            $myRecipe = 1;
                        }
                    }
                    return $this->render('page', 'recette', $recipe['titre'], compact('recipe', 'etapes', 'ingredients', 'username', 'favCount', 'burnCount', 'myRecipe'));
                } else {
                    return header('Location: ?p=index');
                }
            } else {
                return $this->err404();
            }
        } else {
            return $this->err400();
        }
    }

    /**
     * Affiche l'espace de création de recette et traite les données si le formulaire est envoyé
     *
     * @return mixed|void
     */
    public function createRecipe()
    {
        if (isset($_SESSION['id'])) {

            $i = new Ingredients();
            $ingredients = $i->getIngredients()->fetchAll();

            if (isset($_POST['envoyer']) || isset($_POST['brouillon'])) {
                $validator = new Validator();
                $validator->validate(
                    $_POST, [
                    'titre' => v::alpha(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                    'nbpers' => v::intVal()->digit()->notEmpty()->positive(),
                    'sdesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                    'ldesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 500),
                    'etapes' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 1500),
                    'status' => v::intVal()->digit()->between(0, 2)
                    ]
                );

                if ($validator->success() && ($_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png') && $_FILES['img']['size'] < 180001) {
                    $r = new Recipes();
                    $dirname = 'img/recipes/';
                    $filename = uniqid($_SESSION['id'] . '-') . '.jpg';

                    if (!is_dir($dirname)) {
                        mkdir($dirname, 0777, true);
                    }

                    if (isset($_POST['envoyer'])) {
                        $id = $r->createRecipe($_SESSION['id'], $_POST['titre'], $_POST['nbpers'], $filename, $_POST['sdesc'], $_POST['ldesc'], $_POST['status']);

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
                    } else if (isset($_POST['brouillon'])) {
                        $id = $r->createRecipe($_SESSION['id'], $_POST['titre'], $_POST['nbpers'], $filename, $_POST['sdesc'], $_POST['ldesc'], 0);

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
                    }
                    move_uploaded_file($_FILES['img']['tmp_name'], $dirname . $filename);
                    Flash::setFlash('Recette créée', 'Votre recette a bien été créée', 'success');
                    return header('Location: /?p=recette&r=' . $id);
                }
            }
            return $this->render('page', 'newrecette', 'Nouvelle recette', compact('recipe', 'ingredients'));
        }
        return $this->err403();
    }

    /**
     * Affiche l'espace d'édition de recette et traite les données si le formulaire est envoyé
     *
     * @return mixed|void
     */
    public function editRecipe()
    {
        $r = new Recipes();
        if (isset($_SESSION['id'])) {
            if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
                if ($_SESSION['id'] == $r->getRecipe($_GET['id'])->fetch()['id_auteur']) {
                    if (isset($_POST['envoyer'])) {
                        $validator = new Validator();
                        $validator->validate(
                            $_POST, [
                            'titre' => v::alpha(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                            'nbpers' => v::intVal()->digit()->notEmpty()->positive(),
                            'sdesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 50),
                            'ldesc' => v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 250),
                            'etapes'=> v::alnum(VALID_CHARS_RECIPE)->notEmpty()->length(8, 5000),
                            'status' => v::intVal()->digit()->between(0, 2)
                            ]
                        );

                        if ($validator->success()) {
                            $r->updateRecipe($_GET['id'], $_POST['titre'], $_POST['nbpers'], $_POST['sdesc'], $_POST['ldesc'], $_POST['status']);

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
                            return header('Location: /?p=recette&r=' . $_GET['id']);
                        }
                    }

                    $recipe = $r->getRecipe($_GET['id']);
                    $recipe = $recipe->fetch();

                    $etapes = $r->getEtape($_GET['id']);
                    $etapes = $etapes->fetchAll();

                    return $this->render('page', 'editrecette', 'Édition : ' . $recipe['titre'], compact('recipe', 'etapes'));
                }
                return $this->err403();
            }
            return $this->err400();
        }
        return $this->err403();
    }

    /**
     * Supprime une recette où l'id de la recette est fourni
     *
     * @return mixed|void
     */
    public function deleteRecipe()
    {
        if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $r = new Recipes();
            $rec = $r->getRecipe($_GET['id'])->fetch();
            if ($_SESSION['id'] == $rec['id_auteur']) {
                $r->deleteRecipe($_GET['id']);
                unlink('img/recipes/' . $rec['img']);
                Flash::setFlash('Recette supprimée', 'Votre recette a bien été supprimée', 'success');
                return header('Location: /');
            }
            return $this->err403();
        }

        return $this->err400();
    }

    /**
     * Traite et affiche les résultats d'une recherche de recette
     *
     * @return mixed|void
     */
    public function search()
    {
        if (isset($_SESSION['id'])) {
            if (v::alnum(VALID_CHARS_RECIPE)->notEmpty()->validate($_GET['q']) && v::intVal()->digit()->between(1, 3)->validate($_GET['type'])) {
                $r = new Recipes();

                switch ($_GET['type']) {
                case 1:
                    $recipes = $r->getSearch('titre', $_GET['q'])->fetchAll(); 
                    break;
                case 2:
                    $recipes = $r->getSearch('desc', $_GET['q'])->fetchAll(); 
                    break;
                case 3:
                    $recipes = $r->getSearch('ingr', $_GET['q'])->fetchAll(); 
                    break;
                }
                $u = new User();
                $users = $u->getAllUsers()->fetchAll();
                $limit = 10;
                return $this->render('page', 'query', 'Résultats de la recherche', compact('recipes', 'users', 'limit'));
            }
             return header('Location: /?p=recettes');
        }
        return $this->err403();
    }
}
