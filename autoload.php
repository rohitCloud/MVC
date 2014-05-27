<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/12/14
 * Time: 11:34 AM
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    if(is_file($fileName))
    {
        require $fileName;
    }
}
function getControllerMethod()
{
    $parts = [];
    $params = [];
    if(isset($_SERVER['PATH_INFO']))
    {
        $URI = $_SERVER['PATH_INFO'];
        $parts = explode('/',$URI);
    }
    if(isset($parts[1]) && !empty($parts[1]))
    {
        $contoller = $parts[1];
    }
    else
    {
        $contoller = 'BaseController';
    }
    if(isset($parts[2]) && !empty($parts[2]))
    {
        $method = $parts[2];
    }
    else
    {
        $method = 'index';
    }
    if(count($parts)>3)
    {
        for($i=3;$i<count($parts);$i++)
        {
            $params[] = $parts[$i];
        }
    }
    return ['controller' => $contoller, 'method' => $method, 'params' => $params];
}
spl_autoload_register('autoload');
$controllerMethod = getControllerMethod();
$callController = "Application\\Controllers\\".$controllerMethod['controller'];
$method = $controllerMethod['method'];
$params = $controllerMethod['params'];
if(!class_exists($callController))
{
    $callController = "Application\\Controllers\\BaseController";
    $method = 'notFound';
}

$obj = new $callController;
$obj->$method($params);

spl_autoload_unregister('autoload');