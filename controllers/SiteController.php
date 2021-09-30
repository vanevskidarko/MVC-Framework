<?php

namespace app\controllers;

use app\core\Application;

class SiteController extends Controller
{
    public function home()
    {
        $parameters = ['name' => 'Darko'];
        return $this->render('home', $parameters);
    }

    public function handle()
    {
        return 'handling data';
    }
    public function handleGet()
    {
        return $this->render('users');
    }

}