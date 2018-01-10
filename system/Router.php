<?php

class Router
{
    private static $_instance = null;
    private $get_routes = [];
    private $post_routes = [];
    private $route;

    // singleton
    private function __construct() {
    }

    /**
     * @return null|Router
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $route
     * @param $mix_name
     * @param string $type
     * @return Router
     */
    public static function Route($route, $mix_name, $type = 'GET') {

        $explode_mix_name = self::explode_mix_name($mix_name);
        $controller_name = array_shift($explode_mix_name);
        $method_name = array_shift($explode_mix_name);

        if ($type == 'GET') {
            self::instance()->get_routes[ROOT . $route] = [
                'controller' => $controller_name,
                'method' => $method_name
            ];
        }
        else if ($type == 'POST') {
            self::instance()->post_routes[ROOT . $route] = [
                'controller' => $controller_name,
                'method' => $method_name
            ];
        }

        // TODO подумать над передачей маршрута
        self::instance()->route = &self::instance()->get_routes[ROOT . $route];
        return self::$_instance;
    }

    /**
     * @param $middleware_name
     */
    public function middleware ($middleware_name) {
        self::instance()->route['middleware'] = $middleware_name;
    }

    /**
     * @return mixed
     */
    private function getURI() {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @param $mix_name 'ControllerNameController@MethodName'
     * @return array
     */
    private static function explode_mix_name ($mix_name) {
        return $explode_mix_name = explode('@', $mix_name);
    }

    /**
     * @param $route
     * @return string
     */
    public static function generate_pattern($route) {
        $res = '';
        $check = 0;
        for($i = 0; $i < strlen($route); $i++) {
            if ($route[$i] == '{') {
                $check = 1;
                $res .= '(\w*)';
            }
            if ($check == 0) {
                $res .= $route[$i];
            }
            if ($route[$i] == '}') {
                $check = 0;
            }
        }
        return $res . "(\/?.*)";
    }

    /**
     * @param $route
     * @return string
     */
    private static function generate_subject($route) {
        $arr = [];
        $check = 0;
        $word = '';
        for($i = 0; $i < strlen($route); $i++) {
            if ($route[$i] == '}') {
                $check = 0;
                $arr[] = $word;
            }
            if ($check == 1) {
                $word .= $route[$i];
            }
            if ($route[$i] == '{') {
                $word = '';
                $check = 1;
            }
        }
        $out = '';
        $j = 1;
        foreach($arr as $value) {
            $out .= $value . '=$' . $j;
            $j++;
            if(count($arr) == $j) {
                $out .= '&';
            }
        }
        return $out;
    }

    /**
     * @param $data_str
     * @return array
     */
    private static function explode_data($data_str) {
        $arr = explode('&', $data_str);
        $data = [];
        if(!empty($data_str)) {
            foreach ($arr as $value) {
                $arr2 = explode('=', $value);
                $data[$arr2[0]] = $arr2[1];
            }
        }
        return $data;
    }

    public function run () {
        $URI = self::instance()->getURI();

        // query type definitions
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $routes_name = 'post_routes';
        }
        else {
            $routes_name = 'get_routes';
        }

        foreach (self::instance()->$routes_name as $route => $mix_name) {
            $pattern = self::generate_pattern($route);
            if (preg_match("~$pattern~", $URI)) {
                // Middleware
                if (!empty($mix_name['middleware'])) {
                    $middleware_name = $mix_name['middleware'];
                    $middleware_file = DOC_ROOT . '/App/Middlewares/' . $middleware_name . '.php';
                    if (file_exists($middleware_file)) {
                        $full_middleware_name = 'App\Middlewares\\' . $middleware_name;
                        $Middleware = new $full_middleware_name;
                        $result = call_user_func_array([$Middleware, 'Verification'], []);
                        if (!$result) {
                            call_user_func_array([$Middleware, 'Redirect'], []);
                            exit;
                        }
                    }
                }

                $subject = self::generate_subject($route);
                $data_str = preg_replace("~$pattern~", $subject, $URI);
                $data = self::explode_data($data_str);
                $controller_name = $mix_name['controller'];
                $method_name = $mix_name['method'];
                $controller_file = DOC_ROOT . '/App/Controllers/' . $controller_name . '.php';
                if (file_exists($controller_file)) {
                    $full_controller_name = 'App\Controllers\\' . $controller_name;
                    $Controller = new $full_controller_name;
                    $result = call_user_func_array([$Controller, $method_name], [$data]);
                    if ($result) {
                        break;
                    }
                }
            }
        }
    }

}