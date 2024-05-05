<?php
// Vérifie si la constante ROOT_PATH n'est pas définie
if (!defined('ROOT_PATH')) {
    // Définit la constante ROOT_PATH comme le chemin absolu du répertoire actuel
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

// Charge la fonction principale de l'application
require_once ROOT_PATH . 'app.php';


template('index');
