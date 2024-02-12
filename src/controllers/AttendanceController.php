<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AttendanceController extends Controller
{

    public function home()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('home', $params);
    }


}