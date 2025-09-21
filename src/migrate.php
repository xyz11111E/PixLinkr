<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Config\Connection;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = Connection::getInstance();

$conn->exec("
    CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
");

$appliedMigrations = $conn->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_ASSOC);

$migrationFiles = glob(__DIR__ . "/migrations/*.php");

foreach ($migrationFiles as $file)
{
    $migrationName = basename($file);

    if (!in_array($migrationName, $appliedMigrations))
    {
        $migration = include $file;

        $migration->up($conn);
        
        $stmt = $conn->prepare("INSERT INTO migrations (migration) VALUES (:a);");
        $stmt->execute([":a" => $migrationName]);

        echo "Applied migration: $migrationName\n";
    }
}

echo "All migrations applied.\n";