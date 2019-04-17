<?php
class SimpleRouter
{
    public function __construct()
    {
    }
    public function ParseURL($url)
    {
        $URLcomponents = explode('/', $url);
        $moduleName = ucfirst(array_shift($URLcomponents));
        $actionName = ucfirst(array_shift($URLcomponents));
        if (empty(trim($actionName)))
            $actionName = 'Index';
        return array('module' => $moduleName,
                     'action' => $actionName,
                     'params' => $URLcomponents);
    }
}