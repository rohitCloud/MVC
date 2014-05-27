<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/27/14
 * Time: 3:48 PM
 */

namespace Application\Controllers;

class Home extends \Base\Controllers\BaseController
{
    public function index()
    {
        $data = [];
        $data['all'] = $this->model('HomeModel')->getCrons();
        if(!empty($data['all']))
        {
            $this->render('Home/home',$data);
        }
    }
}