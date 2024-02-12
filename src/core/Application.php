<?php

namespace app\core;

use app\models\User;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Session $session;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $db;

    public ?DbModel $user;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        $this->session = new Session();
        $this->request = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        self::$app = $this;
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $sessionUser = $this->session->get('user');
        if ($sessionUser) {
            $this->user = (new User())->findOne(['id' => $sessionUser]);
        }else{
            $this->user = null;
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }


    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};

        $this->session->set('user', $primaryValue);
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }


}