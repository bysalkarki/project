<?php

namespace app\core;

use Exception;
use PDO;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        try {
            $host      = $config['host'] ?? '';
            $user      = $config['user'] ?? '';
            $password  = $config['password'] ?? '';
            $port      = $config['port'] ?? '';
            $database  = $config['database'] ?? '';
            $dsn       = "mysql:host={$host};port={$port};dbname={$database}";
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();

        $applied_migrations = $this->getAppliedMigrations();

        $files            = scandir(Application::$ROOT_DIR . "/migrations");
        $toApplyMigration = array_diff($files, $applied_migrations);
        $newMigrations    = [];
        foreach ($toApplyMigration as $migration) {
            if (in_array($migration, ['.', '..'])) {
                continue;
            }

            require_once Application::$ROOT_DIR . "/migrations/" . $migration;
            $className     = pathinfo($migration, PATHINFO_FILENAME);
            $classInstance = new $className();
            $this->log('applying migration ' . $className);
            $classInstance->up();
            $this->log('applied migration ' . $className);
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        }
        $this->log('All migration applied');
    }

    public function createMigrationsTable()
    {
        $statement = "
        CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $this->pdo->exec($statement);
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare('SELECT migration FROM migrations');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    protected function log($message): void
    {
        echo "[" . date('Y-m-d H:i:s') . "]- $message" . PHP_EOL;
    }

    private function saveMigrations(array $newMigrations)
    {
        $migration = implode(',', array_map(fn($m) => "('$m')", $newMigrations));

        $statement = $this->pdo->prepare(
            "INSERT INTO migrations (migration) VALUES 
                        $migration
                    "
        );
        $statement->execute();
    }
}