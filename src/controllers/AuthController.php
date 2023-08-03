<?php

namespace app\controllers;

use app\core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('auth/login');
    }

    public function handleLogin()
    {
    }

    public function register()
    {
        return $this->render('auth/register');
    }

    public function handleRegister()
    {
    }
}