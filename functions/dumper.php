<?php

/**
 * Fonction dumper
 *
 * @param mixed $var La variable à afficher
 * @param string $dumper Le type de dumper à utiliser ('dump' par défaut ou 'print')
 * @return void
 */
function dumper($var, $dumper = 'dump') {
    // Vérifie si le paramètre $dumper est 'print' pour utiliser print_r ou var_dump
    if ($dumper === 'print') {
        // Affiche la variable formatée avec print_r dans une balise <pre>
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    } else {
        // Par défaut, utilise var_dump pour afficher la variable formatée
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
