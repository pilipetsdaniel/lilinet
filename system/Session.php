<?php

class Session
{

    private static $_instance = null;
    private $SESSION;

    /**
     * Session constructor.
     */
    private function __construct() {
        $this->SESSION = &$_SESSION;
    }

    /**
     * @return null|Session
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value) {
        $this->SESSION[$name] = $value;
    }

    /**
     * @param $name
     * @return null|$_SESSION[$name]
     */
    public function __get($name) {
        if (isset($this->SESSION[$name])) {
            return $this->SESSION[$name];
        }
        return null;
    }

    /**
     * Clear $_SESSION
     */
    public function Clear() {
        $this->SESSION = [];
    }

}