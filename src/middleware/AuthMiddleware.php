<?php

namespace app\middleware;

use app\core\Application;
use app\core\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{

    public function execute()
    {
        if(Application::isGuest()){

        }
    }
}