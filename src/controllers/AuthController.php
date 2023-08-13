<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

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
        $register = new User();
        return $this->render('auth/register', [
            'model' => $register
        ]);
    }

    public function handleRegister(Request $request)
    {
        $register = new User();
        $register->loadData($request->getBody());
        if ($register->validate() && $register->save()) {
            Application::$app->session->setFlash('success', 'Registration successfull');
            Application::$app->response->redirect('/');
        }
        return $this->render('auth/register', [
            'model' => $register
        ]);
    }
}