<?php
/**
 * Model.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 */
namespace Core;

/**
 * Class Model
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 */
class Model
{

    /**
     * L'instance de la base de données
     *
     * @var Database
     */
    private $_dbinstance;

    /**
     * Retourne une instance de Database si elle n'est pas instanciée
     *
     * @return Database
     */
    public function getDb()
    {
        if (is_null($this->_dbinstance)) {
            $this->_dbinstance = $db = new Database('tomus_cookburn', 'tomus', 'oui', 'mysql-tomus.alwaysdata.net');
        }
        return $this->_dbinstance;
    }

}
