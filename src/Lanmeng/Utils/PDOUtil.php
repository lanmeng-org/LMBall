<?php

namespace Lanmeng\Utils;

class PDOUtil
{
    public static function getPDOInstance()
    {
        $host = env('DB_HOST');
        $dbname = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $pdo = new \PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        return $pdo;
    }
}
