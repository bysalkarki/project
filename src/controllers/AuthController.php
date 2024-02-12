<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Login;
use app\models\User;

class AuthController extends Controller
{
    public function login()
    {
        $model = new Login();
        return $this->render('auth/login', [
            'model' => $model
        ]);
    }

    public function handleLogin(Request $request)
    {
        $login = new Login();
        $login->loadData($request->getBody());

        if ($login->validate() && $login->login()) {
            Application::$app->response->redirect('/');
        }

        return $this->render('auth/login', [
            'model' => $login
        ]);
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/login');
    }

    public function registration()
    {
        $register = new User();
        return $this->render('auth/register', [
            'model' => $register
        ]);
    }

    public function handleRegister(Request $request)
    {
        $register = new User();
        $register->loadData($request->getBody());
        if ($register->validate() && $register->register()) {
            Application::$app->response->redirect('/');
        }

        return $this->render('auth/register', [
            'model' => $register
        ]);
    }
}