<?php

namespace app\controllers;

use app\core\Application;

class Controller
{
    public function render($view, $parameters = [])
    {
        return Application::$app->router->renderView($view, $parameters);
    }
}