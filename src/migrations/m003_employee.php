<?php

use app\core\Application;
use app\core\Database;

class m003_employee
{
    public Database $database;

    public function __construct()
    {
        $this->database = Application::$app->db;
    }

    public function up(): void
    {
        $sql = "
       CREATE TABLE employees(
           id INT AUTO_INCREMENT PRIMARY KEY,
           name varchar(255) NOT NULL,
           position varchar(255) NOT NULL,
           email varchar(255) NOT NULL,
           address varchar(255) NOT NULL,
           salary int NOT NULL DEFAULT 0,
           created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP,
            department_id INT,
            FOREIGN KEY (department_id) REFERENCES department(id)
       ) ENGINE=INNODB;
       ";
        $this->database->pdo->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE employees";
        $this->database->pdo->exec($sql);
    }
}