<?php

namespace App\Controllers;

use \App\Application;

class Home {
    public function indexAction(Application $app)
    {
        return $app['twig']->render('index.html.twig');
    }
}