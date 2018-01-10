<?php

class Request
{

    private static $_instance = null;
    private $GET;
    private $POST;

    /**
     * Request constructor.
     */
    private function __construct() {
        $this->GET = &$_GET;
        $this->POST = &$_POST;
    }

    /**
     * @return null|Request
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function GET($name) {
        return $this->GET[$name];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function POST($name) {
        return $this->POST[$name];
    }

}