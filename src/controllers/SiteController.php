<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use PDO;

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
            'name' => $name,
            'data' => json_encode($this->getCounts())
        ];

        return $this->render('home', $params);
    }

    private function getCounts(): array
    {
        $userCountSql = Application::$app->db->prepare(
            'select count(*) as count from users;select count(*) as count from department;select count(*) as count from employees;'
        );
        $userCountSql->execute();
        $userCounts = [];
        do {
            $result = $userCountSql->fetchObject();
            if ($result) {
                $userCounts[] = $result->count;
            }
        } while ($userCountSql->nextRowset());

        return $userCounts;
    }

}