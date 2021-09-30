<?php
namespace app\core;

use function Composer\Autoload\includeFile;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path =$this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderContent(' Not Found') ;
            exit;
        }
        //Warning: call_user_func() expects parameter 1 to be a valid callback, function 'users' not found or invalid function name in C:\Users\Darko\PhpstormProjects\MVCFramework\core\Router.php on line 32
        // error??????
        if (is_string($callback)){
            return $this->renderView($callback);
        }
        if (is_array($callback)){
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback);
    }

    public function renderView($view, $parameters= [])
    {
        //return the layout content
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $parameters);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $parameters)
    {
        foreach ($parameters as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}