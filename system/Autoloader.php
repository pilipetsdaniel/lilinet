<?php

class Autoloader
{
    public function register() {
        spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * @param string $namespace
     * @return string
     */
    private function namespaceToPath(string $namespace) {
        $path = DOC_ROOT;
        $path .= '/' . str_replace('\\', '/', $namespace) . '.php';
        return $path;
    }

    /**
     * @param $class
     * @return bool
     */
    private function autoload($class) {
        $path = $this->namespaceToPath($class);
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
        return false;
    }


}

?>