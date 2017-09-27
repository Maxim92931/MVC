<?php

namespace Scraps;

use PDO;
use PDOException;


class Db
{
    public static function getConnection()
    {
        $params = include($_SERVER['DOCUMENT_ROOT'] . '/config/dbConfig.php');

        $paramsStr = "mysql:host={$params['host']};dbname={$params['dbname']}; charset=utf8";
        $connection = new PDO($paramsStr, $params['user'], $params['pass']);

        return $connection;
    }
}

