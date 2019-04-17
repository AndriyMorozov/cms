<?php
include('config/config.inc.php');
function classesAutoload($className)
{
    $filePath = "classes/{$className}.inc.php";
    if (is_file($filePath))
        include($filePath);
}
function modulesAutoload($className)
{
    $parts = explode('_', $className);
    $moduleName = strtolower(array_shift($parts));
    $componentName = strtolower(array_shift($parts));
    $filePath = "modules/{$moduleName}/{$componentName}.inc.php";
    if (is_file($filePath))
        include($filePath);
}

spl_autoload_register('classesAutoload');
spl_autoload_register('modulesAutoload');

FrontController::GetInstance()->Run();
FrontController::GetInstance()->Finish();
