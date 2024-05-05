<?php

/**
 * Vérifie l'existence d'un fichier PHP
 *
 * @param string 
 * @param string 
 * @return mixed 
 */
function has_file(string $file_name, string $directory = null) {
    // Si un répertoire est spécifié, le formate correctement
    if (!empty($directory)) {
        $directory = ltrim(rtrim($directory, '/'), '/') . '/'; // Supprime les slashs inutiles et ajoute un slash à la fin
    }

    // Construit le chemin complet du fichier
    $file = ROOT_PATH . $directory . $file_name . '.php';

    return file_exists($file) ? $file : false;
}

/**
 * Obtient un fichier ou inclut un fichier et envoie les données au fichier si les données ont été insérées
 *
 * @param string
 * @param string 
 * @param array 
 * @return mixed 
 */
function get_file(string $file_name, string $directory = null, array $data = array()) {
    // Vérifie si le fichier existe
    $file = has_file($file_name, $directory);

    if (!empty($file)) {
        // Inclut une seule fois le fichier et retourne le résultat d'inclusion
        return include_once $file;
    } else {
       
        printf("Fichier [<b> %s </b>] introuvable", $file_name);
    }
}
