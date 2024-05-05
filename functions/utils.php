<?php

/**
 * Fonction pour enregistrer les soumissions dans la base de données
 *
 * @param object 
 * @param mixed 
 * @return void
 */
function logSubmitToDatabase($body, $result = null){
    // Définit les colonnes à insérer dans la table 'logs'
    $cols = [
        'form' => $body->form, 
        'data' => json_encode($body), 
        'result' => $result !== null ? json_encode($result) : null, 
    ];

    // Insère les données dans la table 'logs' en appelant la fonction insert définie ailleurs dans le code
    insert('logs', $cols);
}
