<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/15/14
 * Time: 10:34 AM
 */
namespace Application\Controllers;

class DbTest extends \Base\Controllers\BaseController
{
    public function index()
    {
        $data = [];
        //Creating model object of DbTestModel
        $modelObj = $this->model('DbTestModel');
        $data['all'] = $modelObj->getData();
        //You can use chaining method for using library
        $this->library('curl')->curl('http://google.com');
        if($data && !empty($data))
        {
            $this->render('Users.user',$data);
        }
    }
}