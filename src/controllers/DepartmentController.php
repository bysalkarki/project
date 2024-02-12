<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Department;

class DepartmentController extends Controller
{
    public Department $department;

    public function __construct()
    {
        $this->department = new Department();
    }

    public function index()
    {
        $params = [
            'models' => $this->department->findAll(['1' => 1]),
            'model' => $this->department
        ];
        return $this->render('department/index', $params);
    }

    public function store(Request $request)
    {
        $this->department->loadData($request->getBody());

        if ($this->department->validate() && $this->department->save()) {
            Application::$app->response->redirect('/department');
        }

        return $this->render('department/index', [
            'models' => $this->department->findAll(['1' => 1]),
            'model' => $this->department
        ]);
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

    public function remove(Request $request)
    {
        $record = $request->getBody();
        $this->department->deleteRecord($record['id']);
        Application::$app->response->redirect('/department');
    }


}