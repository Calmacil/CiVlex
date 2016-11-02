<?php
namespace App\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;


class RoutingServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['routing.file'] = "";
    }
    
    public function boot(Application $app)
    {
        $json = file_get_contents($app['routing.file']);
        $true_json = preg_replace("@#.*\n$@", "", $json);
        
        $routes = json_decode($true_json, true);

        if ($routes) {
            foreach ($routes as $name => $route) {
                $app[$route['uid']] = function() use ($app, $route) {
                    $nsc = "App\\Controllers\\".$route['controller'];
                    return new $nsc;
                };
                
                $app->{$route['method']}($route['pattern'], $route['uid'].":".$route['action'])
                    ->bind($name);
            }
            
        }
    }
}