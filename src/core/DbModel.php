<?php

namespace app\core;

use Exception;
use PDOStatement;

abstract class DbModel extends Model
{
    public function save(): bool
    {
        try {
            $tableName = $this->tableName();
            $attributes = implode(',', $this->attributes());
            $params = implode(',', array_map(fn($m) => ":$m", $attributes));
            $sql = "INSERT INTO $tableName ($attributes) VALUES ($params)";
            $statement = self::prepare($sql);

            foreach ($this->attributes() as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function labels(): array
    {

    }

    public static function prepare($sql): bool|PDOStatement
    {
        return Application::$app->db->pdo->prepare($sql);
    }

}