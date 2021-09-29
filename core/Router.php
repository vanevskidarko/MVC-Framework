<?php
namespace app\core;

use function Composer\Autoload\includeFile;

class Router
{
    public Request $request;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path =$this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            return '404 Not Found';
            exit;
        }
        //Warning: call_user_func() expects parameter 1 to be a valid callback, function 'users' not found or invalid function name in C:\Users\Darko\PhpstormProjects\MVCFramework\core\Router.php on line 32
        // error??????
        if (is_string($callback)){
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view)
    {
        //return the layout content
        $layoutContent = $this->layoutContent();
        include_once __DIR__."/../views/$view.php";
    }

    protected function layoutContent()
    {
        include_once
    }
}