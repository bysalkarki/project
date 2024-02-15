<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Attendance;
use app\models\Employee;

class AttendanceController extends Controller
{
    public Attendance $attendance;
    public Employee $employee;

    public function __construct()
    {
        $this->attendance = new Attendance();
        $this->employee = new Employee();
    }

    public function index(Request $request)
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $requestId = $request->getBody();
        if (empty($requestId['employee_id'])) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }

        $employee = $this->employee->findOne(['id' => $requestId['employee_id']]);

        if (!$employee) {
            Application::$app->router->response->setStatusCode('404');
            return Application::$app->router->renderContent('NOT FOUND');
        }

        $model = $this->attendance->findAll(['employee_id' => $requestId['employee_id']]);

        $params = [
            'model' => $this->attendance,
            'models' => $model,
            'employee' => $employee

        ];
        return $this->render('employee/attendance/index', $params);
    }

    public function create(Request $request)
    {
        if (Application::isGuest()) {
            Application::$app->router->response->setStatusCode('401');
            return Application::$app->router->renderContent('UNAUTHORIZED');
        }

        $body = $request->getBody();
        $this->attendance->loadData($body);

        if ($this->attendance->validate() && $this->attendance->save()) {
            Application::$app->response->redirect('/employee');
        }

        $employee = $this->employee->findOne(['id' => $body['employee_id']]);
        $model = $this->attendance->findAll(['employee_id' => $body['employee_id']]);

        $params = [
            'model' => $this->attendance,
            'models' => $model,
            'employee' => $employee

        ];
        return $this->render('employee/attendance/index', $params);
    }


}