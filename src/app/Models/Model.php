<?php

namespace App\Models;

use PDO;
use Config\Connection;

class Model
{
    protected static ?PDO $conn = null;

    protected static function getConn(): PDO
    {
        if (self::$conn === null) {
            self::$conn = Connection::getInstance();
        }
        return self::$conn;
    }
}