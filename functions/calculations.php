<?php

// Fonction pour calculer le pourcentage, la valeur ou la quantité
function getPercent($percent = null, $of = null , $result = null) {
    if ($result === null) {
        // Calcul du résultat si la valeur à obtenir est non définie
        $result = $percent * $of / 100;
        return ['result' => $result];
    }
    if ($percent === null) {
        // Calcul du pourcentage si le pourcentage est non défini
        $percent = $of / $result * 100;
        return ['percent' => $percent];
    }
    if ($of === null) {
        // Calcul de la valeur à obtenir si la valeur à obtenir est non définie
        $of = $result * 100 / $percent;
        return ['of' => $of];
    }
}

function ruleOfThird($a = 1, $b = 1, $c = 1): array
    {
        return [
            'd' => ($b * $c)  / $a,
        ];
    }

// Fonction de chiffrement et déchiffrement par substitution (chiffrement de César)
function cesar($clear, $key, $reverse = false) {
    // Définition de l'alphabet
    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    $alphabet = str_split($alphabet);
    $clear = str_split($clear);
    $result = '';

    foreach ($clear as $letter) {
        // Recherche de l'index de la lettre dans l'alphabet
        $index = array_search($letter, $alphabet);
        // Calcul de l'index après décalage pour le chiffrement ou le déchiffrement
        $index = $reverse ? ($index - $key + 26) % 26 : ($index + $key) % 26;
        // Construction du texte chiffré ou déchiffré
        $result .= $alphabet[$index];
    }

    if ($reverse) {
        // Retourne le texte déchiffré
        return ['clear' => $result];
    } else {
        // Retourne le texte chiffré
        return ['result' => $result];
    }
}

// Fonction pour convertir une somme d'argent d'une devise à une autre
function convertEuroDollars($amount, $fromCurrency, $toCurrency) {
    // URL de l'API de conversion de devises
    $url = 'https://open.er-api.com/v6/latest/' . $fromCurrency;
    // Récupération des données JSON de l'API
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    // Obtention du taux de change pour la devise cible
    $rate = $data['rates'][$toCurrency];
    // Conversion du montant dans la devise cible
    $convertedAmount = $amount * $rate;
    // Retourne le montant converti dans la devise cible
    return [$toCurrency => $convertedAmount];
}

// Fonction pour convertir des millilitres en litres ou vice versa
function convertmLtoL($litre = null, $mil = null) {
    if ($litre === null) {
        // Conversion des millilitres en litres si les litres sont non définis
        $litre = $mil / 1000;
        return ['litre' => $litre];
    }
    if ($mil === null) {
        // Conversion des litres en millilitres si les millilitres sont non définis
        $mil = $litre * 1000;
        return ['mil' => $mil];
    }
}

// Fonction pour convertir un nombre décimal en binaire
function convertToBinary($decimal) {
    // Conversion du nombre décimal en binaire
    $binary = decbin($decimal);
    return ['binary' => $binary];
}

// Fonction pour convertir un nombre décimal en hexadécimal
function convertToHexadecimal($decimal) {
    // Conversion du nombre décimal en hexadécimal
    $hexadecimal = dechex($decimal);
    return ['hex' => $hexadecimal];
}
