<?php

namespace app\models;

use app\core\DbModel;

class Employee extends DbModel
{
    public string $name = '';
    public string $email = '';
    public string $salary = '';
    public string $position = '';
    public string $address = '';


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
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }
}