<?php
namespace app\core;

class Application
{
    //singleton
    public Router $router;
    public Request $request;
    public function __construct($rootPath)
    {
        $this->request = new Request();
        $this->router = new Router($this->request);

    }
    public function run()
    {
       echo $this->router->resolve();
    }
}