<?php
/**
 * Database.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 */
namespace Core;

use PDO;

/**
 * Class Database
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 */
class Database
{

    /**
     * Le nom de la base de données
     *
     * @var
     */
    private $_dbname;
    /**
     * L'utilisateur de la base de données
     *
     * @var string
     */
    private $_dbuser;
    /**
     * Le mot de passe de la base de données
     *
     * @var string
     */
    private $_dbpass;
    /**
     * L'adresse d'hébergement de la base de données
     *
     * @var string
     */
    private $_dbhost;
    /**
     * L'instance de PDO
     *
     * @var PDO
     */
    private $_pdo;

    /**
     * Database constructor.
     *
     * @param string $db_name Le nom de la base de données
     * @param string $db_user L'utilisateur de la base de données
     * @param string $db_pass Le mot de passe de la base de données
     * @param string $db_host L'adresse d'hébergement de la base de données
     */
    public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost')
    {
        $this->_dbname = $db_name;
        $this->_dbuser = $db_user;
        $this->_dbpass = $db_pass;
        $this->_dbhost = $db_host;
    }

    /**
     * Retourne une instance de PDO
     *
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->_pdo === null) {
            $pdo = new PDO('mysql:dbname=' . $this->_dbname . ';host=' . $this->_dbhost, $this->_dbuser, $this->_dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo = $pdo;
        }
        return $this->_pdo;
    }
}
