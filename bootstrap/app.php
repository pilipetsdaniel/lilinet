<?php

// on display errors
error_reporting(-1);
$conf['error_level'] = 2;
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// register autoloader
require_once DOC_ROOT . '/system/Autoloader.php';
$autoloader = new Autoloader();
$autoloader->register();

// require files
require_once DOC_ROOT .  '/vendor/autoload.php';
require_once DOC_ROOT .  '/config/db.php';
require_once DOC_ROOT .  '/system/helpers.php';

// create Router instance and run
Router::initialization(DOC_ROOT .  '/config/routes.php')->run();

?>