<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/13/14
 * Time: 10:49 AM
 */
namespace Base\Controllers;

class BaseController
{
    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function __call($name,$args)
    {
        echo $name." function does not exist";
    }

    public function NotFound()
    {
        $this->Exception("Class not found");
    }

    public function InvalidArguments()
    {
        $this->Exception("Invalid Arguments");
    }

    public function Exception($message = 'Exception')
    {
        throw new \Exception($message);
    }

    public function render($fileName,$data = [])
    {
        $file = str_replace('.','/',$fileName);
        $filePath = APP_DIR.'Views/'.$file.'.php';
        if(!is_file($filePath))
        {
            throw new \Exception($fileName.' View does not exist');
        }
        foreach($data as $key=>$value)
        {
            $$key = $value;
        }
        include $filePath;
    }
    public function model($model = '')
    {
        if(empty($model))
        {
            return false;
        }
        $modelClass = "\\Application\\Models\\$model";
        if(class_exists($modelClass))
        {
            return new $modelClass;
        }
        else
        {
            throw new \Exception('Model does not exist '. $model);
        }
    }
    public function library($library = '')
    {
        if(empty($library))
        {
            return false;
        }
        $libraryClass = "\\Application\\Libraries\\$library";
        if(class_exists($libraryClass))
        {
            return new $libraryClass;
        }
        else
        {
            throw new \Exception('Model does not exist '. $model);
        }
    }
}