<?php

namespace App\core;

define('CONTROLLERS_NAMESPACE', 'App\\controllers\\');

class Route
{
public static function start()
{
    $controllerClassname = 'home';
    $actionName = 'index';
    $payload = [];

    $routes = explode('/', $_SERVER["REQUEST_URI"]);

    if(!empty($routes[1])) 
        {
            $controllerClassname = $routes[1];
        }

    if(!empty($routes[2]))
        {
            $actionName = $routes[2];
        }

    if(!empty($routes[3]))
        {
            $payload = array_slice($routes, 3);
        }
        
    $controllerName = CONTROLLERS_NAMESPACE . ucfirst($controllerClassname);
    $controllerFile = ucfirst(strtolower($controllerClassname)) . '.php';
    $controllerPath = CONTROLLER . $controllerFile;

    if(file_exists($controllerPath))
        {
            include_once $controllerPath;
            //echo 'i have file';
        } else Route::Error404();

    $controller = new $controllerName();

    if(method_exists($controller, $actionName))
        {
            $controller->$actionName($payload);
            //echo 'i have method';
        } else Route::Error404();

/*     echo '<pre>';
    var_dump ($_SERVER["REQUEST_URI"]);
    var_dump ($controllerFile);
    var_dump ($actionName);
    var_dump ($controllerName);
    var_dump($controllerPath);
    echo '</pre>'; */
}

public static function Error404()
{
    header('HTTP/1.1 404 Not Found');
    header("Status: 404 Not Found");
    header('Location:/error');

}

    

}

?>