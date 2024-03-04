<?php

namespace Igorstefanovdeveloper\Nekki\DataProvider;

use mysqli;

class MysqlProvider implements DataProviderInterface
{
    private static ?MysqlProvider $instance = null;
    private mysqli $db;

    private function __construct($host, $username, $password, $database)
    {
        $this->db = new mysqli($host, $username, $password, $database);
    }

    public static function getInstance($host, $username, $password, $database): ?MysqlProvider
    {
        if (self::$instance === null) {
            self::$instance = new self($host, $username, $password, $database);
        }

        return self::$instance;
    }


    public function executeSql(string $sql): bool
    {
        $query = $sql;
        $statement = $this->db->prepare($query);

        if ($statement->execute()) {
            return true;
        }

        return false;
    }
}
