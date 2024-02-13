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

    public function edit(Request $request)
    {
        $requestId = $request->getBody();
        if (empty($requestId['id'])) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }
        $model = $this->department->findOne(['id' => $requestId['id']]);

        if (!$model) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }

        $params = [
            'model' => $model
        ];

        return $this->render('department/form', $params);
    }

    public function update(Request $request)
    {
        $requestId = $request->getBody();
        if (empty($requestId['id']) || empty($requestId['name'])) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }
        $model = $this->department->findOne(['id' => $requestId['id']]);

        if (!$model) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }
        $model->name = $requestId['name'];

        if ($model->validate() && $model->update()) {
            Application::$app->response->redirect('/department');
        }

        $params = [
            'model' => $model
        ];

        return $this->render('department/form', $params);
    }

    public function remove(Request $request)
    {
        $record = $request->getBody();
        $this->department->deleteRecord($record['id']);
        Application::$app->response->redirect('/department');
    }


}