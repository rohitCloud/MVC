<?php

namespace Application\Controllers;

class BaseController extends \Base\Controllers\BaseController
{
    public function index()
    {
        echo json_encode($_POST);
    }

    public function TestArgs($firstArg, $secondArg)
    {
        echo $firstArg;
    }
}