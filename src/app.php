<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection;
$routes->add('hello', new Route('hello/{name}', array('name'=>'World')));
$routes->add('bye',   new Route('bye'));

// use Symfony\Component\Routing;
// $generator = new Routing\Generator\UrlGenerator($routes, $context);
// echo $generator->generate('hello', array('name' => 'Fabien'));
// echo $generator->generate('hello', array('name' => 'Fabien'), true);


// $dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);
// echo $dumper->dump();

// $dumper = new Routing\Matcher\Dumper\ApacheMatcherDumper($routes);
// echo $dumper->dump();

return $routes;