<?php
/**
 * Created by PhpStorm.
 * User: rohitarora
 * Date: 5/15/14
 * Time: 10:17 AM
 */
namespace Base\Models;

use Application\Config\Database;

abstract class BaseModel
{
    const TABLE = '';

    public function __construct()
    {

    }

    public function connect()
    {
        return mysqli_connect(Database::DB_HOST, Database::DB_USER, Database::DB_PASS, Database::DB_NAME);
    }

    public function disconnect($connection)
    {
        mysqli_close($connection);
    }

    /**
     * @param string $query
     * @param bool $output
     *
     * @return array|bool
     * @throws \Exception
     */
    public function query($query, $output = false)
    {
        $connection = self::connect();
        $data = [];
        $result = mysqli_query($connection, $query);
        self::disconnect($connection);
        if (!$result) {
            throw new \Exception(mysqli_error($connection));
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

    /**
     * @return array|bool
     *
     * @throws \Exception
     */
    static public function getAll()
    {
        return self::query('select * from ' . self::getTableName(), true);
    }

    static function insert(array $params)
    {
        if(empty($params)){
            throw new \InvalidArgumentException;
        }

        foreach ($params as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        $query = 'insert into ' . self::getTableName() . '(' . implode(",", $keys) .
            ') values (\'' . implode("', '", $values) . '\')';

        return self::query($query);
    }

    public function genrateQuery()
    {
        $query = '';
        return $query;
    }

    public function getTableName()
    {
        /* @var $className BaseModel */
        $className = get_called_class();

        if (!$className::TABLE) {
            throw new \Exception('TABLE should be defined in ' . (string)$className);
        }
        return $className::TABLE;
    }
}