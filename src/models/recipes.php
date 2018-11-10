<?php
/**
 * Recipes.php
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
 * Class Recipes
 *
 * @category PHP
 * @package  Src\Models
 * @author   Thomas Miceli <thomas.miceli@etu.univ-amu.fr>
 * @author   Dylan March <dylan.march@etu.univ-amu.fr>
 * @author   Ugo Orlando <ugo.orlando@etu.univ-amu.fr>
 */
class Recipes extends Model
{

    /**
     * Récupère la meilleure recette publique visible ayant plus de 15 burns
     *
     * @return bool|\PDOStatement
     */
    public function getLastGoodRecipe()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM recettes WHERE burns >= 15 AND status = 2 ORDER BY created_at DESC LIMIT 1');
    }

    /**
     * Récupère toutes les recettes
     *
     * @return bool|\PDOStatement
     */
    public function getAllRecipes()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM recettes');
    }

    /**
     * Récupère toutes les recettes publiques visibles triées par ordre décroissant de publication
     *
     * @return bool|\PDOStatement
     */
    public function getAllRecipesDescPublic()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM recettes WHERE burns >= 10 AND status = 2 ORDER BY created_at DESC');
    }

    /**
     * Récupère toutes les recettes réservées aux membres visibles
     *
     * @return bool|\PDOStatement
     */
    public function getAllRecipesDescMember()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM recettes WHERE status = 2 ORDER BY created_at DESC');
    }

    /**
     * Récupère toutes les recettes visibles
     *
     * @return bool|\PDOStatement
     */
    public function getRecipes()
    {
        return $this->getDb()->getPDO()->query('SELECT * FROM recettes WHERE status = 2 ORDER BY created_at DESC');
    }

    /**
     * Récupère les 3 meilleures recettes triées selon les burns qui ont un ingrédient spécifique
     *
     * @param id $ingr L'id de l'ingrédient
     *
     * @return bool|\PDOStatement
     */
    public function get3RecipesByIngr($ingr)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes WHERE id_recette IN (SELECT id_recette FROM recettes_ingredients WHERE id_ingredient = :id) AND status = 2 ORDER BY burns DESC LIMIT 3');
        $stmt->bindParam('id', $ingr, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère le nombre de recettes
     *
     * @return bool|\PDOStatement
     */
    public function getNbRecipes()
    {
        return $this->getDb()->getPDO()->query('SELECT COUNT(*) FROM recettes');
    }

    /**
     * Récupère une recette visible cherchée
     *
     * @param string $type  Le type de recherche
     * @param string $query La requête de la recherche
     *
     * @return bool|\PDOStatement
     */
    public function getSearch($type, $query)
    {
        if ($type == 'titre') {
            $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes WHERE titre LIKE ? AND status = 2 ORDER BY created_at DESC ');
        } else if ($type == 'desc') {
            $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes WHERE desc_courte LIKE ? AND status = 2 ORDER BY created_at DESC ');
        } else if ($type == 'ingr') {
            $stmt = $this->getDb()->getPDO()->prepare(
                'SELECT * FROM recettes WHERE id_recette IN 
                                                                (SELECT id_recette FROM recettes_ingredients WHERE id_ingredient IN 
                                                                    (SELECT id_ingredient FROM ingredients WHERE nom LIKE ?)
                                                                )
                                                             AND status = 2 ORDER BY created_at DESC'
            );
        }

        $stmt->execute(array("%" . $query . "%"));
        return $stmt;
    }

    /**
     * Récupère une recette
     *
     * @param int $id L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function getRecipe($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes WHERE id_recette = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère toutes les recettes visibles d'un utilisateur
     *
     * @param int $idUser L'id de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function getRecipeByUser($idUser)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes WHERE id_auteur = :idUser AND status = 2 ORDER BY created_at DESC');
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère les recettes selon les critères de tri spécifiés
     *
     * @param string $sql La requête SQL
     *
     * @return bool|\PDOStatement
     */
    public function getAllRecipesByUserCustom($sql)
    {
        return $stmt = $this->getDb()->getPDO()->query($sql);
    }

    /**
     * Récupère le total de burns d'un utilisateur
     *
     * @param int $idUser L'id de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function getTotalBurns($idUser)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT SUM(burns) FROM recettes WHERE id_auteur = :idUser');
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Ajoute en favoris une recette
     *
     * @param int $id_user    L'id de l'utilisateur
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function addFavorite($id_user, $id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('INSERT INTO favoris (id_user, id_recette)VALUES (:id_user, :id_recette)');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Retire des favoris une recette
     *
     * @param int $id_user    L'id de l'utilisateur
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function removeFavorite($id_user, $id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('DELETE FROM favoris WHERE id_user = :id_user AND id_recette = :id_recette');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Ajoute un burn à une recette
     *
     * @param int $id_user    L'id de l'utilisateur
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function addBurn($id_user, $id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('INSERT INTO recettes_burns (id_user, id_recette)VALUES (:id_user, :id_recette)');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();

        $stmt2 = $this->getDb()->getPDO()->prepare('UPDATE recettes SET burns = burns + 1 WHERE id_recette = :id_recette');
        $stmt2->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt2->execute();

        return $stmt;
    }

    /**
     * Retire un burn à une recette
     *
     * @param int $id_user    L'id de l'utilisateur
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function removeBurn($id_user, $id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('DELETE FROM recettes_burns WHERE id_user = :id_user AND id_recette = :id_recette');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();

        $stmt2 = $this->getDb()->getPDO()->prepare('UPDATE recettes SET burns = burns - 1 WHERE id_recette = :id_recette');
        $stmt2->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt2->execute();

        return $stmt;
    }

    /**
     * Recupère les recettes favorites de l'utilisateur
     *
     * @param int $id L'id de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function getFavorites($id)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes WHERE id_recette IN (SELECT id_recette FROM favoris WHERE id_user = :id)');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Teste si une recette est mise en favoris par un utilisateur
     *
     * @param int $id_user    L'id de l'utilisateur
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function isFavorite($id_user, $id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM favoris WHERE id_user = :id_user AND id_recette = :id_recette');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Teste si une recette est aimée par un utilsateur
     *
     * @param int $id_user    L'id de l'utilisateur
     * @param int $id_recette L'id de la recette
     * 
     * @return bool|\PDOStatement
     */
    public function isLiked($id_user, $id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes_burns WHERE id_user = :id_user AND id_recette = :id_recette');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Crée une recette et retourne l'id de la recette crée
     *
     * @param int    $auteur L'id de l'utilisateur
     * @param string $titre  Le titre de la recette
     * @param int    $nb     Le nombre de couverts de la recette
     * @param string $img    Le nom de l'image
     * @param string $sdesc  La description courte
     * @param string $ldesc  La description longue
     * @param int    $status Le statut de la recette
     *                       (publique/privée/brouillon)
     *
     * @return int
     */
    public function createRecipe($auteur, $titre, $nb, $img, $sdesc, $ldesc, $status)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'INSERT INTO recettes (id_auteur, titre, nb_convives, desc_courte, desc_longue, img, status, created_at)
                                                              VALUES (:auteur, :titre, :nb, :sdesc, :ldesc, :img, :status, NOW())'
        );
        $stmt->bindParam(':auteur', $auteur, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':nb', $nb, PDO::PARAM_INT);
        $stmt->bindParam(':sdesc', $sdesc, PDO::PARAM_STR);
        $stmt->bindParam(':ldesc', $ldesc, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->execute();
        return $this->getDb()->getPDO()->lastInsertId();
    }

    /**
     * Définit une étape pour une recette
     *
     * @param int    $id_recette L'id de la recette
     * @param int    $nb_etape   Le numéro
     *                           de l'étape
     * @param string $etape      Le contenu de
     *                           l'étape
     *
     * @return bool|\PDOStatement
     */
    public function setEtape($id_recette, $nb_etape, $etape)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'INSERT INTO recettes_etapes (id_recette, nb_etape, etape) VALUES(:id_recette, :nb, :etape) ON DUPLICATE KEY 
                                                             UPDATE etape = :etape'
        );
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->bindParam(':nb', $nb_etape, PDO::PARAM_INT);
        $stmt->bindParam(':etape', $etape, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;

    }

    /**
     * Définit un ingrédient
     *
     * @param int $id_recette    L'id de la recette
     * @param int $id_ingredient L'id de l'ingrédient
     *
     * @return bool|\PDOStatement
     */
    public function setIngredient($id_recette, $id_ingredient)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'INSERT INTO recettes_ingredients (id_recette, id_ingredient) VALUES(:id_recette, :id_ingredient) ON DUPLICATE KEY 
                                                             UPDATE id_ingredient = :id_ingredient'
        );
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;

    }

    /**
     * Retire les étapes inutilisées qui sont à la fin
     *
     * @param int $id_recette L'id de la recette
     * @param int $nb_etape   Le numéro de
     *                        l'étape
     *
     * @return bool|\PDOStatement
     */
    public function removeLasts($id_recette, $nb_etape)
    {
        $stmt = $this->getDb()->getPDO()->prepare('DELETE FROM recettes_etapes WHERE id_recette = :id_recette AND nb_etape > :nb_etape');
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->bindParam(':nb_etape', $nb_etape, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère les étapes d'une recette
     *
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function getEtape($id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM recettes_etapes WHERE id_recette = :id_recette');
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère les ingrédients d'une recette
     *
     * @param int $id_recette L'id de la recette
     *
     * @return bool|\PDOStatement
     */
    public function getIngredients($id_recette)
    {
        $stmt = $this->getDb()->getPDO()->prepare('SELECT * FROM ingredients WHERE id_ingredient IN (SELECT id_ingredient FROM recettes_ingredients WHERE id_recette = :id_recette)');
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Met à jour une recette
     *
     * @param int    $id     L'id de la recette
     * @param string $titre  Le nom de la recette
     * @param int    $nb     Le nombre de couverts de la recette
     * @param string $sdesc  La description courte
     * @param string $ldesc  La description longue
     * @param int    $status Le status de la recette
     *                       (publique/privée/brouillon)
     *
     * @return bool|\PDOStatement
     */
    public function updateRecipe($id, $titre, $nb, $sdesc, $ldesc, $status)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'UPDATE recettes SET titre = :titre, 
                                                                                 nb_convives = :nb,
                                                                                 desc_courte = :sdesc,
                                                                                 desc_longue = :ldesc,
                                                                                 status = :status,
                                                                                 updated_at = NOW()
                                                                                 WHERE id_recette = :id'
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':nb', $nb, PDO::PARAM_INT);
        $stmt->bindParam(':sdesc', $sdesc, PDO::PARAM_STR);
        $stmt->bindParam(':ldesc', $ldesc, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Met à jour l'auteur d'une recette
     *
     * @param int $id        L'id de la recette
     * @param int $id_author L'id de l'utilisateur
     *
     * @return bool|\PDOStatement
     */
    public function updateAuthor($id, $id_author)
    {
        $stmt = $this->getDb()->getPDO()->prepare(
            'UPDATE recettes SET id_auteur = :author
                                                                                 WHERE id_recette = :id'
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':author', $id_author, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Supprime une recette
     *
     * @param int $id L'id de la recette à supprimer
     * 
     * @return bool|\PDOStatement
     */
    public function deleteRecipe($id)
    {
        // On peut très bien garder la recette dans la base de données en faisant croire qu'elle est supprimée

        $stmt = $this->getDb()->getPDO()->prepare('DELETE FROM recettes WHERE id_recette = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
