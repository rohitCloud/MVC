<?php
/**
 * Created by Rohit Arora
 */

namespace Application\Controllers;

use Base\Controllers;

class BaseController extends Controllers\BaseController
{
    public function index()
    {
        $this->render('Home.home');
    }
}