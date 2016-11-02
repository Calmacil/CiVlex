<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new App\Application();

/*$app->get('/hello', function () {
    return 'Hello!';
});
*/

require_once __DIR__.'/../bootstrap.php';
$app['debug'] = true;
$app->run();
