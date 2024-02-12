<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class Login extends DbModel
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL
            ],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return [
            'password',
            'email',
        ];
    }

    public function login()
    {
        $users = $this->findOne([
            'email' => $this->email
        ]);

        if(!$users){
            $this->addError('email','Incorrect Email. Please Try again');
            return false;
        }

        if(!password_verify($this->password, $users->password)){
            $this->addError('password','Invalid password');
            return false;
        }

        Application::$app->login($users);
        return true;
    }

    public function logout(){
        Application::$app->logout();
        return true;
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }
}