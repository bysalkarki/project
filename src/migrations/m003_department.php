<?php

use app\core\Application;
use app\core\Database;

class m003_department
{
    public Database $database;

    public function __construct()
    {
        $this->database = Application::$app->db;
    }

    public function up(): void
    {
        $sql = "
       CREATE TABLE department(
           id INT AUTO_INCREMENT PRIMARY KEY,
           name varchar(255) NOT NULL,
           created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP
       ) ENGINE=INNODB;
       ";
        $this->database->pdo->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE department";
        $this->database->pdo->exec($sql);
    }
}