<?php
/**
 * User.php
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
 * Class User
 *
 * @category PHP
 * @package  Src\Models
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
class User extends Model
{

    /**
     * Recupère toues les utilisateurs
     *
     * @return bool|\PDOStatement
     */
    public function getAllUsers()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM utilisateurs');
    }

    /**
     * Recupère un utilisateur
     *
     * @param int $id L'id de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function getUser($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM utilisateurs WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Crée un utilisateur
     *
     * @param string $pseudo Pseudo de l'utilisateur
     * @param string $prenom Prénom de l'utilisateur
     * @param string $nom    Nom de l'utilisateur
     * @param string $mail   Mail de l'utilisateur
     * @param string $mdp    Mot de passe crypté de
     *                       l'utilisateur
     * @param int    $role   Role de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function createUser($pseudo, $prenom, $nom, $mail, $mdp, $role)
    {
        $stmt = $this->getDb()->getPDO()->prepare('INSERT INTO utilisateurs (pseudo, prenom, nom, mail, mdp, role, insc) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        $stmt->execute(array($pseudo, $prenom, $nom, $mail, $mdp, $role));
        return $stmt;
    }

    /**
     * Applique la valeur de ban sur un utilisateur
     *
     * @param int  $id    L'id de l'utilisateur
     * @param bool $value La valeur de ban
     *
     * @return bool|\PDOStatement
     */
    public function toggleBan($id, $value)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE utilisateurs SET actif = ? WHERE id = ?');
        $stmt->execute(array($value, $id));
        return $stmt;
    }

    /**
     * Met à jour un utilisateur
     *
     * @param int    $id     L'id de l'utilisateur
     * @param string $pseudo Pseudo de l'utilisateur
     * @param string $prenom Prénom de l'utilisateur
     * @param string $nom    Nom de l'utilisateur
     * @param string $mail   Mail de l'utilisateur
     * @param int    $role   Role de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function updateUser($id, $pseudo, $prenom, $nom, $mail, $role)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE utilisateurs SET pseudo = ?, prenom = ?, nom = ?, mail = ?, role = ? WHERE id = ?');
        $stmt->execute(array($pseudo, $prenom, $nom, $mail, $role, $id));
        return $stmt;
    }

    /**
     * Supprime un utilisateur
     *
     * @param int $id L'id de l'utilisateur à supprimer
     *
     * @return bool|\PDOStatement
     */
    public function deleteUser($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('DELETE FROM utilisateurs WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt;
    }

    /**
     * Récupère les identifiants de l'utilisateur
     *
     * @param string $login    Le pseudo de l'utilisateur
     * @param string $password Le mot de passe crypré de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function getUserLogin($login, $password)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM utilisateurs WHERE pseudo = ? AND mdp = ?');
        $stmt->execute(array($login, $password));
        return $stmt;
    }

    /**
     * Crée un token de réinitialisation de mdp
     *
     * @param string $token Le token
     * @param string $mail  Le mail correspondant
     *
     * @return bool|\PDOStatement
     */
    public function createToken($token, $mail)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE utilisateurs SET token = ? WHERE mail = ?');
        $stmt->execute(array($token, $mail));
        return $stmt;
    }

    /**
     * Récupère le token
     *
     * @param string $token Le token à récupérer
     *
     * @return bool|\PDOStatement
     */
    public function checkExistingToken($token)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM utilisateurs WHERE token = :token');
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère le mail
     *
     * @param string $mail Le mail à récupérer
     *
     * @return bool|\PDOStatement
     */
    public function checkExistingMail($mail)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Définit un nouveau mot de passe pour selon le token
     *
     * @param string $token Le token récupéré depuis l'URL
     * @param string $mdp   Le nouveau mot de passe
     *                      crypté
     *
     * @return bool|\PDOStatement
     */
    public function setUserMdp($token, $mdp)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE utilisateurs SET mdp = ? WHERE token = ?');
        $stmt->execute(array($mdp, $token));
        return $stmt;
    }

    /**
     * Remet à null le token correspondant
     *
     * @param string $token Le token à réinitialiser
     *
     * @return bool|\PDOStatement
     */
    public function resetToken($token)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE utilisateurs SET token = NULL WHERE token = ?');
        $stmt->execute(array($token));
        return $stmt;
    }

    /**
     * Met à jour les informations d'un utilisateur
     *
     * @param int    $id     L'id de l'utilisateur
     * @param string $prenom Le prénom de l'utilisateur
     * @param string $nom    Le nom de l'utilisateur
     * @param string $mail   Le mail de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function updateUserInfo($id, $prenom, $nom, $mail)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'UPDATE utilisateurs SET prenom = :prenom, 
                                                                                         nom = :nom,
                                                                                        mail = :mail
                                                                                  WHERE id = :id'
        );
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Met à jour l'avatar de l'utilisateur
     *
     * @param string $id   L'id de l'utilisateur
     * @param string $link Le nom du fichier
     *
     * @return bool|\PDOStatement
     */
    public function updateAvatar($id, $link)
    {
        $stmt = $this->getDb()->getPDO()->prepare('UPDATE utilisateurs SET avatar = :link WHERE id = :id');
        $stmt->bindParam(':link', $link, PDO::PARAM_STR);        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }

    /**
     * Retourne le mot de passe d'un utilisateur
     *
     * @param int $id L'id de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function getUserMdp($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT mdp FROM utilisateurs WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Met à jour le mot de passe d'un utilisateur
     *
     * @param int    $id  L'id de l'utilisateur
     * @param string $mdp Le mot de passe crypté de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function updateMdp($id, $mdp)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'UPDATE utilisateurs SET mdp = :mdp
                                                              WHERE id = :id'
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Met à jour les règles de confidentialité de l'utilisateur
     *
     * @param int  $id    L'id de l'utilisateur
     * @param bool $confn Affichage le prénom & nom en public
     * @param bool $confm Affichage le mail en public
     *
     * @return bool|\PDOStatement
     */
    public function updateConfidentiality($id, $confn, $confm)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'UPDATE utilisateurs SET showNom = :confn, showMail = :confm WHERE id = :id'
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':confn', $confn, PDO::PARAM_BOOL);
        $stmt->bindParam(':confm', $confm, PDO::PARAM_BOOL);
        $stmt->execute();
        return $stmt;
    }
}
