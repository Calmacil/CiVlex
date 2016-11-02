<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

// registers
$app->register(new Silex\Provider\ServiceControllerServiceProvider);
$app->register(new Silex\Provider\TwigServiceProvider,
    ['twig.path' => __DIR__ . '/tpl']);
$app->register(new App\ServiceProvider\RoutingServiceProvider,
    ['routing.file' => __DIR__ . '/routes.json']);

$app->before(function(Request $request)
{
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);
    }
});