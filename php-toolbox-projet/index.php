<?php

$_SERVER['HTTP_HOST'] .= "/projet_debogage/php-toolbox-projet";
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

// Load the core function
require_once ROOT_PATH . 'app.php';

template('index');
