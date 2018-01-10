<?php

// run Router
require_once DOC_ROOT . '/system/Router.php';
Router::instance();
require_once DOC_ROOT . '/config/routes.php';
//Router::instance()->run();

// require files
require_once DOC_ROOT .  '/vendor/autoload.php';
require_once DOC_ROOT .  '/config/db.php';
require_once DOC_ROOT .  '/system/helpers.php';


?>