<?php
/**
 * Configuration.php
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
 * Class Configuration
 *
 * @category PHP
 * @package  Src\Models
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
class Configuration extends Model
{
    /**
     * Permet de récupérer la valeur d'un paramètre
     *
     * @param string $param Le paramètre pour lequel on veut récupérer sa valeur
     *
     * @return bool|\PDOStatement
     */
    public function getParam($param)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT value FROM configuration WHERE parametre = :param');
        $stmt->bindParam(':param', $param, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Permet de définir un paramètre avec une valeur
     *
     * @param string $key   Le paramètre pour lequel on veut redéfinir sa
     *                      valeur
     * @param string $value La valeur à redéfinir
     *
     * @return bool|\PDOStatement
     */
    public function setParam($key, $value)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE configuration SET value = ? WHERE parametre = ?');
        $stmt->execute(array($value, $key));
        return $stmt;
    }
}
