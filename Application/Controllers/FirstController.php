<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/6/14
 * Time: 3:27 PM
 */
namespace Application\Controllers;

class FirstController extends \Base\Controllers\BaseController
{
    public function index()
    {
        echo 'calling FirstController class function';
    }
    public function testView()
    {
        $this->render('home');
    }
}