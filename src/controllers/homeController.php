<?php
/**
 * HomeController.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
namespace Src\Controllers;

use Core\Controller;
use Core\Validator;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\Pagerfanta;
use Respect\Validation\Validator as v;
use Src\Models\Configuration;
use Src\Models\Ingredients;
use Src\Models\Recipes;
use Src\Models\Themes;

/**
 * Class HomeController
 *
 * @category PHP
 * @package  Src\Controllers
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Andrea Garcia <andrea.garcia@etu.univ-amu.fr>
 */
class HomeController extends Controller
{

    /**
     * Affiche la page d'accueil
     *
     * @return mixed
     */
    public function index()
    {
        $r = new Recipes();
        $i = new Ingredients();
        $c = new Configuration();
        $t = new Themes();

        $lastRecipe = $r->getLastGoodRecipe()->fetch();

        if (isset($_SESSION['id'])) {
            $allRecipes = $r->getAllRecipesDescMember()->fetchAll();
        } else {
            $allRecipes = $r->getAllRecipesDescPublic()->fetchAll();
        }

        $adapter = new ArrayAdapter($allRecipes);
        $pg = new Pagerfanta($adapter);
        $pg->setMaxPerPage($c->getParam('pagination')->fetch()[0]);

        if (isset($_GET['pg']) && filter_var($_GET['pg'], FILTER_VALIDATE_INT)) {
            try  {
                $pg->setCurrentPage($_GET['pg']);
            }
            catch(NotValidCurrentPageException $e) {
                $pg->setCurrentPage(1);
            }
        }
        $recipes = $pg->getCurrentPageResults();

        $pgnav = '';
        if ($pg->hasPreviousPage()) {
            $pgnav .= '<a class="ui button teal" href="/?pg=' . ($pg->getCurrentPage() - 1) . '#recettes">< ' . ($pg->getCurrentPage() - 1) . '</a>';
        }
        if ($pg->hasNextPage()) {
            $pgnav .= '<a class="ui button teal" href="/?pg=' . ($pg->getCurrentPage()+1) . '#recettes">' . ($pg->getCurrentPage() + 1) . ' ></a>';
        }


        $currentIngr = $i->getIngredient($c->getParam('featured_ingredient')->fetch()[0])->fetch();
        $feat3recipe = $r->get3RecipesByIngr($c->getParam('featured_ingredient')->fetch()[0])->fetchAll();

        $theme = $c->getParam('theme')->fetch()['value'];
        $template = $t->getTheme($theme)->fetch()['page'];

        return $this->render($template, 'accueil', 'Accueil', compact('users', 'lastRecipe', 'recipes', 'currentIngr', 'feat3recipe', 'pgnav'));
    }
}
