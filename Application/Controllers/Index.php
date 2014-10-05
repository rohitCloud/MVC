<?php
/**
 * Created by Rohit Arora
 */

namespace Application\Controllers;

use Application\Models\User;

class Index extends BaseController
{
    public function index()
    {
        User::create('vikas', 'sharma');
    }
}