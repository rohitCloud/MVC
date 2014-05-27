<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/27/14
 * Time: 3:35 PM
 */
namespace Application\Libraries;

class curl
{
    public function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        return curl_exec($ch);
    }
}
