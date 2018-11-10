<?php
/**
 * Themes.php
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
 * Class Themes
 *
 * @category PHP
 * @package  Src\Models
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
class Themes extends Model
{
    /**
     * Récupère tous les thèmes disponibles
     *
     * @return bool|\PDOStatement
     */
    public function getThemes()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM themes');
    }

    /**
     * Récupère un thème
     *
     * @param int $id L'id du thème
     *
     * @return bool|\PDOStatement
     */
    public function getTheme($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM themes WHERE id_theme = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
