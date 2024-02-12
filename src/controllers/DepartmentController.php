<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('department/index', $params);
    }

    public function create()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('home', $params);
    }

    public function store()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('home', $params);
    }

    public function edit()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('home', $params);
    }

    public function update()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('home', $params);
    }

    public function delete()
    {
        $params = [
            'name' => 'bishal karki'
        ];
        return $this->render('home', $params);
    }


}