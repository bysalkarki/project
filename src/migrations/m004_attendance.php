<?php

use app\core\Application;
use app\core\Database;

class m004_attendance
{
    public Database $database;

    public function __construct()
    {
        $this->database = Application::$app->db;
    }

    public function up(): void
    {
        $sql = "
               CREATE TABLE attendance (
            id INT AUTO_INCREMENT PRIMARY KEY,
            employee_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (employee_id) REFERENCES employees(id)
        ) ENGINE=INNODB;
       ";
        $this->database->pdo->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE attendance";
        $this->database->pdo->exec($sql);
    }
}