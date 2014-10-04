<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/27/14
 * Time: 12:36 PM
 */

namespace Application\Models;

use Base\Models\BaseModel;

class DbTestModel extends BaseModel
{
    public function getData()
    {
        $connection = $this->connect();
        return $this->query('select * from swcron', true);
        $this->disconnect($connection);
    }
}