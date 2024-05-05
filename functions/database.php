<?php

/**
 * Fonction pour exécuter une requête SQL
 *
 * @param string $query La requête SQL à exécuter
 * @return mixed 
 */
function run_query(string $query) {
    $connection  = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    
    if (mysqli_connect_errno()) {
        // Lance une exception avec un message d'erreur
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    if (!$result = mysqli_query($connection, $query)) {
        throw new Exception(mysqli_error($connection));
    } else {
        // Si la requête est exécutée avec succès, retourne le résultat
        return $result;
    }
}

/**
 * Fonction pour insérer des données dans une table
 *
 * @param string 
 * @param array 
 * @return boolean 
 */
function insert(string $table, array $datas) {
    $dataColumn = null;
    $dataValues = null;

    foreach($datas as $column => $values) {
        $dataColumn .= $column . ",";
        $dataValues .= "'" . $values . "',";
    }

    // Supprime la virgule en trop à la fin des chaînes
    $dataColumn = rtrim($dataColumn,',');
    $dataValues = rtrim($dataValues,',');

    $query = "INSERT INTO {$table} ({$dataColumn}) VALUES({$dataValues})";

  
    return run_query($query);
}

/**
 * Fonction pour sélectionner des données depuis une table
 *
 * @param string 
 * @param string 
 * @param array 
 * @return array|null 
 */
function select(string $table, string $column = null, $conditions = array()) {
    // Si aucune colonne n'est spécifiée, sélectionne toutes les colonnes
    if(empty($column)) {
        $column = "*";
    }

   
    $query = "SELECT {$column} FROM {$table}";
    if(!empty($conditions)) {
        $query .= " WHERE {$conditions[0]} {$conditions[1]} '{$conditions[2]}'";
    }

    if (!$result = run_query($query)) {
        throw new Exception('Error when looking to the data');
    } else {
        // Initialise un tableau pour stocker les résultats de la requête
        $rows = array();

        // Parcourt les résultats de la requête et les stocke dans le tableau
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}


?>
