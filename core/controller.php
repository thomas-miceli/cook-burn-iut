<?php
/**
 * Controller.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */
namespace Core;

/**
 * Class Controller
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */
class Controller
{

    /**
     * Lien vers le template utilisé
     *
     * @var string
     */
    protected $viewTemplate = '../src/views/templates/';
    /**
     * Lien vers le fichier de contenu utilisé
     *
     * @var string
     */
    protected $viewContent = '../src/views/content/';

    /**
     * Retourne une vue en incluant le lien du template et le contenu
     *
     * @param string $template  Lien du template
     *                          utilisé
     * @param string $view      Lien du fichier du contenu
     *                          utilisé
     * @param string $title     Titre de la page HTML
     * @param array  $variables Variables traitées dans le controlleur à passer dans la vue
     *
     * @return mixed
     */
    protected function render($template, $view, $title, $variables = [])
    {
        ob_start();
        extract($variables);
        include $this->viewContent . $view . '.php';
        $content = ob_get_clean();
        return include $this->viewTemplate . $template . '.php';
    }

    /**
     * Retourne une page d'erreur de bannissement
     *
     * @return mixed
     */
    protected function banned()
    {
        return $this->render('page', 'errors/banned', 'Banni du site');
    }

    /**
     * Retourne une page d'erreur pour code HTTP/1.1 400
     *
     * @return mixed
     */
    protected function err400()
    {
        return $this->render('page', 'errors/400', 'Bad Request');
    }

    /**
     * Retourne une page d'erreur pour code HTTP/1.1 403
     *
     * @return mixed
     */
    protected function err403()
    {
        return $this->render('page', 'errors/403', 'Accès interdit');
    }

    /**
     * Retourne une page d'erreur pour code HTTP/1.1 404
     *
     * @return mixed
     */
    protected function err404()
    {
        return $this->render('page', 'errors/404', 'Page introuvable');
    }

    /**
     * Retourne une page d'erreur pour code HTTP/1.1 500
     *
     * @return mixed
     */
    protected function err500()
    {
        return $this->render('page', 'errors/500', 'Erreur');
    }

    /**
     * 4Retourne une page d'erreur pour code HTTP/1.1 503
     *
     * @return mixed
     */
    protected function err503()
    {
        return $this->render('page', 'errors/503', 'Service non disponible');
    }

}
