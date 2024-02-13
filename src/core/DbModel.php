<?php

namespace app\core;

use app\core\Model;
use Exception;
use PDO;
use PDOStatement;

abstract class DbModel extends Model
{
    public function save(): bool
    {
        try {
            $tableName = $this->tableName();
            $attributes = implode(',', $this->attributes());
            $params = implode(',', array_map(fn($m) => ":$m", $this->attributes()));
            $sql = "INSERT INTO $tableName ($attributes) VALUES ($params)";
            $statement = self::prepare($sql);
            foreach ($this->attributes() as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();

            return true;
        } catch (Exception $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function update(): bool
    {
        try {
            $tableName = $this->tableName();
            $primaryKey = $this->primaryKey(); // Assuming primaryKey() method returns the primary key column name
            $primaryKeyValue = $this->{$primaryKey};
            $setClause = implode(',', array_map(fn($attr) => "$attr = :$attr", $this->attributes()));

            // Construct the SQL UPDATE statement
            $sql = "UPDATE $tableName SET $setClause WHERE $primaryKey = :$primaryKey";

            // Prepare the SQL statement
            $statement = self::prepare($sql);

            // Bind parameters for update
            foreach ($this->attributes() as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            // Bind primary key value
            $statement->bindValue(":$primaryKey", $primaryKeyValue);

            // Execute the statement
            $statement->execute();

            return true;
        } catch (Exception $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }


    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public static function prepare($sql): bool|PDOStatement
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public function findOne($where)
    {
        $statement = $this->getPrepare($where);
        return $statement->fetchObject(static::class);
    }

    public function findAll(array $where = [])
    {
        $statement = $this->getPrepare($where);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteRecord($id): bool
    {;
        try {
            $tableName = $this->tableName();
            $sql = "DELETE FROM {$tableName} where id = '{$id}'";

            $statement = self::prepare($sql);
            $statement->execute();
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @param $where
     * @return bool|PDOStatement
     */
    public function getPrepare($where): PDOStatement|bool
    {
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement;
    }

}