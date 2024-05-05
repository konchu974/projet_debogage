<?php

/**
 * Fonction pour nettoyer une valeur en fonction du type spécifié
 *
 * @param mixed 
 * @param string 
 * @return mixed 
 */
function sanitize($item, $type) {
    switch($type) {
        case 'string':
            $item = filter_var($item, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Nettoie la chaîne de caractères en supprimant les caractères spéciaux
            break;
        case 'email':
            $item = filter_var($item, FILTER_SANITIZE_EMAIL); // Nettoie l'adresse e-mail
            break;
        case 'int':
            $item = filter_var($item, FILTER_SANITIZE_NUMBER_INT); // Nettoie la valeur en ne conservant que les caractères numériques
            break;
        case 'url':
            $item = filter_var($item, FILTER_SANITIZE_URL); // Nettoie l'URL
            break;
    }

    return $item;
}

/**
 * Fonction pour valider les données selon les règles spécifiées
 *
 * @param array 
 * @param array 
 * @return array 
 */
function validate(array $items, array $rule_items) {
    $result = array();
    foreach($rule_items as $item_key => $item_value) {

        // Vérifie si la clé '$item_key' existe dans $items
        if (array_key_exists($item_key, $items)) {
            $form_items[$item_key] = trim($items[$item_key]); // Supprime les espaces vides autour de la valeur
            $form_label = $item_value['label']; // Récupère le libellé du champ

            foreach($item_value as $rule_key => $rule_value) {
                switch($rule_key) {
                    case 'required':
                        // Vérifie si le champ est requis et s'il est vide
                        if ($rule_value === TRUE && empty($form_items[$item_key])) {
                            $result['danger'][] = $form_label . ' is required!'; // Ajoute un message d'erreur
                        }
                        break;
                    case 'sanitize':
                        // Nettoie la valeur du champ selon le type spécifié
                        if (!sanitize($form_items[$item_key], $rule_value)) {
                            $result['danger'][] = $form_label . ' is not valid!'; // Ajoute un message d'erreur si la valeur n'est pas valide
                        }
                        break;
                    // Ajoute d'autres règles de validation ici (min, max, regexp, matches, etc.)
                }

                $result['item'] = $form_items; // Stocke les données validées
            }
        }
    }
    return $result;
}

/**
 * Fonction pour vérifier si la validation a réussi
 *
 * @param array $items Les données validées
 * @return boolean Vrai si la validation a réussi, sinon faux
 */
function is_passed(array $items) {
    return !array_key_exists('danger', $items); // Vérifie si la clé 'danger' est absente dans les données validées
}

/**
 * Fonction pour effectuer des actions supplémentaires après la validation
 *
 * @param array 
 * @param array|null 
 * @return array 
 */
function check_validation(array $validated_items, array $after_validation = null) {
    if (is_passed($validated_items)) {

        $after_validated_items = $validated_items['item']; // Récupère les données validées

        // Applique les actions supplémentaires après la validation (si spécifié)
        if ($after_validation !== null) {
            foreach($after_validation as $action_key => $action_value) {
                switch($action_key) {
                    case 'hash':
                        // Hache la valeur du champ spécifié avec l'algorithme de hachage spécifié
                        $argument = explode(':', $action_value); // Récupère l'argument de la forme 'nom_champ:algorithme_hachage'
                        $after_validated_items[$argument[0]] = password_hash($after_validated_items[$argument[0]], constant($argument[1]));
                        break;
                    case 'remove':
                        // Supprime le champ spécifié des données validées
                        unset($after_validated_items[$action_value]);
                        break;
                }
            }
        }
        return $after_validated_items; // Retourne les données validées avec les actions supplémentaires appliquées
    } else {
        // Si la validation a échoué, retourne les données validées avec les messages d'erreur
        $result['danger'] = $validated_items['danger'];
        return $result;
    }
}
