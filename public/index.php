<?php
//make it so that index.php is in a seperate folder and composer.json or composer.lock cannot be accessed from the route /name

//one directory back
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [\app\controllers\SiteController::class , 'home']);
$app->router->get('/users', 'users');
$app->router->post('/users', [\app\controllers\SiteController::class, 'handle']);
$app->router->get('/users', [\app\controllers\SiteController::class, 'handleGet']);


$app->run();