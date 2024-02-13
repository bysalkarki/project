<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    public const STATUS_DELETED = 2;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirmation = '';
    public int $status = self::STATUS_INACTIVE;

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }


    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [
                    self::RULE_UNIQUE,
                    'class' => self::class,
                    'attribute'=>'email',
                ]
            ],
            'password' => [self::RULE_REQUIRED],
            'passwordConfirmation' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'name',
            'email',
            'password',
            'status',
        ];
    }
    public function primaryKey(): string
    {
        return 'id';
    }
}