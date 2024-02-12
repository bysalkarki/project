<?php

namespace app\models;

use app\core\DbModel;

class Employee extends DbModel
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    public const STATUS_DELETED = 2;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirmation = '';
    public int $status = self::STATUS_INACTIVE;


    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'position' => [self::RULE_REQUIRED],
            'salary' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 1000]],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [
                    self::RULE_UNIQUE,
                    'class' => self::class,
                    'attribute' => '',
                ]
            ],
        ];
    }

    public function tableName(): string
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