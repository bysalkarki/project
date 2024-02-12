<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function __construct()
    {
    }

    public function home()
    {
        $name = '';
        if (!Application::isGuest()) {
            $name = Application::$app->user->name;
        }
        $params = [
            'name' => $name
        ];
        return $this->render('home', $params);
    }

}