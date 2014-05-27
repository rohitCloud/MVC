<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/6/14
 * Time: 3:27 PM
 */
namespace Application\Controllers;

class SecondController extends \Base\Controllers\BaseController
{
    public function index()
    {
        echo 'calling SecondController class function';
    }
    public function testView()
    {
        $this->render('Users.user');
    }
}