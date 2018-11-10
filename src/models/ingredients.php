<?php
/**
 * Ingredients.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Src\Models
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
namespace Src\Models;

use Core\Model;
use PDO;

/**
 * Class Ingredients
 *
 * @category PHP
 * @package  Src\Models
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
class Ingredients extends Model
{
    /**
     * Récupère tous les ingrédients
     *
     * @return bool|\PDOStatement
     */
    public function getIngredients()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM ingredients');
    }

    /**
     * Récupère un ingrédient
     *
     * @param int $id L'id de l'ingrédient à récupérer
     *
     * @return bool|\PDOStatement
     */
    public function getIngredient($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM ingredients WHERE id_ingredient = ?');
        $stmt->execute(array($id));
        return $stmt;
    }

    /**
     * Crée un ingrédient
     *
     * @param string $nom Nom du nouvel ingrédient
     *
     * @return bool|\PDOStatement
     */
    public function createIngredient($nom)
    {
        $stmt = $this->getDb()->getPDO()->prepare('INSERT INTO ingredients (nom) VALUES (?)');
        $stmt->execute(array($nom));
        return $stmt;
    }

    /**
     * Met à jour un ingrédient
     *
     * @param int    $id  L'id de l'ingrédient à mettre
     *                    à jour
     * @param string $nom Le nouveau nom de l'ingrédient
     *
     * @return bool|\PDOStatement
     */
    public function updateIngredient($id, $nom)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE ingredients SET nom = ? WHERE id_ingredient = ?');
        $stmt->execute(array($nom, $id));
        return $stmt;
    }

    /**
     * Supprime un ingrédient
     *
     * @param int $id L'id de l'ingrédient à supprimer
     *
     * @return bool|\PDOStatement
     */
    public function deleteIngredient($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('DELETE FROM ingredients WHERE id_ingredient = ?');
        $stmt->execute(array($id));
        return $stmt;
    }
}
