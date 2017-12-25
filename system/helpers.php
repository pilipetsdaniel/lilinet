<?php
Use eftec\bladeone;

/**
 * @param string $view
 * @param array $data
 * @return bool
 */
function view(string $view, array $data = []) {
    $blade = new bladeone\BladeOne(VIEWS_DIR,CACHE_DIR);
    echo $blade->run($view, $data);
    return true;
}

?>