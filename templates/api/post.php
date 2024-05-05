<?php

header('Content-Type: application/json');
// Définit le code de réponse HTTP à 200 (OK)
http_response_code(200);

// Vérifie si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
   
    http_response_code(405);
   
    exit;
}

/*
 * GET BODY
 * */
// Récupère les données du corps de la requête JSON
$json = file_get_contents('php://input');
// Décode les données JSON en objet PHP
$body = json_decode($json); // Converts it into a PHP object
$result = null;
// Vérifie si le corps de la requête est vide
if($body === null){
    // Si le corps de la requête est vide, retourne une réponse d'erreur JSON
    $data = [
        'response' => 'error',
        'message' => 'No data sent'
    ];
    echo json_encode($data);
    exit;
}

// Vérifie si le champ 'form' est défini dans le corps de la requête
if(!isset($body->form)){
    // Si le champ 'form' n'est pas défini, retourne une réponse d'erreur JSON
    $data = [
        'response' => 'error',
        'message' => 'No form name'
    ];
    echo json_encode($data);
   
    exit;
}

// Traite la requête en fonction de la valeur du champ 'form' dans le corps de la requête
switch ($body->form){
    // Cas où le formulaire est 'percent'
    case 'percent':
        // Récupère les valeurs des champs 'percent', 'result', et 'of' (si définis)
        $percent = isset($body->percent) ? $body->percent : null;
        $result = isset($body->result) ? $body->result : null;
        $of = isset($body->of) ? $body->of : null;

        // Appelle la fonction pour calculer le pourcentage et stocke le résultat
        $result = getPercent($percent, $of, $result);

        // Construit la réponse JSON avec le résultat du calcul
        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        // Renvoie la réponse JSON
        echo json_encode($data);
        break;
    // Cas où le formulaire est 'regle-de-trois'
    case 'regle-de-trois':
        // Récupère les valeurs des champs 'a', 'b', et 'c'
        $a = $body->a;
        $b = $body->b;
        $c = $body->c;

        // Appelle la fonction pour effectuer la règle de trois et stocke le résultat
        $result = ruleOfThird($a, $b, $c);

        // Construit la réponse JSON avec le résultat du calcul
        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        // Renvoie la réponse JSON
        echo json_encode($data);
        break;
    // Cas où le formulaire est 'cesar'
    case 'cesar':
        // Vérifie si le champ 'result' est défini pour déchiffrer le texte, sinon utilise le champ 'clear' pour le texte à chiffrer
        $reverse = property_exists($body, 'result') ? true : false;
        $text = $reverse ? $body->result : $body->clear;
        
        $key = $body->key;
        // Appelle la fonction pour le chiffrement/dechiffrement César et stocke le résultat
        $result = cesar($text, $key, $reverse);

        // Construit la réponse JSON avec le résultat du calcul
        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        // Renvoie la réponse JSON
        echo json_encode($data);
        break;

    // Cas où le formulaire est 'euros-dollars'
    case 'euros-dollars':
        // Récupère les valeurs des champs 'montant', 'devisesource', et 'devisecible'
        $montant = $body->montant;
        $devisesource = $body->devisesource;
        $devisecible = $body->devisecible;

        // Appelle la fonction pour la conversion des devises et stocke le résultat
        $result = convertEuroDollars($montant, $devisesource, $devisecible);

        // Construit la réponse JSON avec le résultat du calcul
        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];

        // Renvoie la réponse JSON
        echo json_encode($data);
        break;

    // Cas où le formulaire est 'mL-L'
    case 'mL-L':
        // Récupère les valeurs des champs 'mil' et 'litre'
        $mil = property_exists($body, 'mil') ? $body->mil : null;
        $litre = property_exists($body, 'litre') ? $body->litre : null;

        // Appelle la fonction pour la conversion de mL en L et stocke le résultat
        $result = convertmLtoL($litre, $mil);

        // Construit la réponse JSON avec le résultat du calcul
        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        // Renvoie la réponse JSON
        echo json_encode($data);
        break;

    // Cas où le formulaire est 'decimal-hexadecimal'
    case 'decimal-hexadecimal':
        // Récupère la valeur du champ 'decimal'
        $decimal = property_exists($body, 'decimal') ? $body->decimal : null;
        
        // Convertit le nombre décimal en nombres hexadécimal et binaire
        $hex = convertToHexadecimal($decimal);
        $bin = convertToBinary($decimal);

        // Stocke les résultats de la conversion
        $result = [$hex, $bin];

        // Construit la réponse JSON avec le résultat du calcul
        $data = [
            'response' => 'success',
            'message' => 'Calcul réussi',
            'data' => $result
        ];
        // Renvoie la réponse JSON
        echo json_encode($data);
        break;
}

// Enregistre la soumission du formulaire dans la base de données de logs
logSubmitToDatabase($body, $result);

exit;
