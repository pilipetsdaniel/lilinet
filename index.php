<?php

// require main config
require_once 'config/main.php';

// register Autoloader
require_once DOC_ROOT . '/system/Autoloader.php';
$autoloader = new Autoloader();
$autoloader->register();

// run the app
require_once 'bootstrap/app.php';

var_dump(Router::generate_pattern('/lilinet/{id}/'));

?>

