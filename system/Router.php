<?php

class Router
{

    private static $_instance = null;
    private $middleware = null;
    private $get_routes = [];
    private $post_routes = [];

    private function __construct() {

    }

    public static function initialization($routes_path) {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        require_once $routes_path;
        return self::$_instance;
    }

    public function run () {

    }
    
    public static function Route ($route, $mix_name, $type = 'GET') {


        return self::$_instance;
    }

    public function middleware ($middleware_name) {

    }
    
    

}