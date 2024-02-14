<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Department;
use app\models\Employee;

class EmployeeController extends Controller
{

    public Employee $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    public function index()
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $params = [
            'models' => $this->employee->findAll(['1' => 1]),
            'model' => $this->employee
        ];

        return $this->render('employee/index', $params);
    }

    public function create()
    {
        $params = [
            'model' => $this->employee,
            'department' => (new Department())->findAll(['1' => 1])
        ];
        return $this->render('employee/create', $params);
    }

    public function store(Request $request)
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $this->employee->loadData($request->getBody());

        if ($this->employee->validate() && $this->employee->save()) {
            Application::$app->response->redirect('/employee');
        }

        return $this->render('employee/create', [
            'model' => $this->employee
        ]);
    }

    public function edit(Request $request)
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $requestId = $request->getBody();
        if (empty($requestId['id'])) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }
        $model = $this->employee->findOne(['id' => $requestId['id']]);

        if (!$model) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }

        $params = [
            'model' => $model,
            'department' => (new Department())->findAll(['1' => 1])
        ];

        return $this->render('employee/edit', $params);
    }

    public function update(Request $request)
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $requestId = $request->getBody();
        if (empty($requestId['id'])) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }
        $model = $this->employee->findOne(['id' => $requestId['id']]);

        if (!$model) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }
        $model->name = $requestId['name'];
        $model->position = $requestId['position'];
        $model->address = $requestId['address'];
        $model->email = $requestId['email'];
        $model->salary = $requestId['salary'];

        if ($model->validate() && $model->update()) {
            Application::$app->response->redirect('/employee');
        }

        $params = [
            'model' => $model
        ];

        return $this->render('employee/edit', $params);
    }

    public function remove(Request $request)
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $record = $request->getBody();
        $this->employee->deleteRecord($record['id']);
        Application::$app->response->redirect('/employee');
    }

}