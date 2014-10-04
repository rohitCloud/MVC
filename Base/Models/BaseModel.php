<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/15/14
 * Time: 10:17 AM
 */
namespace Base\Models;

use Application\Config\Database;

class BaseModel
{
    private $connection;

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function connect()
    {
        $connection = mysqli_connect(Database::DB_HOST, Database::DB_USER, Database::DB_PASS, Database::DB_NAME);
        $this->connection = $connection;
        return $connection;
    }

    public function disconnect($connection)
    {
        mysqli_close($connection);
    }

    public function query($query, $output = false)
    {
        $data = [];
        $result = mysqli_query($this->connection, $query);
        if (!$result) {
            printf("Errormessage: %s\n", mysqli_error($this->connection));
            return false;
        }
        if ($output === true) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return true;
        }
    }
}