<?php

return new class 
{
    public function up(PDO $conn)
    {
        $conn->exec("
            CREATE TABLE IF NOT EXISTS user_roles (
                user_id BIGINT UNSIGNED NOT NULL,
                role_id TINYINT UNSIGNED NOT NULL,
                PRIMARY KEY (user_id, role_id),
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (role_id) REFERENCES roles(id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    }

    public function down(PDO $conn)
    {
        $conn->exec("DROP TABLE IF EXISTS user_roles;");
    }
};