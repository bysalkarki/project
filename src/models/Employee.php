<?php

namespace app\models;

use app\core\DbModel;

class Employee extends DbModel
{
    public string $name = '';
    public string $email = '';
    public int $salary = 0;
    public string $position = '';
    public string $address = '';
    public int $department_id = 0;


    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'position' => [self::RULE_REQUIRED],
            'salary' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
            ],
            'department_id' => [self::RULE_REQUIRED]
        ];
    }

    public static function tableName(): string
    {
        return 'employees';
    }

    public function attributes(): array
    {
        return [
            'name',
            'position',
            'email',
            'address',
            'salary',
            'department_id'
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

}