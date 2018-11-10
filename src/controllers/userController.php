<?php
/**
 * UserController.php
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
use ReCaptcha\ReCaptcha;
use Src\Models\Recipes;
use Src\Models\User;

use Respect\Validation\Validator as v;

/**
 * Class UserController
 *
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
class UserController extends Controller
{
    /**
     * Affiche le profil d'un utilisateur
     *
     * @return mixed
     */
    public function showProfile()
    {
        if (isset($_SESSION['id'])) {
            if (filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
                $u = new User();
                $user = $u->getUser($_GET['id']);
                if ($user->rowCount() == 1) {
                    $user = $user->fetch();

                    $r = new Recipes();
                    $uRecipes = $r->getRecipeByUser($_GET['id']);
                    $uRecipes = $uRecipes->fetchAll();
                    $totalBurns = $r->getTotalBurns($_GET['id'])->fetch();
                    $limit = 10;
                    return $this->render('page', 'profile', 'Profile de ' . $user['pseudo'], compact('user', 'uRecipes', 'limit', 'totalBurns'));
                }
                return $this->err404();
            }
            return $this->err400();
        }
        return $this->err403();
    }

    /**
     * Affiche l'espace d'édition d'un profil et traite les données si le formulaire est envoyé
     *
     * @return mixed|void
     */
    public function editProfile()
    {
        if (isset($_SESSION['id'])) {
            $u = new User();
            if (isset($_POST['envoyer'])) {
                if (isset($_POST['prenom']) || isset($_POST['nom']) || isset($_POST['mail'])) {
                    $validator = new Validator();
                    $validator->validate(
                        $_POST, [
                        'prenom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 25),
                        'nom' => v::alpha(VALID_CHARS_NAME)->notEmpty()->length(1, 50),
                        'mail' => v::email()->notEmpty()->noWhitespace()
                        ]
                    );

                    if ($validator->success()) {
                        $u->updateUserInfo($_SESSION['id'], $_POST['prenom'], $_POST['nom'], $_POST['mail']);
                    }
                }
                if (!empty($_FILES['avatar'])) {
                    if (($_FILES['avatar']['type'] == 'image/jpeg' || $_FILES['avatar']['type'] == 'image/png') && $_FILES['avatar']['size'] < 30001) {
                        $dirname = 'img/avatars/';
                        $filename = $_SESSION['id'] . '.jpg';

                        move_uploaded_file($_FILES['avatar']['tmp_name'], $dirname . $filename);
                        $u->updateAvatar($_SESSION['id'], $filename);

                        // Permet de reset le cache car l'ancienne photo restait
                        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                        header("Cache-Control: post-check=0, pre-check=0", false);
                        header("Pragma: no-cache");
                    }
                }

                if (!empty($_POST['oldmdp']) || !empty($_POST['newmdp']) || !empty($_POST['newmdp2'])) {
                    $oldmdp = $u->getUserMdp($_SESSION['id']);
                    $validator = new Validator();
                    $validator->validate(
                        $_POST, [
                        'oldmdp' => v::notEmpty()->length(6, 30)->equals($oldmdp),
                        'newmdp' => v::notEmpty()->length(6, 30),
                        'newmdp2' => v::notEmpty()->length(6, 30)->equals($_POST['newmdp'])
                        ]
                    );

                    if ($validator->success()) {
                        $u->updateMdp($_SESSION['id'], hash('sha256', $_POST['newmdp']));
                    }
                }

                $confn = 0;
                $confm = 0;

                if (isset($_POST['confn'])) {
                    $confn = 1;
                }

                if (isset($_POST['confm'])) {
                    $confm = 1;
                }

                $u->updateConfidentiality($_SESSION['id'], $confn, $confm);

                Flash::setFlash('Profil modifié', 'Vos changements ont été pris en compte', 'success');
                return header('Location: /?p=profile&id='.$_SESSION['id']);
            }

            $user = $u->getUser($_SESSION['id'])->fetch();
            return $this->render('page', 'editprofile', 'Édition de mon profil', compact('user'));
        }
        return $this->err403();
    }

    /**
     * Affiche la liste des recettes favorites de l'utilisateur connecté
     *
     * @return mixed
     */
    public function showFavorites()
    {
        if (isset($_SESSION['id'])) {
            $r = new Recipes();
            $favRecipes = $r->getFavorites($_SESSION['id']);
            $favRecipes = $favRecipes->fetchAll();
            return $this->render('page', 'favoris', 'Mes favoris', compact('favRecipes'));
        }
        return $this->err403();
    }


    /**
     * Affiche toutes les recettes, ou celles demandées, de l'utilisateur
     *
     * @return mixed
     */
    public function showAllUserRecipes()
    {
        if (isset($_SESSION['id'])) {
            $r = new Recipes();

            $sql = 'SELECT * FROM recettes WHERE id_auteur = ' . $_SESSION['id'];

            if (isset($_GET['show'])) {
                switch ($_GET['show']) {
                case 'public': $sql .= ' AND status = 2';
                    break;
                case 'private': $sql .= ' AND status = 1';
                    break;
                case 'draft': $sql .= ' AND status = 0';
                    break;
                }
            }

            if (isset($_GET['tri'])) {
                switch ($_GET['tri']) {
                case 'last': $sql .= ' ORDER BY created_at DESC';
                    break;
                case 'name': $sql .= ' ORDER BY titre ASC';
                    break;
                case 'burns': $sql .= ' ORDER BY burns DESC';
                    break;
                }
            }
            $recipes = $r->getAllRecipesByUserCustom($sql)->fetchAll();
            return $this->render('page', 'myrecipes', 'Mes recettes', compact('recipes'));
        }
        return $this->err403();
    }
}
