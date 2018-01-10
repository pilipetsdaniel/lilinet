<?php

// register Autoloader
require_once DOC_ROOT . '/system/Autoloader.php';
$autoloader = new Autoloader();
$autoloader->register();

// require files
require_once DOC_ROOT .  '/vendor/autoload.php';
require_once DOC_ROOT .  '/config/db.php';
require_once DOC_ROOT .  '/system/helpers.php';

// Session
session_start();
require_once DOC_ROOT . '/system/Session.php';
Session::instance();

// Request
require_once DOC_ROOT . '/system/Request.php';
Request::instance();

// DB


// run Router
require_once DOC_ROOT . '/system/Router.php';
Router::instance();
require_once DOC_ROOT . '/config/routes.php';
Router::instance()->run();

?>