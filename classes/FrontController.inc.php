<?php
class FrontController
{
    protected $IndexTPL;
    public static $Database;
    private static $Instance;
    public static function GetInstance()
    {
        if (empty(self::$Instance))
        {
            self::$Instance = new FrontController();
        }
        return self::$Instance;
    }
    private function __construct()
    {
        global $Config;
        self::$Database =
            new DB($Config['Database']['Host'], $Config['Database']['Base'], $Config['Database']['User'], $Config['Database']['Pass']);

        $this->IndexTPL = new Template('templates/index.tpl');
    }
    public function Run()
    {
        $router = new SimpleRouter();
        $route = $router->ParseURL($_GET['route']);
        $className = $route['module'].'_Controller';
        $methodName = $route['action'];
        if (class_exists($className)) {
            $moduleObject = new $className();
            if (method_exists($moduleObject, $methodName)) {
                $params = $moduleObject->$methodName($route['params']);
                $this->IndexTPL->AddParams($params);
            } else
                throw new Exception('Error 404');
        } else{
            throw new Exception('Error 404');
        }
    }
    public function Finish()
    {
        $this->IndexTPL->Display();
    }
}