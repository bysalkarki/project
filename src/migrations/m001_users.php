<?php


use app\core\Application;
use app\core\Database;

class m001_Users
{
    public Database $database;

    public function __construct()
    {
        $this->database = Application::$app->db;
    }

    public function up(): void
    {
        $sql = "
       CREATE TABLE users(
           id INT AUTO_INCREMENT PRIMARY KEY,
           email varchar(255) NOT NULL,
           name varchar(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT 1,
            password varchar(255) NOT NULL,
           created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP
       ) ENGINE=INNODB;
       ";
        $this->database->pdo->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE users";
        $this->database->pdo->exec($sql);
    }
}