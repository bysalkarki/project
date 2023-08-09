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
        $this->save();
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
                    'attribute'=>'',
                ]
            ],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, ['min' => 8]]],
            'passwordConfirmation' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function tableName(): string
    {
        return 'user';
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
}