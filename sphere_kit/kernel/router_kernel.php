<?php
require_once ('../sphere_kit/kernel/error_handler.php');

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require_once "../Controllers/$classPath.php"; 
});


 function Route($routes){
        $config = parse_ini_file('../config.ini', true);
        if ($config === false) {
            die('Error reading config file');
        }
        $notfound_page = $config['server_page']['404_PAGE'];
    
        $requestUrl = $_SERVER['REQUEST_URI'];
        foreach ($routes as $route => $action) {
            $pattern = '#^' . preg_replace('/{(\w+)}/', '(\w+)', $route) . '$#';
            if (preg_match($pattern, $requestUrl, $matches)) {
                array_shift($matches);
                call_user_func_array($action, $matches);
                return;
            }
        }
        include('..'.$notfound_page);
    }
    
    function ViewRender($view, $data = []){
        extract($data);
        include('../Views/'.$view);
    }
    
    function Controller($controller){
        include('../Controllers/'.$controller);
    }
    
    function Controller_getFunc($controller, $func) {
      
    
        if (!class_exists($controller)) {
            echo "Error: Class $controller not found";
            return;
        }
        
        $controllerInstance = new $controller();
        if (!method_exists($controllerInstance, $func)) {
            echo "Error: Method $func not found in class $controller";
            return;
        }
        $controllerInstance->$func();
    }
    
    function Controller_getFunc_methodGet($controller, $func, $get){
    
        if (!class_exists($controller)) {
            echo "Error: Class $controller not found";
            return;
        }
        
        $controllerInstance = new $controller();
        if (!method_exists($controllerInstance, $func)) {
            echo "Error: Method $func not found in class $controller";
            return;
        }
        $controllerInstance->$func($get);
    }
    
    function Redirect($url){
        header('Location :'. $url);
    }
    function CORS_ALLOWED_ORIGIN($allowedIPs = []) {
        $hostIP = $_SERVER['REMOTE_ADDR'];
        $config = parse_ini_file('../config.ini', true);
        $unauthorized_page = $config['server_page']['403_PAGE'];
        if (!in_array($hostIP, $allowedIPs)) {
            include('..'.$unauthorized_page);
            exit();
        }
    }


?>