<?php

return new class 
{
    public function up(PDO $conn)
    {
        $conn->exec("
            CREATE TABLE IF NOT EXISTS roles (
                id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) UNIQUE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(PDO $conn)
    {
        $conn->exec("DROP TABLE IF EXISTS roles;");
    }
};