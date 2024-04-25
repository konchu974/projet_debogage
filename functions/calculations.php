<?php

    function getPercent($percent = null, $of = null , $result =null){

        if($result === null){
            $result = $percent * $of / 100;

            return [
                'result' => $result,
            ];
        }
        if($percent === null){
            $percent = $of / $result * 100;

            return [
                'percent' => $percent,
            ];
        }
        if($of === null){
            $of = $result * 100 / $percent;

            return [
                'of' => $of,
            ];
        }
    }

    function ruleOfThird($a = 1, $b = 1, $c = 1): array
    {
        return [
            'd' => ($b * $c)  / $a,
        ];
    }

    // Pour le déchiffrement :

    //     $index - $key : soustraction de la clé de l'index.
    //     + 26 : ajout de 26 pour assurer que le résultat est positif et dans la plage valide des indices de l'alphabet.
    //     % 26 : modulo 26 assure un décalage circulaire, ramenant l'index dans la plage de 0 à 25 (les indices valides de l'alphabet).
    //     Pour le chiffrement :
        
    //     $index + $key : ajout de la clé à l'index.
    //     % 26 : modulo 26 assure un décalage circulaire si l'index dépasse 25, le ramenant dans la plage de 0 à 25.

    function cesar($clear, $key, $reverse = false){
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet = str_split($alphabet);
        $clear = str_split($clear);
        $result = '';

        foreach ($clear as $letter){
            $index = array_search($letter, $alphabet);
            $index = $reverse ? ($index - $key + 26) % 26 : ($index + $key) % 26; //modification effectuer pour traduire la lettre A
            if($index > 25){
                $index = $index - 26;
            }
            $result .= $alphabet[$index];
        }

        if($reverse){
            return [
                'clear' => $result,
            ];
        } else {
            return [
                'result' => $result,
            ];
        }
    }

    function convertEuroDollars($amount, $fromCurrency, $toCurrency){
        // URL de l'API de conversion de devises
        $url = 'https://open.er-api.com/v6/latest/' . $fromCurrency;
    
        // Récupération des données JSON de l'API
        $data = file_get_contents($url);
        $data = json_decode($data, true);
    
        // Obtention du taux de change pour la devise cible
        $rate = $data['rates'][$toCurrency];
    
        // Conversion du montant dans la devise cible
        $convertedAmount = $amount * $rate;
    
        // Retourne le montant converti dans un tableau associatif
        return [
            $toCurrency => $convertedAmount,
        ];
    }
    function convertmLtoL($litre = null, $mil = null){
        if ($litre === null) {
            $litre = $mil / 1000;
            return [
                'litre' => $litre,
            ];
        }
        if ($mil === null) {
            $mil = $litre * 1000;
            return [
                'mil' => $mil,
            ];
        }
    }
    