<?php

class RouteComponent extends Object {

    var $route_file = '../Config/routes_dynamics.php';

    function initialize() {
        if (!is_file($this->route_file)) {
            die('The path to your route file is wrong. Edit /app/controllers/components/route.php and fix the problem.');
        }
    }

    /**
     * Startup
     *
     * @param object $controller instance of controller
     * @return void
     */
    public function startup(Controller $controller) {    }

    /**
     * beforeRender
     *
     * @param object $controller instance of controller
     * @return void
     */
    public function beforeRender(Controller $controller) {    }
    
    /**
     * beforeRedirect
     *
     * @param object $controller instance of controller
     * @return void
     */
    public function beforeRedirect(Controller $controller) {    }
    
    /**
     * shutdown
     *
     * @param object $controller instance of controller
     * @return void
     */
    public function shutdown(Controller $controller) {    }

    function add($route) {
        $route = $route . "\n";
        if (is_writable($this->route_file)) {
            $routes = file($this->route_file);
            $new_routes = '';
            foreach ($routes as $i) {
                if (trim($i) != '?>') {
                    $new_routes .= $i;
                }
                else
                    break;
            }
            $handle = fopen($this->route_file, 'w');
            if (fwrite($handle, $new_routes . $route . '?>')) {
                return true;
            }
            else
                return false;
            fclose($handle);
        }
        else
            return false;
    }

    function remove($route) {
        $route = $route . "\n";
        if (is_writable($this->route_file)) {
            $routes = file($this->route_file);
            $new_routes = '';
            foreach ($routes as $i) {
                if (trim($i) != '?>') {
                    if ($i != $route) {
                        $new_routes .= $i;
                    }
                }
                else
                    break;
            }
            $handle = fopen($this->route_file, 'w');
            if (fwrite($handle, $new_routes . '?>')) {
                return true;
            }
            else
                return false;
            fclose($handle);
        }
        else
            return false;
    }

}

?>