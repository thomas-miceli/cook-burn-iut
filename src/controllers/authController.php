<?php
/**
 * AuthController.php
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

use Src\Models\User;

use Respect\Validation\Validator as v;

/**
 * Class AuthController
 *
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
class AuthController extends Controller
{
    /**
     * Affiche la page de login et traite les données si le formulaire est envoyé
     *
     * @return mixed
     */
    public function login()
    {
        if (isset($_SESSION['id'])) {
            header('Location: /?p=profile&id=' . $_SESSION['id']);
        }
        if (isset($_POST['login'])) {
            $recaptcha = new \ReCaptcha\ReCaptcha('6LcBEDwUAAAAAESHAV5sWlg3oJWS4Ob2ho-SEu_3');
            $resp = $recaptcha->verify($_POST['g-recaptcha-response']);

            if ($resp->isSuccess()) {
                $u = new User();

                $login = $_POST['pseudo'];
                $password = $_POST['mdp'];

                $loginValidator = v::alnum()->noWhitespace()->notEmpty()->validate($login);
                $passwordValidator = v::noWhitespace()->notEmpty()->validate($password);

                if ($loginValidator && $passwordValidator) {
                    $password = hash('sha256', $password);
                    $stmt = $u->getUserLogin($login, $password);
                    $checkUser = $stmt->rowCount();
                    $userinfo = $stmt->fetch();

                    if ($checkUser == 1) {

                        if ($userinfo['actif'] == 0) {
                            $_SESSION['banned'] = 1;
                        }

                        $_SESSION['id'] = $userinfo['id'];
                        $_SESSION['pseudo'] = $userinfo['pseudo'];
                        $_SESSION['avatar'] = $userinfo['avatar'];
                        $_SESSION['role'] = $userinfo['role'];
                        header('Location: /?p=profile&id=' . $_SESSION['id']);

                    } else {
                        Flash::setFlash('Erreur', 'Identifiants incorrects', 'error');
                    }
                } else {
                    Flash::setFlash('Erreur', 'Merci de rentrer tous les champs', 'error');
                }
            } else {
                Flash::setFlash('Erreur', 'Captcha invalide', 'error');
            }
        }
        return $this->render('page', 'login', 'Connexion');

    }

    /**
     * Déconnecte et détruit la session de l'utilisateur connecté
     *
     * @return mixed
     */
    public function logout()
    {
        if (isset($_SESSION['id'])) {
            session_destroy();
        }
        return header('Location: /');
    }

    /**
     * Affiche la page de demande de mail pour reinitialiser le mot de passe et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function resetMDP()
    {
        if (!isset($_SESSION['id'])) {
            if (isset($_POST['resetform'])) {
                $token = hash('sha256', time() * rand(0, 99999));
                $u = new User();

                if ($u->checkExistingMail($_POST['mail'])->rowCount() == 1) {
                    $u->createToken($token, $_POST['mail']);
                    mail($_POST['mail'], 'Reset votre mot de passe.', 'Bonjour, cliquez ici pour reset votre mdp: http://tomus.alwaysdata.net/?p=reset&t=' . $token);
                    Flash::setFlash('Mail envoyé', 'Un mail de réinitialisation de mot de passe a été envoyé à ' . $_POST['mail'], 'success');
                    return header('Location: /');
                }
                Flash::setFlash('Erreur', 'Le mail entré ne figure pas dans nos bases de données', 'error');

            }
            return $this->render('page', 'forgot', 'Mot de passe oublié');
        }
        return header('Location: /?p=profile&id='.$_SESSION['id']);
    }

    /**
     * Affiche la page de réinitialisation de mot de passe et traite les données si le formulaire est passé
     *
     * @return mixed
     */
    public function setNewMDP()
    {
        if (!isset($_SESSION['id'])) {

            $u = new User();

            if (!empty($_GET['t']) || isset($_GET['t'])) {
                $_SESSION['token'] = $_GET['t'];
            }

            $token = $u->checkExistingToken($_SESSION['token']);

            if (isset($_POST['setpass'])) {
                if (isset($_POST['password1']) && $_POST['password1'] == $_POST['password2']) {
                    if ($token->rowCount() == 1) {
                        $u->setUserMdp($_SESSION['token'], hash('sha256', $_POST['password1']));
                        $u->resetToken($_SESSION['token']);
                        unset($_SESSION['token']);

                        Flash::setFlash('Mot de passe modifié', 'Votre mot de passe a été changé', 'success');
                        return header('Location: /');
                    }
                    Flash::setFlash('Erreur', 'Erreur de token, lien invalide', 'error');
                }
                Flash::setFlash('Erreur', 'Merci de respecter les conditions des champs', 'error');
            }
            return $this->render('page', 'reset', 'Réinitialisation du mot de passe');
        }
        return header('Location: /?p=profile&id='.$_SESSION['id']);

    }
}
