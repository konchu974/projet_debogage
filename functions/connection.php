<?php

// Inclut le fichier autoload.php généré par Composer.
require_once __DIR__ . '/../vendor/autoload.php';

// Importe la classe Dotenv de la bibliothèque Dotenv.
use Dotenv\Dotenv;

// Crée une instance de Dotenv avec le répertoire racine du projet.
$dotenv = Dotenv::createImmutable(__DIR__);

// Charge les variables d'environnement à partir du fichier .env dans le répertoire racine du projet.
$dotenv->load();

// $db = include ROOT_PATH . 'config.php';
// // Pourquoi pas utiliser un .ENV ?
// define('DB_HOST', $db['host']);
// define('DB_USER', $db['user']);
// define('DB_PASSWORD', $db['password']);
// define('DB_NAME', $db['name']);
// define('DB_PORT', $db['port']);
