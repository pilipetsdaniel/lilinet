<?php

// display errors
error_reporting(-1);
$conf['error_level'] = 2;
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


define('DOC_ROOT', '/var/www/html/lilinet');
define('ROOT', '/lilinet/');
define('VIEWS_DIR', DOC_ROOT . '/App/Views');
define('CACHE_DIR', DOC_ROOT . '/cache');
define("BLADEONE_MODE", 1);

?>