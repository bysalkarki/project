<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public string $name;
    public string $email;
    public string $password;
    public string $passwordConfirmation;

    public function register()
    {
        $this->save();
    }


    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
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
            'password'
        ];
    }
}