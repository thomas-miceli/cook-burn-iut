<?php
/**
 * Flash.php
 * PHP version 7.1.19
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */
namespace Core;

/**
 * Class Flash
 *
 * @category PHP
 * @package  Core
 * @author   Thomas Miceli <tomus.mic@gmail.com>
 */
class Flash
{

    /**
     * Ajoute dans la variable de session d'index 'flash' le message qu'il contient
     *
     * @return void
     */
    public static function showFlash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="ui ' . $_SESSION['flash']['type'] . ' message">
                    <div class="header">' . $_SESSION['flash']['header'] . '</div>
                    <p>' . $_SESSION['flash']['message'] . '</p>
                  </div>';
            unset($_SESSION['flash']);
        }
    }

    /**
     * Définit le contenu d'un message flash qui s'affichera sur la page d'après
     *
     * @param string $header  Le titre du message flash
     * @param string $message Le contenu du message flash
     * @param string $type    Le type de message
     *
     * @return void
     */
    public static function setFlash($header, $message, $type)
    {
        $_SESSION['flash'] = array(
            'header' => $header,
            'type' => $type,
            'message' => $message
        );
    }
}
