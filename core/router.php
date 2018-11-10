<?php
/**
 * Router.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
namespace Core;

/**
 * Class Router
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
class Router extends Controller
{
    /**
     * Si un controlleur a été instancié
     *
     * @var boolean
     */
    public $instance = 0;

    /**
     * Crée une instance de controlleur si la page demandée correspond à la page requise
     *
     * @param string $page       La page (url) qui correspond au controlleur et à son action
     *                           demandée
     * @param string $controller Le controlleur cible
     * @param string $action     L'action du controlleur
     *
     * @return void
     */
    public function route($page, $controller, $action)
    {
        if ($page == $_GET['p']) {
            $this->_createInstance($controller, $action);
        }
    }

    /**
     * Crée une instance de controlleur qui renvoie vers la page d'accueil
     *
     * @param string $controller Le controlleur cible (ici 'home')
     * @param string $action     L'action cible (ici 'index')
     *
     * @return void
     */
    public function defaultRoute($controller = 'home', $action = 'index')
    {
        $this->_createInstance($controller, $action);
    }

    /**
     * Crée une instance de controlleur d'administrateur si la page(panel) demandée correspond à la page requise
     *
     * @param string $panel      Le panel d'administration (url) qui correspond au panel et à son action
     *                           demandée
     * @param string $action     L'action
     *                           demandée
     * @param string $controller Le controlleur d'administration (ici 'admin')
     *
     * @return void
     */
    public function adminRoute($panel, $action, $controller = 'admin')
    {
        if ($panel == $_GET['panel']) {
            $this->_createInstance($controller, $action);
        }
    }

    /**
     * Crée une instance de controlleur qui renvoie vers la page d'administration
     *
     * @param string $controller Le controlleur cible (ici 'admin')
     * @param string $action     L'action du controlleur (ici 'index')
     *
     * @return void
     */
    public function defaultAdminRoute($controller = 'admin', $action = 'index')
    {
        $this->_createInstance($controller, $action);
    }

    /**
     * Crée une instance de controlleur qui renvoie une erreur HTTP/1.1
     *
     * @param string $code Le code d'erreur à fournir qui renvoie une erreur
     *
     * @return Controller
     */
    public function error($code)
    {
        $this->instance = 1;
        return $this->$code();
    }

    /**
     * Crée une instance de controlleur suivnat les paramètres passés
     *
     * @param string $controller Le controlleur spécifique
     * @param string $action     L'action du controlleur
     * 
     * @return Controller
     */
    private function _createInstance($controller, $action)
    {
        $this->instance = 1;
        $controller = '\Src\Controllers\\' . ucfirst($controller) . 'Controller';
        $controllerObject = new $controller();
        return $controllerObject->$action();
    }

}
