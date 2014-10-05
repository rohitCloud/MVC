<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/12/14
 * Time: 11:34 AM
 */

use Application\Config\Constants;

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    if (is_file($fileName)) {
        require $fileName;
    }
}

function getControllerMethod()
{
    $parts = [];
    $params = [];
    if (isset($_SERVER['PATH_INFO'])) {
        $URI = $_SERVER['PATH_INFO'];
        $parts = explode('/', $URI);
    }
    if (isset($parts[1]) && !empty($parts[1])) {
        $controller = $parts[1];
    } else {
        $controller = Constants::BASE_CONTROLLER;
    }
    if (isset($parts[2]) && !empty($parts[2])) {
        $method = $parts[2];
    } else {
        $method = Constants::BASE_METHOD;
    }
    if (count($parts) > 3 && count($parts) <= 6) {
        for ($i = 3; $i < count($parts); $i++) {
            if (!empty(trim(filter_var($parts[$i], FILTER_SANITIZE_STRING))))
                $params[] = trim(filter_var($parts[$i], FILTER_SANITIZE_STRING));
        }
    } else if (count($parts) > 6) {
        $method = 'InvalidArguments';
    }
    return ['controller' => $controller, 'method' => $method, 'params' => $params];
}

spl_autoload_register('autoload');

$controllerMethod = getControllerMethod();

$CallController = "Application\\Controllers\\" . $controllerMethod['controller'];
$method = $controllerMethod['method'];
$params = $controllerMethod['params'];

if (!class_exists($CallController)) {
    $CallController = "Application\\Controllers\\" . Constants::BASE_CONTROLLER;
    $method = Constants::NOT_FOUND;
}

/* @var $Obj \Application\Controllers\BaseController */
$Obj = new $CallController;

try {
    $ReflectionMethod = new ReflectionMethod($Obj, $method);
    $ReflectionMethod->getNumberOfParameters() == count($params) ?
        $ReflectionMethod->invokeArgs($Obj, $params) : $Obj->invalidArguments();
} catch (Exception $e) {
    echo "<h1>Caught exception: {$e->getMessage()}</h1>";
}

spl_autoload_unregister('autoload');