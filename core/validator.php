<?php
/**
 * Validator.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */
namespace Core;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * Class Validator
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */
class Validator
{

    /**
     * Les erreurs qui ont été attapées lors de la vérification
     *
     * @var
     */
    protected $errors;

    /**
     * Parcours tous les champs et leurs valeurs et sont tous soumis respectivement à leurs règles.
     * Renvoye et de stocke les erreurs liées aux champs là où la vérification n'est pas valide.
     *
     * @param array $post  Les champs et valeurs du formulaires dans la variable superglobale $_POST
     * @param array $rules Les règles passées pour chaque champ
     *
     * @return $this
     */
    public function validate($post, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($post[$field]);
            } catch (NestedValidationException $e) {
                $e->findMessages(
                    [
                    'notEmpty' => 'Ce champ ne peut pas être vide',
                    'alpha' => 'Ce champ ne doit contenir que des lettres et {{additionalChars}}',
                    'alnum' => 'Ce champ doit contenir des caractères alphanumériques seulement et {{additionalChars}}',
                    'noWhitespace' => 'Ce champ ne peut pas contenir d\'espaces',
                    'length' => 'Ce champ doit être compris entre {{minValue}} et {{maxValue}} caractères',
                    'email' => 'Ce champ doit être un mail valide',
                    'extension' => 'Le fichier doit être en format {{extension}}',
                    'phone' => 'Le numéro de téléphone doit être un numéro valide',
                    'size' => 'Le fichier ne doit pas exéder {{maxSize}}',
                    'date' => 'Merci de rentrer une date'
                    ]
                );
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errorform'] = $this->errors;
        $_SESSION['oldinput'] = $post;
        return $this;
    }

    /**
     * Vérifie les erreurs attrapées lors de la vérification
     *
     * @return bool
     */
    public function success()
    {
        return empty($this->errors);
    }

    /**
     * Met en couleur l'input du formulaire faux, grâce à la classe CSS 'error' de Semantic UI
     *
     * @param string $errorform Le champ dont la vérification est fausse
     *
     * @return void
     */
    public static function formRedStyle($errorform)
    {
        if (isset($_SESSION['errorform'][$errorform])) {
            echo 'error';
        }
        echo '';
    }

    /**
     * Enregistre les valeurs des champs pour lesquelles la vérification est validée et les renvoie dans
     * leur champ du formulaire respective
     *
     * @param string $oldinput Le champ dont la vérification est réussie
     *
     * @return void
     */
    public static function formOldInput($oldinput)
    {
        if (empty($_SESSION['errorform'][$oldinput]) && !empty($_SESSION['oldinput'])) {
            echo $_SESSION['oldinput'][$oldinput];
        }
        echo '';
    }

    /**
     * Affiche et met en forme l'erreur correspondante au champ pour lesquels la validation d'un champ n'est
     * pas validée
     *
     * @param string $errorform Le message d'erreur à afficher
     * 
     * @return void
     */
    public static function formErrorMsg($errorform)
    {
        if (isset($_SESSION['errorform'][$errorform])) {
            echo '<span style="color: red;">' . $_SESSION['errorform'][$errorform][0] . '</span>';
        }
        echo '';
    }
}
