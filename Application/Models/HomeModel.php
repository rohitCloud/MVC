<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/27/14
 * Time: 3:58 PM
 */
namespace Application\Models;

class HomeModel extends \Base\Models\BaseModel
{
    public function getCrons()
    {
        $conn = $this->connect();
        return $this->query('select * from swcron',true);
        $this->disconnect($conn);
    }
}