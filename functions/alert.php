<?php

// Définit une fonction nommée getAlert qui prend un tableau associatif de messages en argument
function getAlert(array $messages) {
    // Vérifie si le tableau de messages n'est pas vide
    if (!empty($messages)) {
        // Récupère les clés du tableau de messages
        $message_type = array_keys($messages);
        
        // Pour chaque type de message
        foreach($message_type as $class) {
            // Affiche une div avec la classe d'alerte correspondante
            echo '<div class="alert alert-'.$class.'">';
            
            foreach($messages[$class] as $message) {
                echo "<li> {$message} </li>";
            }
            
            echo '</div>';
        }
    } else {
        return;
    }
}
