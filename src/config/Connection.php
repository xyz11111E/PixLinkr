<?php

namespace Config;

use PDO;

class Connection
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null)
        {
            $db_host = $_ENV["DB_HOST"];
            $db_port = $_ENV["DB_PORT"];
            $db_name = $_ENV["DB_NAME"];
            $user_name = $_ENV["USER_NAME"];
            $user_password = $_ENV["USER_PASSWORD"];
            $charset = "utf8mb4";

            $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=$charset;";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            self::$instance = new PDO($dsn, $user_name, $user_password, $options);
        }

        return self::$instance;
    }
}